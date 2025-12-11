<style>
    /* Styling Khusus Halaman Register */
    body {
        background-color: #f8f9fa;
    }

    .register-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
        padding: 40px 20px;
    }

    .card-register-clean {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        width: 100%;
        max-width: 900px;
    }

    /* Bagian Kiri (Sidebar Info) - Opsional, bisa dihapus kalau mau single column */
    .register-sidebar {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .register-logo {
        height: 60px;
        background: white;
        padding: 8px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    /* Form Styles */
    .form-label {
        font-weight: 500;
        color: #495057;
        font-size: 0.9rem;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        padding: 10px 15px;
        border: 1px solid #ced4da;
        background-color: #fdfdfd;
        transition: all 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        background-color: #fff;
    }

    .section-title {
        color: #0d6efd;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::after {
        content: '';
        flex-grow: 1;
        height: 1px;
        background-color: #e9ecef;
    }

    .btn-register-submit {
        background-color: #0d6efd;
        border: none;
        padding: 12px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .btn-register-submit:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
    }
</style>

<div class="register-container">
    <div class="card card-register-clean">
        <div class="row g-0">

            <div class="col-lg-4 d-none d-lg-block register-sidebar">
                <div>
                    <img src="<?= BASEURL; ?>/assets/img/umi.png" class="register-logo shadow-sm" alt="Logo">
                    <h3 class="fw-bold mb-3">Gabung KoloCheck</h3>
                    <p class="opacity-75 mb-4">
                        Daftarkan diri Anda untuk mendapatkan akses penuh ke fitur skrining kesehatan dan konsultasi dokter.
                    </p>
                    <div class="d-grid gap-2">
                        <div class="bg-white bg-opacity-10 p-3 rounded-3 text-start mb-2">
                            <i class="bi bi-shield-check me-2"></i> Data Aman
                        </div>
                        <div class="bg-white bg-opacity-10 p-3 rounded-3 text-start mb-2">
                            <i class="bi bi-file-medical me-2"></i> Gratis & Mudah
                        </div>
                        <div class="bg-white bg-opacity-10 p-3 rounded-3 text-start">
                            <i class="bi bi-person-badge me-2"></i> Terverifikasi
                        </div>
                    </div>
                </div>
                <div class="mt-auto pt-5 small opacity-50">
                    &copy; 2025 FKM UMI Makassar
                </div>
            </div>

            <div class="col-lg-8 p-4 p-md-5">

                <div class="text-center mb-4 d-lg-none">
                    <h3 class="fw-bold text-primary">Pendaftaran Pasien</h3>
                </div>

                <h4 class="fw-bold mb-4 d-none d-lg-block text-dark">Form Pendaftaran Baru</h4>

                <form action="<?= BASEURL; ?>/auth/store" method="POST">

                    <div class="section-title">
                        <i class="bi bi-lock-fill"></i> Informasi Akun
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control" placeholder="Buat username unik" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
                        </div>
                    </div>

                    <div class="section-title mt-4">
                        <i class="bi bi-person-vcard-fill"></i> Data Pribadi
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap (Sesuai KTP) <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">NIK (16 Digit) <span class="text-danger">*</span></label>
                            <input type="number" name="nik" class="form-control" placeholder="Contoh: 7371..." required minlength="16">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="nama@email.com">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_lahir" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="" selected disabled>Pilih...</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">No. HP / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control" placeholder="08..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status Pernikahan <span class="text-danger">*</span></label>
                            <select name="status_pernikahan" class="form-select" required>
                                <option value="" selected disabled>Pilih...</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Janda/Duda">Janda/Duda</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="pekerjaan" class="form-control" placeholder="Contoh: Mahasiswa, PNS, Wiraswasta" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" rows="2" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan..." required></textarea>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-register-submit text-white">
                            Daftar Sekarang
                        </button>
                    </div>

                    <div class="text-center text-muted small">
                        Sudah punya akun? <a href="<?= BASEURL; ?>/auth/login" class="text-decoration-none fw-bold text-primary">Login disini</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>