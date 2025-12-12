<div class="container mt-4 mb-5">

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <a href="<?= BASEURL; ?>/pasien" class="btn btn-outline-secondary rounded-pill px-4 btn-back">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                </a>

            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 h-100 score-card">
                <div class="card-header bg-white border-0 py-3 text-center">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-clipboard-data me-2 text-primary"></i>Ringkasan Skrining
                    </h5>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-4">

                    <div class="score-circle-wrapper mb-4">
                        <?php
                        $badge = 'success';
                        $bgColor = 'rgba(16, 185, 129, 0.1)';
                        $scoreColor = '#10b981';

                        if ($data['detail']['kategori_risiko'] == 'Tinggi') { // Sesuaikan value DB
                            $badge = 'danger';
                            $bgColor = 'rgba(239, 68, 68, 0.1)';
                            $scoreColor = '#ef4444';
                        } elseif ($data['detail']['kategori_risiko'] == 'Sedang') {
                            $badge = 'warning';
                            $bgColor = 'rgba(245, 158, 11, 0.1)';
                            $scoreColor = '#f59e0b';
                        }
                        ?>

                        <div class="score-circle" style="background: <?= $bgColor; ?>">
                            <div class="score-content">
                                <h1 class="display-2 fw-bold mb-0" style="color: <?= $scoreColor; ?>">
                                    <?= $data['detail']['total_skor']; ?>
                                </h1>
                                <span class="fs-5 text-muted">/100</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <?php
                        $icon = 'bi-shield-check-fill';
                        if ($data['detail']['kategori_risiko'] == 'Tinggi') {
                            $icon = 'bi-exclamation-triangle-fill';
                        } elseif ($data['detail']['kategori_risiko'] == 'Sedang') {
                            $icon = 'bi-exclamation-circle-fill';
                        }
                        ?>
                        <span class="badge badge-<?= $badge; ?> px-4 py-3 fs-5 fw-semibold">
                            <i class="bi <?= $icon; ?> me-2"></i><?= $data['detail']['kategori_risiko']; ?>
                        </span>
                    </div>

                    <div class="date-info-box">
                        <div class="icon-wrapper mb-2">
                            <i class="bi bi-calendar-event text-primary fs-3"></i>
                        </div>
                        <p class="text-muted small mb-1">Tanggal Skrining</p>
                        <p class="fw-bold text-dark mb-0">
                            <?= date('d F Y', strtotime($data['detail']['tanggal_skrining'])); ?>
                        </p>
                        <small class="text-muted">
                            <i class="bi bi-clock"></i> <?= date('H:i', strtotime($data['detail']['tanggal_skrining'])); ?> WITA
                        </small>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 h-100">

                <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center text-white">
                            <div class="header-icon me-3">
                                <i class="bi bi-heart-pulse-fill fs-3"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">Hasil Konsultasi Dokter</h5>
                                <small class="opacity-90">Analisis medis dari tenaga kesehatan profesional</small>
                            </div>
                        </div>
                        <?php if ($data['detail']['feedback_admin']): ?>
                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                                <i class="bi bi-check-circle-fill me-1"></i>Selesai
                            </span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                <i class="bi bi-hourglass-split me-1"></i>Menunggu
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-body p-4 p-lg-5">

                    <?php if ($data['detail']['feedback_admin']): ?>

                        <div class="diagnosis-section mb-4">
                            <div class="section-label mb-3">
                                <i class="bi bi-clipboard2-pulse text-primary me-2"></i>
                                <span class="text-muted small fw-bold text-uppercase">Diagnosa Medis</span>
                            </div>
                            <div class="diagnosis-box">
                                <h4 class="fw-bold text-dark mb-0"><?= $data['detail']['diagnosa']; ?></h4>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="feedback-section mb-4">
                            <div class="section-label mb-3">
                                <i class="bi bi-chat-left-text text-primary me-2"></i>
                                <span class="text-muted small fw-bold text-uppercase">Saran & Resep Dokter</span>
                            </div>
                            <div class="feedback-box">
                                <div class="feedback-content">
                                    <p class="mb-0" style="white-space: pre-line; font-size: 1.05rem; line-height: 1.8; color: #374151;">
                                        <?= $data['detail']['feedback_admin']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="validation-section mt-4">
                            <div class="card border-0 shadow-sm rounded-3" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="doctor-icon me-3">
                                            <i class="bi bi-person-check-fill text-primary fs-2"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold text-dark mb-1">Divalidasi oleh Dokter</h6>
                                            <p class="text-muted small mb-0">
                                                <i class="bi bi-person-badge me-1"></i>Administrator
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <p class="text-muted small mb-0">
                                                <i class="bi bi-calendar-check me-1"></i>
                                                <?php
                                                if (!empty($data['detail']['tanggal_feedback'])) {
                                                    echo date('d M Y', strtotime($data['detail']['tanggal_feedback']));
                                                } else {
                                                    echo date('d M Y');
                                                }
                                                ?>
                                            </p>
                                            <p class="text-muted small mb-0">
                                                <i class="bi bi-clock me-1"></i>
                                                <?php
                                                if (!empty($data['detail']['tanggal_feedback'])) {
                                                    echo date('H:i', strtotime($data['detail']['tanggal_feedback']));
                                                } else {
                                                    echo date('H:i');
                                                }
                                                ?> WITA
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="action-section mt-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="<?= BASEURL; ?>/skrining" class="btn btn-outline-primary btn-lg w-100 rounded-pill">
                                        <i class="bi bi-arrow-repeat me-2"></i>Skrining Ulang
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?= BASEURL; ?>/skrining/cetak/<?= $data['detail']['id']; ?>" target="_blank" class="btn btn-success btn-lg w-100 rounded-pill">
                                        <i class="bi bi-download me-2"></i>Unduh Laporan
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>

                        <div class="pending-state text-center py-5">
                            <div class="pending-animation mb-4">
                                <div class="pending-icon">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold text-dark mb-3">Sedang Dalam Tinjauan Dokter</h5>
                            <p class="text-muted mb-4 px-3">
                                Tim dokter kami sedang menganalisa hasil skrining Anda dengan teliti.<br>
                                Mohon bersabar, feedback akan segera tersedia.
                            </p>

                            <div class="expected-time-box mx-auto">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="bi bi-clock-history text-primary me-2 fs-5"></i>
                                    <div class="text-start">
                                        <p class="mb-0 small text-muted">Estimasi waktu tinjauan</p>
                                        <p class="mb-0 fw-bold text-dark">1-2 hari kerja</p>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info border-0 shadow-sm mt-4 mx-auto" style="max-width: 500px;">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-info-circle-fill me-3 fs-5"></i>
                                    <div class="text-start">
                                        <p class="mb-0 small">
                                            <strong>Tip:</strong> Anda dapat mencetak hasil skrining sementara meskipun belum ada feedback dokter.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>

    <?php if ($data['detail']['feedback_admin']): ?>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 bg-light">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-lightbulb-fill text-warning fs-2 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-2">Catatan Penting</h6>
                                        <p class="mb-0 small text-muted">
                                            Hasil skrining ini bersifat indikatif dan tidak menggantikan diagnosis medis profesional.
                                            Untuk pemeriksaan lebih lanjut, konsultasikan dengan dokter spesialis.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <a href="<?= BASEURL; ?>/pasien" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="bi bi-clock-history me-2"></i>Lihat Semua Riwayat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<style>
    .score-card {
        animation: slideInLeft 0.6s ease;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .score-circle-wrapper {
        position: relative;
        width: 200px;
        height: 200px;
    }

    .score-circle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 180px;
        height: 180px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .badge-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .badge-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .badge-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .date-info-box {
        background: rgba(102, 126, 234, 0.05);
        border-radius: 12px;
        padding: 1.5rem;
        width: 100%;
    }

    .header-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .diagnosis-box {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%);
        border-left: 4px solid #667eea;
        padding: 1.5rem;
        border-radius: 12px;
    }

    .feedback-box {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
    }

    .doctor-icon {
        width: 50px;
        height: 50px;
        background: rgba(102, 126, 234, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pending-state {
        animation: fadeIn 0.6s ease;
    }

    .pending-animation {
        animation: fadeIn 0.6s ease 0.3s both;
    }

    .pending-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.1) 100%);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .pending-icon i {
        font-size: 3rem;
        color: #f59e0b;
        animation: hourglass 2s ease-in-out infinite;
    }

    @keyframes hourglass {

        0%,
        100% {
            transform: rotate(0deg);
        }

        50% {
            transform: rotate(180deg);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .expected-time-box {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        max-width: 300px;
    }

    .btn-back,
    .btn-print {
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        transform: translateX(-5px);
    }

    .btn-print:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4) !important;
    }

    .card {
        transition: all 0.3s ease;
    }

    .action-section {
        animation: fadeIn 0.6s ease 0.5s both;
    }

    html {
        scroll-behavior: smooth;
    }
</style>