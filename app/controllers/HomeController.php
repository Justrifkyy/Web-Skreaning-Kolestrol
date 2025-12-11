<?php
class HomeController
{
    public function index()
    {
        // Cek jika user sudah login, redirect ke dashboard masing-masing
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] == 'admin') {
                header('Location: ' . BASEURL . '/admin');
                exit;
            } else {
                header('Location: ' . BASEURL . '/pasien');
                exit;
            }
        }

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/home/index.php';
        require_once 'app/views/layouts/footer.php';
    }
}
