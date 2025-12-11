<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $conn = $this->db->getConnection();

        try {
            // 1. Mulai Transaksi
            $conn->beginTransaction();

            // 2. Insert ke tabel USERS (Login Info)
            $queryUser = "INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, 'pasien')";
            $stmt = $conn->prepare($queryUser);

            $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':email', $data['email']);
            $stmt->execute();

            // Ambil ID user yang baru dibuat
            $lastId = $conn->lastInsertId();

            // 3. Insert ke tabel PASIEN_DETAILS (Data Lengkap)
            $queryDetail = "INSERT INTO pasien_details 
                            (user_id, nama_lengkap, nik, tgl_lahir, jenis_kelamin, alamat, no_hp, status_pernikahan, pekerjaan) 
                            VALUES 
                            (:user_id, :nama, :nik, :tgl, :jk, :alamat, :hp, :status, :kerja)";

            $stmtDetail = $conn->prepare($queryDetail);
            $stmtDetail->bindParam(':user_id', $lastId);
            $stmtDetail->bindParam(':nama', $data['nama_lengkap']);
            $stmtDetail->bindParam(':nik', $data['nik']);
            $stmtDetail->bindParam(':tgl', $data['tgl_lahir']);
            $stmtDetail->bindParam(':jk', $data['jenis_kelamin']);
            $stmtDetail->bindParam(':alamat', $data['alamat']);
            $stmtDetail->bindParam(':hp', $data['no_hp']);
            $stmtDetail->bindParam(':status', $data['status_pernikahan']);
            $stmtDetail->bindParam(':kerja', $data['pekerjaan']);
            $stmtDetail->execute();

            // 4. Commit (Simpan Permanen)
            $conn->commit();
            return true;
        } catch (Exception $e) {
            // Jika ada error, batalkan semua
            $conn->rollBack();
            return false;
        }
    }

    public function login($username, $password)
    {
        $conn = $this->db->getConnection();
        // Join tabel users dan pasien_details agar bisa ambil nama lengkap
        // Left join digunakan agar admin (yang tidak punya detail pasien) tetap bisa login
        $query = "SELECT u.*, p.nama_lengkap 
                  FROM users u 
                  LEFT JOIN pasien_details p ON u.id = p.user_id 
                  WHERE u.username = :username";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Jika nama_lengkap kosong (misal Admin), pakai Username
            if (empty($user['nama_lengkap'])) {
                $user['nama_lengkap'] = $user['username'];
            }
            return $user;
        } else {
            return false;
        }
    }

    // [BARU] Ambil data lengkap user berdasarkan ID
    public function getUserById($id)
    {
        $conn = $this->db->getConnection();
        // Left join agar jika admin (yg tidak punya detail) tetap keambil
        $query = "SELECT u.*, p.* FROM users u 
                  LEFT JOIN pasien_details p ON u.id = p.user_id 
                  WHERE u.id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // [BARU] Update Profil (Data Diri & Email)
    public function updateProfile($data)
    {
        $conn = $this->db->getConnection();

        try {
            $conn->beginTransaction();

            // 1. Update Email di tabel USERS
            $queryUser = "UPDATE users SET email = :email WHERE id = :id";
            $stmt = $conn->prepare($queryUser);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':id', $data['id']);
            $stmt->execute();

            // 2. Update Detail di tabel PASIEN_DETAILS (Hanya jika role pasien)
            if ($_SESSION['role'] == 'pasien') {
                $queryDetail = "UPDATE pasien_details SET 
                                nama_lengkap = :nama,
                                nik = :nik,
                                tgl_lahir = :tgl,
                                jenis_kelamin = :jk,
                                alamat = :alamat,
                                no_hp = :hp,
                                pekerjaan = :kerja
                                WHERE user_id = :id";

                $stmtDetail = $conn->prepare($queryDetail);
                $stmtDetail->bindParam(':nama', $data['nama_lengkap']);
                $stmtDetail->bindParam(':nik', $data['nik']);
                $stmtDetail->bindParam(':tgl', $data['tgl_lahir']);
                $stmtDetail->bindParam(':jk', $data['jenis_kelamin']);
                $stmtDetail->bindParam(':alamat', $data['alamat']);
                $stmtDetail->bindParam(':hp', $data['no_hp']);
                $stmtDetail->bindParam(':kerja', $data['pekerjaan']);
                $stmtDetail->bindParam(':id', $data['id']);
                $stmtDetail->execute();
            }

            $conn->commit();
            return true;
        } catch (Exception $e) {
            $conn->rollBack();
            return false;
        }
    }

    // [BARU] Cek Password Lama (Untuk keamanan sebelum ganti)
    public function cekPassword($id, $inputPassword)
    {
        $conn = $this->db->getConnection();
        $query = "SELECT password FROM users WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($inputPassword, $user['password'])) {
            return true;
        }
        return false;
    }

    // [BARU] Update Password Baru
    public function updatePassword($id, $newPassword)
    {
        $conn = $this->db->getConnection();
        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

        $query = "UPDATE users SET password = :pass WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':pass', $hashed_password);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // --- KHUSUS ADMIN ---

    // 1. Ambil Semua User (Kecuali Admin sendiri)
    public function getAllUsers()
    {
        $conn = $this->db->getConnection();
        $query = "SELECT u.id, u.username, u.email, u.role, p.nama_lengkap, p.nik, p.no_hp 
                  FROM users u 
                  LEFT JOIN pasien_details p ON u.id = p.user_id 
                  WHERE u.role = 'pasien' 
                  ORDER BY u.id DESC";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Reset Password User (Default: 123456)
    public function resetPasswordByAdmin($id)
    {
        $conn = $this->db->getConnection();
        $default_pass = password_hash('123456', PASSWORD_DEFAULT);

        $query = "UPDATE users SET password = :pass WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':pass', $default_pass);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // 3. Hapus User
    public function deleteUser($id)
    {
        $conn = $this->db->getConnection();
        // Hapus dari tabel users (Karena ON DELETE CASCADE di database, 
        // data di pasien_details & skrining harusnya otomatis terhapus. 
        // Jika tidak, Anda perlu menghapus manual satu per satu).
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
