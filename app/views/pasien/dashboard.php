<?php
// Ambil data terakhir untuk Quick Status
$terakhir = !empty($riwayat) ? $riwayat[0] : null;
$nama_depan = explode(' ', $_SESSION['nama_lengkap'])[0];
?>

<style>
    :root {
        --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --gradient-success: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --gradient-warning: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --gradient-danger: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.12);
    }

    /* Hero Section dengan Gradient Modern */
    .hero-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 24px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .hero-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .hero-card::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite reverse;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    /* Card Styling */
    .stat-card {
        border: none;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    /* Icon Box dengan Efek Glassmorphism */
    .icon-box-lg {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        font-size: 2.5rem;
        margin: 0 auto 20px auto;
        position: relative;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .icon-box-lg:hover {
        transform: scale(1.1) rotate(5deg);
    }

    /* Status Badge dengan Gradient */
    .status-badge {
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: var(--shadow-sm);
    }

    /* Table Custom Styling */
    .table-custom {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead th {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 1px;
        color: #475569;
        border: none;
        padding: 18px 24px;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table-custom thead th:first-child {
        border-top-left-radius: 16px;
    }

    .table-custom thead th:last-child {
        border-top-right-radius: 16px;
    }

    .table-custom tbody tr {
        transition: all 0.3s ease;
        background: white;
    }

    .table-custom tbody tr:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .table-custom tbody td {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    /* Risk Badge dengan Efek Shine */
    .risk-badge {
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .risk-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .risk-badge:hover::before {
        left: 100%;
    }

    /* Button Actions dengan Micro Interactions */
    .btn-action {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 12px;
        font-weight: 600;
        position: relative;
        overflow: hidden;
    }

    .btn-action::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.5s, height 0.5s;
    }

    .btn-action:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-action:active {
        transform: translateY(0);
    }

    /* Alert Styling */
    .alert-success-custom {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border: 2px solid #6ee7b7;
        border-radius: 16px;
        box-shadow: var(--shadow-md);
    }

    /* Empty State */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state img {
        max-width: 120px;
        opacity: 0.4;
        filter: grayscale(100%);
        margin-bottom: 24px;
        animation: float 3s ease-in-out infinite;
    }

    /* Score Display */
    .score-display {
        font-size: 3rem;
        font-weight: 800;
        line-height: 1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Card Header */
    .card-header-custom {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-bottom: 2px solid #e2e8f0;
        border-radius: 20px 20px 0 0 !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-card {
            border-radius: 20px;
            padding: 2rem 1.5rem !important;
        }

        .icon-box-lg {
            width: 70px;
            height: 70px;
            font-size: 2rem;
        }

        .table-custom thead th,
        .table-custom tbody td {
            padding: 12px 16px;
        }

        .score-display {
            font-size: 2.5rem;
        }
    }

    /* Pulse Animation untuk Icon */
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    .pulse-icon {
        animation: pulse 2s ease-in-out infinite;
    }
</style>

<div class="container-fluid px-3 px-md-4">
    <!-- Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="hero-card shadow-lg p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-md-8 mb-3 mb-md-0 position-relative" style="z-index: 2;">
                        <div class="mb-2">
                            <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill">
                                <i class="bi bi-calendar-check me-2"></i><?= date('l, d F Y'); ?>
                            </span>
                        </div>
                        <h1 class="fw-bold mb-3" style="font-size: 2.5rem;">Halo, <?= $nama_depan; ?>! 👋</h1>
                        <p class="fs-5 mb-0 opacity-90" style="line-height: 1.6;">
                            Kesehatan adalah investasi terbaik. Pantau risiko kolesterolmu hari ini.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end position-relative" style="z-index: 2;">
                        <a href="<?= BASEURL; ?>/skrining" class="btn btn-light text-primary fw-bold px-4 py-3 rounded-pill shadow-sm btn-action d-inline-flex align-items-center gap-2">
                            <i class="bi bi-clipboard2-pulse-fill fs-5"></i>
                            <span>Skrining Baru</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Status Card -->
        <div class="col-lg-4">
            <div class="stat-card shadow-sm h-100 position-relative">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="text-uppercase text-muted fw-bold mb-0" style="letter-spacing: 1px; font-size: 0.75rem;">
                            <i class="bi bi-activity me-2"></i>Status Terakhir
                        </h6>
                        <?php if ($terakhir): ?>
                            <span class="status-badge bg-light border">
                                <i class="bi bi-calendar3"></i>
                                <?= date('d M Y', strtotime($terakhir['tanggal_skrining'])); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php if ($terakhir): ?>
                        <?php
                        $color = 'success';
                        $icon = 'bi-shield-check';
                        $gradient = 'linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%)';
                        $iconColor = '#10b981';

                        if ($terakhir['kategori_risiko'] == 'Sedang') {
                            $color = 'warning';
                            $icon = 'bi-exclamation-triangle-fill';
                            $gradient = 'linear-gradient(135deg, #fef3c7 0%, #fde68a 100%)';
                            $iconColor = '#f59e0b';
                        } elseif ($terakhir['kategori_risiko'] == 'Tinggi') {
                            $color = 'danger';
                            $icon = 'bi-heart-pulse-fill';
                            $gradient = 'linear-gradient(135deg, #fecaca 0%, #fca5a5 100%)';
                            $iconColor = '#ef4444';
                        }
                        ?>

                        <div class="text-center py-4">
                            <div class="icon-box-lg shadow-sm mb-3" style="background: <?= $gradient; ?>; color: <?= $iconColor; ?>;">
                                <i class="bi <?= $icon; ?> pulse-icon"></i>
                            </div>
                            <h2 class="fw-bold mb-2" style="color: <?= $iconColor; ?>; font-size: 2rem;">
                                <?= $terakhir['kategori_risiko']; ?>
                            </h2>
                            <div class="mb-3">
                                <span class="text-muted small me-2">Total Skor</span>
                                <span class="score-display"><?= $terakhir['total_skor']; ?></span>
                                <span class="text-muted" style="font-size: 1.5rem;">/100</span>
                            </div>

                            <!-- Progress Bar -->
                            <div class="progress mb-4" style="height: 8px; border-radius: 10px; background: #f1f5f9;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: <?= $terakhir['total_skor']; ?>%; background: <?= $gradient; ?>;"
                                    aria-valuenow="<?= $terakhir['total_skor']; ?>"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <a href="<?= BASEURL; ?>/skrining/detail/<?= $terakhir['id']; ?>"
                                class="btn btn-<?= $color; ?> rounded-pill w-100 py-3 btn-action fw-bold shadow-sm">
                                <i class="bi bi-file-text me-2"></i>Lihat Detail & Saran
                            </a>
                        </div>

                    <?php else: ?>
                        <div class="empty-state">
                            <div class="icon-box-lg bg-light text-secondary mb-3">
                                <i class="bi bi-clipboard-x"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">Belum Ada Data</h5>
                            <p class="text-muted mb-4">Anda belum melakukan pemeriksaan skrining.</p>
                            <a href="<?= BASEURL; ?>/skrining"
                                class="btn btn-primary rounded-pill px-4 py-3 btn-action fw-bold shadow-sm">
                                <i class="bi bi-play-fill me-2"></i>Mulai Sekarang
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- History Card -->
        <div class="col-lg-8">
            <?php if (isset($_GET['status']) && $_GET['status'] == 'skrining_success'): ?>
                <div class="alert alert-success-custom alert-dismissible fade show border-0 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="icon-box-lg me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; font-size: 1.5rem;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-success">Data Berhasil Disimpan!</h6>
                            <p class="mb-0 small text-success">Silakan tunggu review dari dokter pada menu detail.</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="stat-card shadow-sm h-100 position-relative">
                <div class="card-header card-header-custom border-0 py-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Pemeriksaan
                        </h5>
                        <?php if (!empty($riwayat)): ?>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">
                                <?= count($riwayat); ?> Skrining
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-body p-0">
                    <?php if (empty($riwayat)): ?>
                        <div class="empty-state">
                            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" alt="Empty">
                            <h6 class="fw-bold text-dark mb-2">Belum Ada Riwayat</h6>
                            <p class="text-muted small">Mulai pemeriksaan pertama Anda sekarang.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="bi bi-calendar3 me-2"></i>Waktu Periksa</th>
                                        <th><i class="bi bi-bar-chart-fill me-2"></i>Total Skor</th>
                                        <th><i class="bi bi-shield-fill me-2"></i>Kategori</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($riwayat as $r): ?>
                                        <?php
                                        $badgeClass = 'bg-secondary';
                                        $badgeGradient = 'linear-gradient(135deg, #6b7280 0%, #4b5563 100%)';
                                        $dotColor = '#6b7280';

                                        if ($r['kategori_risiko'] == 'Rendah') {
                                            $badgeClass = 'bg-success';
                                            $badgeGradient = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
                                            $dotColor = '#10b981';
                                        }
                                        if ($r['kategori_risiko'] == 'Sedang') {
                                            $badgeClass = 'bg-warning';
                                            $badgeGradient = 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)';
                                            $dotColor = '#f59e0b';
                                        }
                                        if ($r['kategori_risiko'] == 'Tinggi') {
                                            $badgeClass = 'bg-danger';
                                            $badgeGradient = 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)';
                                            $dotColor = '#ef4444';
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="fw-bold text-dark mb-1">
                                                    <?= date('d M Y', strtotime($r['tanggal_skrining'])); ?>
                                                </div>
                                                <div class="small text-muted">
                                                    <i class="bi bi-clock me-1"></i><?= date('H:i', strtotime($r['tanggal_skrining'])); ?> WIB
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div style="width: 10px; height: 10px; border-radius: 50%; background: <?= $dotColor; ?>; box-shadow: 0 0 10px <?= $dotColor; ?>;"></div>
                                                    <span class="fw-bold fs-5" style="color: <?= $dotColor; ?>;"><?= $r['total_skor']; ?></span>
                                                    <span class="text-muted">/100</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="risk-badge text-white" style="background: <?= $badgeGradient; ?>;">
                                                    <i class="bi bi-dot"></i><?= $r['kategori_risiko']; ?>
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex align-items-center justify-content-end gap-2">
                                                    <?php if ($r['feedback_admin']): ?>
                                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill"
                                                            data-bs-toggle="tooltip"
                                                            title="Feedback Dokter Tersedia">
                                                            <i class="bi bi-check-circle-fill me-1"></i>Reviewed
                                                        </span>
                                                    <?php endif; ?>

                                                    <a href="<?= BASEURL; ?>/skrining/detail/<?= $r['id']; ?>"
                                                        class="btn btn-primary btn-sm btn-action px-3 py-2 shadow-sm">
                                                        <i class="bi bi-eye-fill me-1"></i>Detail
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Aktifkan Tooltip Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Auto dismiss alert after 5 seconds
        setTimeout(function() {
            var alert = document.querySelector('.alert');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    });
</script>