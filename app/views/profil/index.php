<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
    :root {
        --primary: #4361ee;
        --primary-light: #e0e7ff;
        --danger: #e63946;
    }

    body {
        background: #f8f9fa;
    }

    .profile-avatar {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 10px 30px rgba(67, 97, 238, 0.3);
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
    }

    .nav-link.active {
        background: var(--primary) !important;
        color: white !important;
        border-radius: 12px;
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        border-radius: 50px;
        padding: 10px 30px;
        font-weight: 600;
    }

    .btn-danger {
        background: var(--danger);
        border: none;
        border-radius: 50px;
        padding: 10px 30px;
        font-weight: 600;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }
</style>

<div class="container py-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary mb-2">
            <i class="bi bi-person-circle me-2"></i> Profil Saya
        </h2>
        <p class="text-muted fs-5">Kelola informasi pribadi dan keamanan akun Anda</p>
    </div>

    <!-- Alert Messages -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success_update'): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i> Data profil berhasil diperbarui!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'success_password'): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm">
            <i class="bi bi-shield-lock-fill me-2"></i> Password berhasil diubah!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] == 'pass_lama_salah'): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Password lama yang Anda masukkan salah.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] == 'pass_tidak_sama'): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Konfirmasi password baru tidak cocok.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm card-hover sticky-top" style="top: 100px;">
                <div class="card-body text-center py-5">
                    <!-- Foto Profil (bisa diganti dengan upload nanti) -->
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($data['user']['nama_lengkap']); ?>&background=4361ee&color=fff&size=140&rounded=true&bold=true"
                        alt="Avatar" class="rounded-circle profile-avatar mb-3">
                    <h5 class="mb-1"><?= htmlspecialchars($data['user']['nama_lengkap']); ?></h5>
                    <p class="text-muted mb-3">@<?= htmlspecialchars($data['user']['username']); ?></p>
                    <small class="text-muted"><i class="bi bi-envelope me-1"></i> <?= htmlspecialchars($data['user']['email']); ?></small>
                </div>

                <div class="list-group list-group-flush rounded-bottom">
                    <a href="#list-profile" class="list-group-item list-group-item-action py-3 px-4 active" data-bs-toggle="list">
                        <i class="bi bi-person-badge me-3"></i> Edit Data Diri
                    </a>
                    <a href="#list-password" class="list-group-item list-group-item-action py-3 px-4" data-bs-toggle="list">
                        <i class="bi bi-shield-lock me-3"></i> Ganti Password
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="col-lg-9">
            <div class="tab-content" id="nav-tabContent">

                <!-- Tab Edit Profil -->
                <div class="tab-pane fade show active" id="list-profile">
                    <div class="card border-0 shadow-sm card-hover">
                        <div class="card-header bg-white border-0 py-4">
                            <h4 class="mb-0"><i class="bi bi-pencil-square text-primary me-2"></i> Informasi Pribadi</h4>
                        </div>
                        <div class="card-body p-4 p-lg-5">
                            <form action="<?= BASEURL; ?>/profil/update" method="POST">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Username <span class="text-danger">(Tidak dapat diubah)</span></label>
                                        <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($data['user']['username']); ?>" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($data['user']['nama_lengkap']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">NIK</label>
                                        <input type="number" name="nik" class="form-control" value="<?= $data['user']['nik']; ?>" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['user']['email']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">No. Handphone</label>
                                        <input type="text" name="no_hp" class="form-control" value="<?= htmlspecialchars($data['user']['no_hp']); ?>">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir" class="form-control" value="<?= $data['user']['tgl_lahir']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-select">
                                            <option value="Laki-laki" <?= ($data['user']['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="Perempuan" <?= ($data['user']['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" class="form-control" value="<?= htmlspecialchars($data['user']['pekerjaan']); ?>">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                                        <textarea name="alamat" class="form-control" rows="4"><?= htmlspecialchars($data['user']['alamat']); ?></textarea>
                                    </div>
                                </div>

                                <div class="mt-5 text-end">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check2 me-2"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Tab Ganti Password -->
                <div class="tab-pane fade" id="list-password">
                    <div class="card border-0 shadow-sm card-hover">
                        <div class="card-header bg-white border-0 py-4">
                            <h4 class="mb-0"><i class="bi bi-shield-lock text-danger me-2"></i> Keamanan Akun</h4>
                        </div>
                        <div class="card-body p-4 p-lg-5">
                            <form action="<?= BASEURL; ?>/profil/gantiPassword" method="POST">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Password Lama</label>
                                    <div class="input-group">
                                        <input type="password" name="password_lama" class="form-control" required>
                                        <span class="input-group-text cursor-pointer" onclick="togglePassword(this)">
                                            <i class="bi bi-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" name="password_baru" id="passBaru" class="form-control" required minlength="6">
                                        <span class="input-group-text cursor-pointer" onclick="togglePassword(this)">
                                            <i class="bi bi-eye"></i>
                                        </span>
                                    </div>
                                    <div class="form-text">Minimal 6 karakter</div>
                                </div>

                                <div class="mb-5">
                                    <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" name="konfirmasi_password" class="form-control" required minlength="6">
                                        <span class="input-group-text cursor-pointer" onclick="togglePassword(this)">
                                            <i class="bi bi-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        <i class="bi bi-arrow-repeat me-2"></i> Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword(el) {
        const input = el.parentElement.querySelector('input');
        if (input.type === 'password') {
            input.type = 'text';
            el.innerHTML = '<i class="bi bi-eye-slash"></i>';
        } else {
            input.type = 'password';
            el.innerHTML = '<i class="bi bi-eye"></i>';
        }
    }
</script>