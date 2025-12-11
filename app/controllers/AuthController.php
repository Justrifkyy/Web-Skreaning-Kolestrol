<?php
require_once 'app/models/User.php';

class AuthController
{

    // Default method jika user hanya mengetik /auth
    public function index()
    {
        $this->login();
    }

    // Tampilkan Halaman Login (URL: /auth/login)
    public function login()
    {
        // Jika sudah login, lempar ke dashboard sesuai role
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] == 'admin') {
                header('Location: ' . BASEURL . '/admin');
            } else {
                header('Location: ' . BASEURL . '/pasien');
            }
            exit;
        }

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/auth/login.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Tampilkan Halaman Register (URL: /auth/register)
    public function register()
    {
        require_once 'app/views/layouts/header.php';
        require_once 'app/views/auth/register.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Proses Register (POST dari form register)
    public function store()
    {
        $userModel = new User();

        // Ambil semua data dari form
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'email'    => $_POST['email'],
            'nama_lengkap' => $_POST['nama_lengkap'],
            'nik'          => $_POST['nik'],
            'tgl_lahir'    => $_POST['tgl_lahir'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'no_hp'        => $_POST['no_hp'],
            'status_pernikahan' => $_POST['status_pernikahan'],
            'pekerjaan'    => $_POST['pekerjaan'],
            'alamat'       => $_POST['alamat']
        ];

        if ($userModel->register($data)) {
            // Redirect ke login dengan pesan sukses
            header('Location: ' . BASEURL . '/auth/login?status=success');
        } else {
            // Redirect kembali ke register jika gagal
            header('Location: ' . BASEURL . '/auth/register?status=failed');
        }
    }

    // Proses Login (POST dari form login)
    public function authenticate()
    {
        $userModel = new User();
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $userModel->login($username, $password);

        if ($user) {
            // Set Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['role'] = $user['role'];

            // Redirect sesuai role
            if ($user['role'] == 'admin') {
                header('Location: ' . BASEURL . '/admin');
            } else {
                header('Location: ' . BASEURL . '/pasien');
            }
        } else {
            // Login gagal
            header('Location: ' . BASEURL . '/auth/login?status=error');
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASEURL . '/auth/login');
    }
}
