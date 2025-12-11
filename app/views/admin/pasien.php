<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid px-3 px-md-4 py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h2 class="fw-bold text-dark mb-2">
                        <i class="bi bi-people-fill text-primary me-2"></i>Data Pasien Skrining
                    </h2>
                    <p class="text-muted mb-0 small">Kelola hasil tes dan berikan feedback medis kepada pasien</p>
                </div>
                <div>
                    <a href="<?= BASEURL; ?>/admin/export" target="_blank" class="btn btn-success btn-sm shadow-sm rounded-pill px-3">
                        <i class="bi bi-file-earmark-excel-fill me-2"></i>
                        <span class="d-none d-sm-inline">Export Excel</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4 d-none d-lg-flex">
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3"><i class="bi bi-people-fill text-primary fs-4"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 small">Total Pasien</h6>
                            <h4 class="mb-0 fw-bold"><?= count($data['screenings']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3"><i class="bi bi-check2-circle text-success fs-4"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 small">Selesai</h6>
                            <h4 class="mb-0 fw-bold"><?= count(array_filter($data['screenings'], function ($s) {
                                                            return !empty($s['feedback_admin']);
                                                        })); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3"><i class="bi bi-hourglass-split text-warning fs-4"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 small">Menunggu</h6>
                            <h4 class="mb-0 fw-bold"><?= count(array_filter($data['screenings'], function ($s) {
                                                            return empty($s['feedback_admin']);
                                                        })); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-danger bg-opacity-10 rounded-3 p-3"><i class="bi bi-exclamation-triangle-fill text-danger fs-4"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 small">Risiko Tinggi</h6>
                            <h4 class="mb-0 fw-bold"><?= count(array_filter($data['screenings'], function ($s) {
                                                            return $s['kategori_risiko'] == 'Tinggi';
                                                        })); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-3 p-md-4">
                    <div class="table-responsive">
                        <table id="tabelPasien" class="table table-hover align-middle w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-3 border-0">Pasien</th>
                                    <th class="py-3 border-0 d-none d-md-table-cell">Waktu Tes</th>
                                    <th class="py-3 text-center border-0">Skor</th>
                                    <th class="py-3 border-0 d-none d-lg-table-cell">Kategori Risiko</th>
                                    <th class="py-3 border-0 d-none d-xl-table-cell">Status</th>
                                    <th class="py-3 px-3 border-0 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['screenings'] as $row) : ?>
                                    <tr class="patient-row">
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-3 bg-primary bg-gradient text-white d-flex justify-content-center align-items-center rounded-circle fw-bold shadow-sm"
                                                    style="width: 40px; height: 40px; font-size: 14px; min-width: 40px;">
                                                    <?= strtoupper(substr($row['nama_lengkap'], 0, 2)); ?>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <div class="fw-bold text-dark text-truncate"><?= $row['nama_lengkap']; ?></div>
                                                    <div class="small text-muted text-truncate d-none d-sm-block">
                                                        <i class="bi bi-envelope me-1"></i><?= isset($row['email']) ? $row['email'] : '-'; ?>
                                                    </div>
                                                    <div class="small text-muted d-md-none mt-1">
                                                        <i class="bi bi-calendar-event me-1"></i><?= date('d/m/y', strtotime($row['tanggal_skrining'])); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="d-none d-md-table-cell">
                                            <div class="text-muted small">
                                                <div class="mb-1"><i class="bi bi-calendar-event me-1"></i><?= date('d M Y', strtotime($row['tanggal_skrining'])); ?></div>
                                                <div><i class="bi bi-clock me-1"></i><?= date('H:i', strtotime($row['tanggal_skrining'])); ?> WITA</div>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <div class="score-badge bg-light rounded-3 d-inline-block px-3 py-2">
                                                <h5 class="fw-bold mb-0 text-primary"><?= $row['total_skor']; ?></h5>
                                            </div>
                                            <div class="d-lg-none mt-2">
                                                <span class="badge bg-light text-dark border"><?= $row['kategori_risiko']; ?></span>
                                            </div>
                                        </td>

                                        <td class="d-none d-lg-table-cell">
                                            <?php
                                            $badgeClass = 'bg-light text-dark border';
                                            $icon = '';
                                            if ($row['kategori_risiko'] == 'Tinggi') {
                                                $badgeClass = 'bg-danger text-white';
                                                $icon = '<i class="bi bi-exclamation-triangle-fill me-1"></i>';
                                            } elseif ($row['kategori_risiko'] == 'Sedang') {
                                                $badgeClass = 'bg-warning text-dark';
                                                $icon = '<i class="bi bi-exclamation-circle-fill me-1"></i>';
                                            } else {
                                                $badgeClass = 'bg-success text-white';
                                                $icon = '<i class="bi bi-shield-check-fill me-1"></i>';
                                            }
                                            ?>
                                            <span class="badge rounded-pill fw-normal px-3 py-2 <?= $badgeClass; ?> shadow-sm">
                                                <?= $icon . $row['kategori_risiko']; ?>
                                            </span>
                                        </td>

                                        <td class="d-none d-xl-table-cell">
                                            <?php if (!empty($row['feedback_admin'])): ?>
                                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill border border-primary">
                                                    <i class="bi bi-check2-all me-1"></i>Selesai
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill border border-secondary">
                                                    <i class="bi bi-hourglass-split me-1"></i>Menunggu
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-end px-3">
                                            <?php if (!empty($row['feedback_admin'])): ?>
                                                <a href="<?= BASEURL; ?>/admin/feedback/<?= $row['id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm">
                                                    <i class="bi bi-pencil-square"></i> <span class="d-none d-sm-inline ms-1">Edit</span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= BASEURL; ?>/admin/feedback/<?= $row['id']; ?>" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                                                    <i class="bi bi-chat-text-fill"></i> <span class="d-none d-sm-inline ms-1">Balas</span>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabelPasien').DataTable({
            "pageLength": 10, // INI YANG MEMBATASI 10 DATA
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Semua"]
            ],
            "language": {
                "search": "Cari:",
                "searchPlaceholder": "Nama, email...",
                "lengthMenu": "Tampil _MENU_",
                "info": "Hal _PAGE_ dari _PAGES_",
                "paginate": {
                    "next": "›",
                    "previous": "‹"
                },
                "zeroRecords": "Tidak ditemukan data yang cocok",
                "infoEmpty": "Data kosong",
                "infoFiltered": "(total _MAX_ data)"
            },
            "order": [], // Urutan default ikut database (terbaru)
            "responsive": true,
            "dom": '<"row mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>'
        });
    });
</script>

<style>
    /* Styling Tambahan */
    body {
        background-color: #f8f9fa;
    }

    .avatar-circle {
        flex-shrink: 0;
        transition: transform 0.2s ease;
    }

    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .patient-row {
        transition: all 0.2s ease;
    }

    .table-hover tbody .patient-row:hover {
        background-color: #f8f9fa;
        transform: scale(1.002);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        position: relative;
        z-index: 1;
    }

    .patient-row:hover .score-badge {
        background-color: #e7f1ff !important;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px;
        padding: 5px 15px;
        border: 1px solid #dee2e6;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        outline: none;
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 20px;
        padding: 5px 30px 5px 10px;
        border: 1px solid #dee2e6;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .pagination .page-link {
        color: #0d6efd;
        border-radius: 50%;
        margin: 0 2px;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pagination .page-link:hover {
        background-color: #e9ecef;
    }
</style>