<?php
// Load Koneksi Database
require_once 'app/config/Database.php';

// Inisialisasi Koneksi
$db = new Database();
$conn = $db->getConnection();

echo "<h3>Memulai Proses Seeding Data...</h3>";

try {
    // 1. Matikan cek Foreign Key agar bisa truncate tabel
    $conn->exec("SET FOREIGN_KEY_CHECKS = 0");

    // 2. Kosongkan Tabel (Urutan tidak masalah karena FK mati)
    $conn->exec("TRUNCATE TABLE skrining");
    $conn->exec("TRUNCATE TABLE pasien_details");
    $conn->exec("TRUNCATE TABLE users");

    echo "✅ Berhasil menghapus data lama.<br>";

    // 3. Nyalakan kembali Foreign Key
    $conn->exec("SET FOREIGN_KEY_CHECKS = 1");

    // ==========================================
    // CREATE ADMIN
    // ==========================================
    $passAdmin = password_hash('admin123', PASSWORD_DEFAULT);
    $sqlAdmin = "INSERT INTO users (username, password, email, role) VALUES ('admin', '$passAdmin', 'admin@kolestrol.com', 'admin')";
    $conn->exec($sqlAdmin);

    echo "✅ Akun Admin berhasil dibuat (User: admin / Pass: admin123)<br>";

    // ==========================================
    // CREATE 12 DUMMY PATIENTS
    // ==========================================

    // Data Dummy Array
    $names = [
        "Budi Santoso",
        "Siti Aminah",
        "Rudi Hartono",
        "Dewi Sartika",
        "Agus Salim",
        "Rina Marlina",
        "Joko Widodo",
        "Megawati",
        "Susilo Bambang",
        "Ani Yudhoyono",
        "Prabowo Subianto",
        "Gibran Rakabuming"
    ];

    $jobs = ["PNS", "Wiraswasta", "Guru", "Buruh", "Ibu Rumah Tangga", "Karyawan Swasta"];
    $addresses = ["Jl. Merdeka No. 1", "Jl. Sudirman No. 45", "Jl. Diponegoro No. 10", "Jl. Ahmad Yani No. 99"];

    // Loop 12 kali
    for ($i = 0; $i < 12; $i++) {

        // A. Insert User Account
        $username = strtolower(str_replace(' ', '', $names[$i])) . rand(10, 99);
        $password = password_hash('123456', PASSWORD_DEFAULT);
        $email = $username . "@gmail.com";

        $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, 'pasien')");
        $stmt->execute([$username, $password, $email]);
        $userId = $conn->lastInsertId();

        // B. Insert Pasien Details
        $nik = "7471" . rand(100000000000, 999999999999);
        $tgl_lahir = rand(1970, 2000) . "-" . rand(1, 12) . "-" . rand(1, 28);
        $jk = ($i % 2 == 0) ? 'Laki-laki' : 'Perempuan';
        $pekerjaan = $jobs[array_rand($jobs)];
        $alamat = $addresses[array_rand($addresses)];
        $no_hp = "0812" . rand(10000000, 99999999);
        $status = "Menikah";

        $stmtDetail = $conn->prepare("INSERT INTO pasien_details (user_id, nama_lengkap, nik, tgl_lahir, jenis_kelamin, alamat, no_hp, status_pernikahan, pekerjaan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmtDetail->execute([$userId, $names[$i], $nik, $tgl_lahir, $jk, $alamat, $no_hp, $status, $pekerjaan]);

        // C. Insert Hasil Skrining (Random Risk)
        // Kita acak risikonya: 1=Rendah, 2=Sedang, 3=Tinggi
        $riskLevel = rand(1, 3);

        $skorPengetahuan = 0;
        $skorPerilaku = 0;
        $skorSikap = 0;
        $kategori = "";
        $totalSkor = 0;

        // Logika Dummy Skor (Semakin tinggi skor, semakin tinggi risiko - asumsi kuesioner negatif)
        if ($riskLevel == 1) {
            $kategori = "Rendah";
            $skorPengetahuan = rand(80, 100); // Pengetahuan bagus
            $skorPerilaku = rand(80, 100);    // Perilaku bagus
            $skorSikap = rand(80, 100);       // Sikap bagus
            $totalSkor = rand(10, 30);        // Total Resiko Kecil
        } elseif ($riskLevel == 2) {
            $kategori = "Sedang";
            $skorPengetahuan = rand(50, 79);
            $skorPerilaku = rand(50, 79);
            $skorSikap = rand(50, 79);
            $totalSkor = rand(31, 60);
        } else {
            $kategori = "Tinggi";
            $skorPengetahuan = rand(0, 49);   // Pengetahuan kurang
            $skorPerilaku = rand(0, 49);      // Perilaku buruk
            $skorSikap = rand(0, 49);         // Sikap acuh
            $totalSkor = rand(61, 100);
        }

        // Tanggal Skrining (Acak 7 hari terakhir)
        $tglSkrining = date('Y-m-d H:i:s', strtotime("-" . rand(0, 7) . " days"));

        $stmtSkrining = $conn->prepare("INSERT INTO skrining (user_id, tanggal_skrining, skor_pengetahuan, skor_perilaku, skor_sikap, total_skor, kategori_risiko) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtSkrining->execute([$userId, $tglSkrining, $skorPengetahuan, $skorPerilaku, $skorSikap, $totalSkor, $kategori]);
    }

    echo "✅ Berhasil membuat 12 Data Pasien Dummy dengan variasi risiko.<br>";
    echo "<hr>";
    echo "<h4>Selesai! Silakan login.</h4>";
    echo "<a href='index.php'>Kembali ke Website</a>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
