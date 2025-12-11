<?php
require_once 'app/models/User.php';

class ProfilController
{

    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index()
    {
        $userModel = new User();
        $data['user'] = $userModel->getUserById($_SESSION['user_id']);

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/profil/index.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new User();
            // Masukkan ID user yang sedang login ke array POST
            $_POST['id'] = $_SESSION['user_id'];

            if ($userModel->updateProfile($_POST)) {
                // Update session nama jika berubah
                if (isset($_POST['nama_lengkap'])) {
                    $_SESSION['nama_lengkap'] = $_POST['nama_lengkap'];
                }
                header('Location: ' . BASEURL . '/profil?status=success_update');
            } else {
                header('Location: ' . BASEURL . '/profil?status=error_update');
            }
        }
    }

    public function gantiPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new User();
            $id = $_SESSION['user_id'];
            $passLama = $_POST['password_lama'];
            $passBaru = $_POST['password_baru'];
            $passKonfirm = $_POST['konfirmasi_password'];

            // 1. Cek Password Lama
            if (!$userModel->cekPassword($id, $passLama)) {
                header('Location: ' . BASEURL . '/profil?error=pass_lama_salah');
                exit;
            }

            // 2. Cek Kesamaan Password Baru
            if ($passBaru !== $passKonfirm) {
                header('Location: ' . BASEURL . '/profil?error=pass_tidak_sama');
                exit;
            }

            // 3. Update
            if ($userModel->updatePassword($id, $passBaru)) {
                header('Location: ' . BASEURL . '/profil?status=success_password');
            } else {
                header('Location: ' . BASEURL . '/profil?status=error_general');
            }
        }
    }
}
