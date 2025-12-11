<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container-fluid px-4 py-4">

    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark"><i class="bi bi-people-gear text-primary me-2"></i>Manajemen Pengguna</h2>
            <p class="text-muted">Kelola akun pasien, reset password, dan hapus data.</p>
        </div>
    </div>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'reset_success'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> Password user telah direset menjadi: <strong>123456</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($_GET['status'] == 'deleted'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Terhapus!</strong> Data user berhasil dihapus dari sistem.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="tabelUsers" class="table table-hover align-middle w-100">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username / Email</th>
                            <th>NIK</th>
                            <th>No HP</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data['users'] as $u): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= $u['nama_lengkap']; ?></div>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info rounded-pill" style="font-size: 10px;">Pasien</span>
                                </td>
                                <td>
                                    <div class="small fw-bold"><?= $u['username']; ?></div>
                                    <div class="text-muted small"><?= $u['email']; ?></div>
                                </td>
                                <td><?= $u['nik']; ?></td>
                                <td><?= $u['no_hp']; ?></td>
                                <td class="text-end">
                                    <a href="<?= BASEURL; ?>/admin/resetUser/<?= $u['id']; ?>"
                                        class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm"
                                        onclick="return confirm('Yakin ingin mereset password user ini menjadi 123456?')">
                                        <i class="bi bi-key-fill"></i> Reset Pass
                                    </a>

                                    <a href="<?= BASEURL; ?>/admin/deleteUser/<?= $u['id']; ?>"
                                        class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm ms-1"
                                        onclick="return confirm('PERINGATAN: Menghapus user ini akan menghapus semua riwayat skriningnya juga. Lanjutkan?')">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabelUsers').DataTable({
            "language": {
                "search": "Cari User:",
                "paginate": {
                    "next": "›",
                    "previous": "‹"
                }
            }
        });
    });
</script>