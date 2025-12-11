<?php
require_once 'app/models/Skrining.php';

class AdminController
{
    // Konfigurasi Auth: Cek apakah user sudah login dan role-nya admin
    public function __construct()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    // 1. Halaman Dashboard Overview (Statistik & Ringkasan 5 Data)
    public function index()
    {
        $model = new Skrining();

        // Ambil Statistik Lengkap
        $stats = $model->getStatistik();

        // Ambil 5 Pasien Terbaru saja untuk tabel ringkasan di dashboard overview
        $terbaru = $model->getSkriningByPage(0, 5);

        $data = [
            'stats' => $stats,
            'terbaru' => $terbaru
        ];

        // Pastikan path ini sesuai struktur folder view Anda
        require_once 'app/views/layouts/header.php';
        require_once 'app/views/admin/dashboard.php';
        require_once 'app/views/layouts/footer.php';
    }

    // 2. Halaman Data Pasien Lengkap (Menggunakan DataTables)
    public function pasien()
    {
        $model = new Skrining();

        // Ambil SEMUA data skrining (tanpa limit) untuk DataTables
        $screenings = $model->getAllSkrining();

        $data = [
            'screenings' => $screenings
        ];

        require_once 'app/views/layouts/header.php';
        // PENTING: Pastikan file 'pasein.php' sudah di-rename jadi 'pasien.php'
        require_once 'app/views/admin/pasien.php';
        require_once 'app/views/layouts/footer.php';
    }

    // 3. Halaman Form Input Feedback
    public function feedback($id_skrining = null)
    {
        // Jika Admin akses /admin/feedback tanpa ID, kembalikan ke dashboard
        if ($id_skrining == null) {
            header('Location: ' . BASEURL . '/admin');
            exit;
        }

        $model = new Skrining();
        $data = $model->getSkriningById($id_skrining);

        // Jika data skrining tidak ditemukan di database
        if (!$data) {
            header('Location: ' . BASEURL . '/admin');
            exit;
        }

        require_once 'app/views/layouts/header.php';
        // Sesuai gambar, Anda punya file form_feedback.php
        require_once 'app/views/admin/form_feedback.php';
        require_once 'app/views/layouts/footer.php';
    }

    // 4. Proses Simpan Feedback ke Database
    // [UPDATE] Menangkap Diagnosa
    public function storeFeedback()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new Skrining();

            $id_skrining = $_POST['id_skrining'];
            $feedback = $_POST['feedback_admin'];
            $diagnosa = $_POST['diagnosa']; // Tangkap input diagnosa
            $admin_id = $_SESSION['user_id'];

            // Kirim diagnosa ke model
            if ($model->updateFeedback($id_skrining, $feedback, $diagnosa, $admin_id)) {
                header('Location: ' . BASEURL . '/admin?status=success');
            } else {
                header('Location: ' . BASEURL . '/admin?status=error');
            }
        }
    }

    // 5. Fitur Export Data ke Excel
    public function export()
    {
        $model = new Skrining();
        $data = $model->getAllSkrining(); // Pastikan method ini ambil detail_jawaban

        $filename = "Detail_Laporan_KoloCheck_" . date('Y-m-d_H-i') . ".xls";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        echo "<style>
            table { border-collapse: collapse; width: 100%; font-family: Arial; font-size: 12px;}
            th { background-color: #4CAF50; color: white; border: 1px solid #000; padding: 8px; }
            td { border: 1px solid #000; padding: 5px; vertical-align: top; }
            .str { mso-number-format:\"\@\"; }
            .bg-yellow { background-color: #fff3cd; }
            .bg-blue { background-color: #d1e7dd; }
        </style>";

        echo "<table>";
        echo "<thead>
                <tr>
                    <th rowspan='2'>No</th>
                    <th rowspan='2'>Tgl Skrining</th>
                    <th rowspan='2'>NIK</th>
                    <th rowspan='2'>Nama Pasien</th>
                    <th rowspan='2'>JK</th>
                    <th rowspan='2'>Usia</th>
                    <th rowspan='2'>No HP</th>
                    <th rowspan='2'>Pekerjaan</th>
                    <th rowspan='2'>Alamat</th>
                    
                    <th colspan='10' class='bg-blue'>A. Pengetahuan</th>
                    <th colspan='10' class='bg-yellow'>B. Perilaku</th>
                    <th colspan='10' class='bg-blue'>C. Sikap</th>
                    
                    <th rowspan='2'>Total Skor</th>
                    <th rowspan='2'>Kategori Risiko</th>
                    <th rowspan='2'>Feedback Dokter</th>
                </tr>
                <tr>
                    ";
        for ($i = 1; $i <= 10; $i++) echo "<th>P$i</th>";
        for ($i = 1; $i <= 10; $i++) echo "<th>B$i</th>";
        for ($i = 1; $i <= 10; $i++) echo "<th>S$i</th>";
        echo "  </tr>
              </thead><tbody>";

        $no = 1;
        foreach ($data as $row) {
            $tgl_lahir = isset($row['tgl_lahir']) ? $row['tgl_lahir'] : '2000-01-01';
            $usia = date_diff(date_create($tgl_lahir), date_create('today'))->y;

            // Decode JSON Jawaban
            $j = json_decode($row['detail_jawaban'], true);

            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['tanggal_skrining'] . "</td>";
            echo "<td class='str'>" . $row['nik'] . "</td>";
            echo "<td>" . $row['nama_lengkap'] . "</td>";
            echo "<td>" . $row['jenis_kelamin'] . "</td>";
            echo "<td>" . $usia . "</td>";
            echo "<td class='str'>" . $row['no_hp'] . "</td>";
            echo "<td>" . $row['pekerjaan'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";

            // Loop Nilai Pengetahuan
            for ($i = 1; $i <= 10; $i++) echo "<td>" . ($j['p' . $i] ?? '-') . "</td>";
            // Loop Nilai Perilaku
            for ($i = 1; $i <= 10; $i++) echo "<td>" . ($j['b' . $i] ?? '-') . "</td>";
            // Loop Nilai Sikap
            for ($i = 1; $i <= 10; $i++) echo "<td>" . ($j['s' . $i] ?? '-') . "</td>";

            echo "<td>" . $row['total_skor'] . "</td>";
            echo "<td>" . $row['kategori_risiko'] . "</td>";
            echo "<td>" . $row['feedback_admin'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        exit;
    }

    // --- MANAJEMEN USER ---

    // Halaman Daftar User
    public function users()
    {
        // Load Model User (Manual karena AdminController defaultnya load Skrining)
        require_once 'app/models/User.php';
        $userModel = new User();

        $data['users'] = $userModel->getAllUsers();

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/admin/users.php'; // Kita buat view ini di langkah 3
        require_once 'app/views/layouts/footer.php';
    }

    // Proses Reset Password
    public function resetUser($id)
    {
        require_once 'app/models/User.php';
        $userModel = new User();

        if ($userModel->resetPasswordByAdmin($id)) {
            header('Location: ' . BASEURL . '/admin/users?status=reset_success');
        } else {
            header('Location: ' . BASEURL . '/admin/users?status=error');
        }
    }

    // Proses Hapus User
    public function deleteUser($id)
    {
        require_once 'app/models/User.php';
        $userModel = new User();

        if ($userModel->deleteUser($id)) {
            header('Location: ' . BASEURL . '/admin/users?status=deleted');
        } else {
            header('Location: ' . BASEURL . '/admin/users?status=error');
        }
    }
}
