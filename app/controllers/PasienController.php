<?php
require_once 'app/models/Skrining.php'; // Load Model

class PasienController
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'pasien') {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index()
    {
        // Ambil Data Riwayat Skrining
        $skriningModel = new Skrining();
        $riwayat = $skriningModel->getRiwayatByUser($_SESSION['user_id']);

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/pasien/dashboard.php'; // Variable $riwayat dikirim ke sini
        require_once 'app/views/layouts/footer.php';
    }
}
