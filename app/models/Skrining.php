<?php
class Skrining
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Simpan hasil kuesioner dari pasien
    public function simpanHasil($data)
    {
        $conn = $this->db->getConnection();

        // [UPDATE] Tambahkan detail_jawaban
        $query = "INSERT INTO skrining 
                  (user_id, skor_pengetahuan, skor_perilaku, skor_sikap, total_skor, kategori_risiko, detail_jawaban) 
                  VALUES 
                  (:user_id, :skor_p, :skor_b, :skor_s, :total, :kategori, :detail)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':skor_p', $data['skor_pengetahuan']);
        $stmt->bindParam(':skor_b', $data['skor_perilaku']);
        $stmt->bindParam(':skor_s', $data['skor_sikap']);
        $stmt->bindParam(':total', $data['total_skor']);
        $stmt->bindParam(':kategori', $data['kategori_risiko']);
        $stmt->bindParam(':detail', $data['detail_jawaban']); // Binding JSON

        return $stmt->execute();
    }

    // Mengambil riwayat skrining user tertentu (untuk Dashboard Pasien)
    public function getRiwayatByUser($user_id)
    {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM skrining WHERE user_id = :uid ORDER BY tanggal_skrining DESC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':uid', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil SEMUA data lengkap (untuk DataTables & Export Excel)
    public function getAllSkrining()
    {
        $conn = $this->db->getConnection();

        // PERHATIKAN URUTANNYA: p.* dulu, baru s.*
        // Ini agar kolom 'id' yang diambil adalah milik SKRINING (s.id), bukan pasien (p.id)
        $query = "SELECT p.*, u.email, s.* FROM skrining s
                  JOIN pasien_details p ON s.user_id = p.user_id
                  JOIN users u ON s.user_id = u.id
                  ORDER BY s.tanggal_skrining DESC";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil 1 data detail berdasarkan ID Skrining (untuk Halaman Feedback/Detail)
    public function getSkriningById($id)
    {
        $conn = $this->db->getConnection();

        // SAMA: p.* dulu, baru s.* agar ID skrining yang menang
        $query = "SELECT p.*, u.email, s.* FROM skrining s
                  JOIN pasien_details p ON s.user_id = p.user_id
                  JOIN users u ON s.user_id = u.id
                  WHERE s.id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Simpan Feedback dari Admin
    // [UPDATE] Versi Debugging untuk Update Feedback
    // [UPDATE] Simpan Feedback DAN Diagnosa
    public function updateFeedback($id, $feedback, $diagnosa, $admin_id)
    {
        $conn = $this->db->getConnection();

        try {
            // Urutan: p.*, u.email, s.* agar ID skrining yang diambil (s.id)
            // Ini logika perbaikan ID Collision yang tadi
            $query = "UPDATE skrining 
                      SET feedback_admin = :feedback, 
                          diagnosa = :diagnosa,
                          id_admin_pemberi = :admin_id, 
                          tanggal_feedback = NOW() 
                      WHERE id = :id";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':feedback', $feedback);
            $stmt->bindParam(':diagnosa', $diagnosa); // Binding data baru
            $stmt->bindParam(':admin_id', $admin_id);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("<h1>ERROR UPDATE: " . $e->getMessage() . "</h1>");
        }
    }

    // Hitung Statistik Lengkap untuk Dashboard Admin
    public function getStatistik()
    {
        $conn = $this->db->getConnection();

        // 1. Total Pasien (User dengan role pasien)
        $total = $conn->query("SELECT COUNT(*) FROM users WHERE role='pasien'")->fetchColumn();

        // 2. Breakdown Berdasarkan Kategori Risiko
        $tinggi = $conn->query("SELECT COUNT(*) FROM skrining WHERE kategori_risiko='Tinggi'")->fetchColumn(); // Sesuaikan string di DB ('Tinggi'/'Risiko Tinggi')
        $sedang = $conn->query("SELECT COUNT(*) FROM skrining WHERE kategori_risiko='Sedang'")->fetchColumn();
        $rendah = $conn->query("SELECT COUNT(*) FROM skrining WHERE kategori_risiko='Rendah'")->fetchColumn();

        // 3. Status Feedback
        $sudah = $conn->query("SELECT COUNT(*) FROM skrining WHERE feedback_admin IS NOT NULL AND feedback_admin != ''")->fetchColumn();
        $belum = $conn->query("SELECT COUNT(*) FROM skrining WHERE feedback_admin IS NULL OR feedback_admin = ''")->fetchColumn();

        return [
            'total_pasien' => $total,
            'total_tinggi' => $tinggi,
            'total_sedang' => $sedang,
            'total_rendah' => $rendah,
            'sudah_feedback' => $sudah,
            'belum_feedback' => $belum
        ];
    }

    // Hitung Total Data Skrining (untuk keperluan pagination manual jika diperlukan)
    public function countAllSkrining()
    {
        $conn = $this->db->getConnection();
        $query = "SELECT COUNT(*) FROM skrining";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Ambil Data per Halaman (untuk List "Pasien Terbaru" di Dashboard)
    public function getSkriningByPage($start, $limit)
    {
        $conn = $this->db->getConnection();

        // SAMA: p.* dulu, baru s.*
        $query = "SELECT p.*, u.email, s.*
                  FROM skrining s
                  JOIN pasien_details p ON s.user_id = p.user_id
                  JOIN users u ON s.user_id = u.id
                  ORDER BY s.tanggal_skrining DESC
                  LIMIT :limit OFFSET :start";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
