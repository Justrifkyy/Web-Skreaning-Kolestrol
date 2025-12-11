<?php
require_once 'app/models/Skrining.php';

class SkriningController
{

    public function __construct()
    {
        // Biarkan kosong agar tamu bisa masuk
    }

    public function index()
    {
        require_once 'app/views/layouts/header.php';
        require_once 'app/views/pasien/form_skrining.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function process()
    {
        // 1. HITUNG SKOR (Berlaku untuk Tamu & Member)
        $p_score = 0;
        $b_score = 0;
        $s_score = 0;
        $raw_answers = [];

        // Loop Pengetahuan (10 Soal)
        for ($i = 1; $i <= 10; $i++) {
            $val = isset($_POST['p' . $i]) ? $_POST['p' . $i] : 0;
            $p_score += $val;
            $raw_answers['p' . $i] = $val;
        }
        // Loop Perilaku (10 Soal)
        for ($i = 1; $i <= 10; $i++) {
            $val = isset($_POST['b' . $i]) ? $_POST['b' . $i] : 0;
            $b_score += $val;
            $raw_answers['b' . $i] = $val;
        }
        // Loop Sikap (10 Soal)
        for ($i = 1; $i <= 10; $i++) {
            $val = isset($_POST['s' . $i]) ? $_POST['s' . $i] : 0;
            $s_score += $val;
            $raw_answers['s' . $i] = $val;
        }

        // Hitung Total
        $totalSkor = $p_score + $b_score + $s_score;
        $kategori = '';

        if ($totalSkor >= 80) {
            $kategori = 'Rendah';
        } elseif ($totalSkor >= 50) {
            $kategori = 'Sedang';
        } else {
            $kategori = 'Tinggi';
        }

        // ==========================================
        // PERBAIKAN UTAMA ADA DISINI
        // ==========================================

        // KONDISI 1: SUDAH LOGIN (MEMBER) -> SIMPAN KE DB
        if (isset($_SESSION['user_id'])) {

            $skriningModel = new Skrining();

            // Kita baru ambil ID disini, karena sudah pasti ada
            $userId = $_SESSION['user_id'];

            $dataToSave = [
                'user_id' => $userId,
                'skor_pengetahuan' => $p_score,
                'skor_perilaku' => $b_score,
                'skor_sikap' => $s_score,
                'total_skor' => $totalSkor,
                'kategori_risiko' => $kategori,
                'detail_jawaban' => json_encode($raw_answers)
            ];

            if ($skriningModel->simpanHasil($dataToSave)) {
                // Ambil data terakhir untuk redirect
                $riwayat = $skriningModel->getRiwayatByUser($userId);
                $lastId = $riwayat[0]['id'];
                header('Location: ' . BASEURL . '/skrining/detail/' . $lastId);
            } else {
                echo "Gagal menyimpan data ke database.";
            }
        }

        // KONDISI 2: BELUM LOGIN (TAMU) -> JANGAN SIMPAN, LANGSUNG TAMPILKAN
        else {
            // Siapkan data untuk view khusus tamu
            $data = [
                'total_skor' => $totalSkor,
                'kategori_risiko' => $kategori,
                'skor_p' => $p_score,
                'skor_b' => $b_score,
                'skor_s' => $s_score
            ];

            require_once 'app/views/layouts/header.php';
            require_once 'app/views/pasien/hasil_guest.php';
            require_once 'app/views/layouts/footer.php';
        }
    }

    // --- PROTEKSI UNTUK FITUR MEMBER ---

    public function detail($id)
    {
        $this->cekLogin(); // Wajib Login

        $skriningModel = new Skrining();
        $result = $skriningModel->getSkriningById($id);

        if (!$result) {
            echo "Data tidak ditemukan.";
            exit;
        }
        if ($result['user_id'] != $_SESSION['user_id']) {
            echo "Akses ditolak.";
            exit;
        }

        // Logic Diagnosa Otomatis
        $diagnosa = !empty($result['diagnosa']) ? $result['diagnosa'] : "Belum ada diagnosa medis.";
        if (empty($result['diagnosa'])) {
            if ($result['kategori_risiko'] == 'Tinggi') $diagnosa = "Indikasi Hiperkolesterolemia";
            elseif ($result['kategori_risiko'] == 'Sedang') $diagnosa = "Indikasi Borderline High";
            else $diagnosa = "Kondisi Normal";
        }

        $data['detail'] = $result;
        $data['detail']['diagnosa'] = $diagnosa;

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/pasien/detail.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function cetak($id)
    {
        $this->cekLogin();
        $skriningModel = new Skrining();
        $data = $skriningModel->getSkriningById($id);

        if (!$data || $data['user_id'] != $_SESSION['user_id']) {
            echo "Akses ditolak.";
            exit;
        }

        require_once 'app/views/pasien/cetak.php';
    }

    public function laporan($id)
    {
        $this->cekLogin();
        $skriningModel = new Skrining();
        $data = $skriningModel->getSkriningById($id);

        if (!$data || $data['user_id'] != $_SESSION['user_id']) {
            echo "Akses ditolak.";
            exit;
        }

        require_once 'app/views/pasien/laporan.php';
    }

    private function cekLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }
}
