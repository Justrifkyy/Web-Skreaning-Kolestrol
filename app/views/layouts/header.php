<?php
// Logika Menu Aktif
$current_url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
$url_segments = explode('/', $current_url);
$main_segment = $url_segments[0];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KoloCheck - Skrining Kolesterol</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar Custom */
        .navbar-custom {
            background-color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: #33604bff !important;
            /* Hijau UMI */
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-logo {
            height: 40px;
            width: auto;
        }

        /* Menu Links */
        .nav-link {
            color: #555 !important;
            font-weight: 500;
            margin: 0 5px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link.active {
            color: #198754 !important;
        }

        .nav-link.active::after {
            width: none;
        }

        /* Tombol Khusus */
        .btn-check-free {
            background: linear-gradient(135deg, #ffc107 0%, #ffca2c 100%);
            color: #212529 !important;
            font-weight: 600;
            border: none;
            box-shadow: 0 4px 6px rgba(255, 193, 7, 0.3);
            transition: transform 0.2s;
        }

        .btn-check-free:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(255, 193, 7, 0.4);
        }

        .btn-login {
            border: 2px solid #198754;
            color: #198754;
            font-weight: 600;
        }

        .btn-login:hover {
            background-color: #198754;
            color: white;
        }

        .btn-register {
            background-color: #198754;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);
        }

        .btn-register:hover {
            background-color: #157347;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">

            <a class="navbar-brand" href="<?= BASEURL; ?>">
                <div class="d-flex align-items-center gap-2">
                    <img src="<?= BASEURL; ?>/assets/img/umi.png" alt="UMI" class="navbar-logo">
                    <img src="<?= BASEURL; ?>/assets/img/fkm.png" alt="FKM" class="navbar-logo">
                    <span class="bi bi-heart-pulse-fill me-1"> KoloCheck</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto me-4">

                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($main_segment == 'admin' && !isset($url_segments[1])) ? 'active' : ''; ?>" href="<?= BASEURL; ?>/admin">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($main_segment == 'admin' && isset($url_segments[1]) && $url_segments[1] == 'pasien') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/admin/pasien">Data Pasien</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($url_segments[1]) && $url_segments[1] == 'users') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/admin/users">Manajemen User</a>
                        </li>

                    <?php elseif (isset($_SESSION['user_id']) && $_SESSION['role'] == 'pasien'): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($main_segment == 'pasien') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/pasien">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($main_segment == 'skrining') ? 'active' : ''; ?>" href="<?= BASEURL; ?>/skrining">Mulai Skrining</a>
                        </li>

                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($main_segment == 'home' || $main_segment == '') ? 'active' : ''; ?>" href="<?= BASEURL; ?>">Beranda</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <div class="d-flex align-items-center gap-2">

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="dropdown">
                            <a class="btn btn-outline-success dropdown-toggle d-flex align-items-center gap-2 rounded-pill px-3" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-5"></i>
                                <span><?= explode(' ', $_SESSION['nama_lengkap'])[0]; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3">
                                <li>
                                    <h6 class="dropdown-header">Halo, <?= $_SESSION['nama_lengkap']; ?></h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>/profil"><i class="bi bi-gear me-2"></i>Edit Profil</a></li>
                                <li><a class="dropdown-item text-danger" href="<?= BASEURL; ?>/auth/logout"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                            </ul>
                        </div>

                    <?php else: ?>
                        <a href="<?= BASEURL; ?>/skrining" class="btn btn-check-free rounded-pill px-3 py-2 d-none">
                            <i class="bi bi-heart-pulse me-1"></i> Cek Gratis
                        </a>
                        <a href="<?= BASEURL; ?>/auth/login" class="btn btn-login rounded-pill px-4">Masuk</a>
                        <a href="<?= BASEURL; ?>/auth/register" class="btn btn-register rounded-pill px-4">Daftar</a>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </nav>