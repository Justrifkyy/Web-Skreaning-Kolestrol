<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid px-0 px-md-2">

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h2 class="fw-bold text-dark mb-2">
                        <i class="bi bi-speedometer2 text-primary me-2"></i>Dashboard Overview
                    </h2>
                    <p class="text-muted mb-0">Ringkasan aktivitas skrining kesehatan pasien KoloCheck</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="window.location.reload()">
                        <i class="bi bi-arrow-clockwise me-1"></i>Refresh
                    </button>
                    <a href="<?= BASEURL; ?>/admin/pasien" class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="bi bi-people-fill me-1"></i>Lihat Semua Data
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-1">Total Pasien</h6>
                            <h2 class="display-5 fw-bold mb-0 text-primary"><?= $data['stats']['total_pasien']; ?></h2>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-people-fill text-primary fs-3"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-graph-up me-1"></i>
                        <span>Total user terdaftar</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-1">Risiko Tinggi</h6>
                            <h2 class="display-5 fw-bold mb-0 text-danger"><?= $data['stats']['total_tinggi']; ?></h2>
                        </div>
                        <div class="stat-icon bg-danger bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-3"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-heart-pulse me-1"></i>
                        <span>Perlu perhatian khusus</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-1">Menunggu Feedback</h6>
                            <h2 class="display-5 fw-bold mb-0 text-warning"><?= $data['stats']['belum_feedback']; ?></h2>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-hourglass-split text-warning fs-3"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-clock-history me-1"></i>
                        <span>Menunggu validasi dokter</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-1">Selesai Validasi</h6>
                            <h2 class="display-5 fw-bold mb-0 text-success"><?= $data['stats']['sudah_feedback']; ?></h2>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-check-circle-fill text-success fs-3"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-shield-check me-1"></i>
                        <span>Telah diberi feedback</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="mb-1 fw-bold">
                        <i class="bi bi-pie-chart-fill text-primary me-2"></i>Sebaran Tingkat Risiko
                    </h5>
                    <p class="text-muted small mb-0">Distribusi kategori risiko seluruh pasien</p>
                </div>
                <div class="card-body pt-2">
                    <div class="chart-container" style="position: relative; height: 280px;">
                        <canvas id="chartRisiko"></canvas>
                    </div>
                    <div class="row g-2 mt-3 text-center">
                        <div class="col-4 border-end">
                            <div class="small text-danger fw-bold">Tinggi</div>
                            <div class="h5 mb-0"><?= $data['stats']['total_tinggi']; ?></div>
                        </div>
                        <div class="col-4 border-end">
                            <div class="small text-warning fw-bold">Sedang</div>
                            <div class="h5 mb-0"><?= $data['stats']['total_sedang']; ?></div>
                        </div>
                        <div class="col-4">
                            <div class="small text-success fw-bold">Rendah</div>
                            <div class="h5 mb-0"><?= $data['stats']['total_rendah']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="mb-1 fw-bold">
                        <i class="bi bi-bar-chart-fill text-primary me-2"></i>Produktivitas Feedback
                    </h5>
                    <p class="text-muted small mb-0">Status pemberian saran medis dokter</p>
                </div>
                <div class="card-body pt-2">
                    <div class="chart-container" style="position: relative; height: 280px;">
                        <canvas id="chartFeedback"></canvas>
                    </div>
                    <div class="mt-4 px-3">
                        <?php
                        $total = $data['stats']['sudah_feedback'] + $data['stats']['belum_feedback'];
                        $percentage = $total > 0 ? round(($data['stats']['sudah_feedback'] / $total) * 100) : 0;
                        ?>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted small">Tingkat Penyelesaian</span>
                            <span class="fw-bold text-primary"><?= $percentage; ?>%</span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $percentage; ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 fw-bold">
                            <i class="bi bi-clock-history text-primary me-2"></i>Pasien Terbaru Masuk
                        </h5>
                        <p class="text-muted small mb-0">5 skrining terakhir yang masuk ke sistem</p>
                    </div>
                    <a href="<?= BASEURL; ?>/admin/pasien" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                        Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 border-0">Nama Pasien</th>
                                    <th class="py-3 border-0">Tanggal</th>
                                    <th class="py-3 border-0 text-center">Skor</th>
                                    <th class="py-3 border-0">Risiko</th>
                                    <th class="py-3 border-0 text-end pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($data['terbaru'])): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">Belum ada data masuk.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($data['terbaru'] as $row): ?>
                                        <tr class="patient-row">
                                            <td class="ps-4 fw-bold text-dark">
                                                <i class="bi bi-person-circle text-secondary me-2"></i><?= $row['nama_lengkap']; ?>
                                            </td>
                                            <td class="text-muted small">
                                                <?= date('d M, H:i', strtotime($row['tanggal_skrining'])); ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark border"><?= $row['total_skor']; ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                $badge = 'secondary';
                                                if ($row['kategori_risiko'] == 'Tinggi') $badge = 'danger';
                                                elseif ($row['kategori_risiko'] == 'Sedang') $badge = 'warning';
                                                elseif ($row['kategori_risiko'] == 'Rendah') $badge = 'success';
                                                ?>
                                                <span class="badge bg-<?= $badge; ?> bg-opacity-10 text-<?= $badge; ?> px-2 py-1 rounded-pill">
                                                    <?= $row['kategori_risiko']; ?>
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="<?= BASEURL; ?>/admin/feedback/<?= $row['id']; ?>" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                                    Review
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // --- Chart Global Config ---
    Chart.defaults.font.family = "'Segoe UI', 'Helvetica', sans-serif";
    Chart.defaults.color = '#6c757d';

    // --- 1. Chart Risiko (Doughnut) ---
    const ctxRisiko = document.getElementById('chartRisiko').getContext('2d');
    new Chart(ctxRisiko, {
        type: 'doughnut',
        data: {
            labels: ['Tinggi', 'Sedang', 'Rendah'],
            datasets: [{
                data: [
                    <?= $data['stats']['total_tinggi']; ?>,
                    <?= $data['stats']['total_sedang']; ?>,
                    <?= $data['stats']['total_rendah']; ?>
                ],
                backgroundColor: ['#dc3545', '#ffc107', '#198754'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // --- 2. Chart Feedback (Bar) ---
    const ctxFeedback = document.getElementById('chartFeedback').getContext('2d');
    new Chart(ctxFeedback, {
        type: 'bar',
        data: {
            labels: ['Selesai', 'Menunggu'],
            datasets: [{
                label: 'Jumlah Pasien',
                data: [
                    <?= $data['stats']['sudah_feedback']; ?>,
                    <?= $data['stats']['belum_feedback']; ?>
                ],
                backgroundColor: ['#198754', '#ffc107'],
                borderRadius: 5,
                barPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [2, 4]
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

<style>
    /* CSS Tambahan untuk Mempercantik */
    .stat-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1) !important;
    }

    .patient-row:hover {
        background-color: #f8f9fa;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>