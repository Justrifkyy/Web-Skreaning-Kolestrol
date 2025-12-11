<style>
    /* Styling Khusus Halaman Login - CLEAN VERSION */
    body {
        background-color: #f8f9fa;
        /* Background abu sangat muda agar kartu putih terlihat */
    }

    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
        padding: 20px;
    }

    .card-login-clean {
        background: #ffffff;
        border: none;
        border-radius: 16px;
        /* Bayangan sangat halus */
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        padding: 40px;
        width: 100%;
        max-width: 420px;
        /* Batasi lebar agar proporsional */
    }

    .brand-logo-login {
        height: 45px;
        width: auto;
        margin-right: 10px;
    }

    /* Judul */
    .login-title {
        font-weight: 700;
        color: #212529;
        margin-bottom: 10px;
    }

    /* Form Inputs */
    .form-floating .form-control {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        padding-left: 15px;
        background-color: #fdfdfd;
    }

    .form-floating .form-control:focus {
        border-color: #0d6efd;
        /* Biru standar profesional */
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        background-color: #fff;
    }

    .form-floating label {
        padding-left: 15px;
        color: #6c757d;
    }

    /* Tombol Submit - Biru Profesional */
    .btn-login-submit {
        background-color: #0d6efd;
        border: none;
        padding: 12px;
        font-weight: 600;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.2s;
    }

    .btn-login-submit:hover {
        background-color: #0b5ed7;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
    }

    /* Toggle Password */
    .password-toggle-clean {
        cursor: pointer;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        color: #adb5bd;
        font-size: 1.2rem;
        transition: color 0.3s;
    }

    .password-toggle-clean:hover {
        color: #0d6efd;
    }

    /* Links */
    .link-primary-clean {
        color: #0d6efd;
        font-weight: 600;
        text-decoration: none;
    }

    .link-primary-clean:hover {
        text-decoration: underline;
    }
</style>

<div class="login-container">

    <div class="card-login-clean">

        <div class="text-center mb-5">
            <div class="mb-4 d-flex justify-content-center align-items-center grayscale-hover">
                <img src="<?= BASEURL; ?>/assets/img/umi.png" class="brand-logo-login" alt="UMI">
                <img src="<?= BASEURL; ?>/assets/img/fkm.png" class="brand-logo-login" alt="FKM">
            </div>
            <h3 class="login-title">Login KoloCheck</h3>
            <p class="text-muted mb-0">Masuk untuk melanjutkan.</p>
        </div>

        <div>

            <?php if (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger rounded-3 py-2 px-3 mb-4 small" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i> Username atau Password salah!
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success rounded-3 py-2 px-3 mb-4 small" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> Registrasi berhasil! Silakan login.
                </div>
            <?php endif; ?>

            <form action="<?= BASEURL; ?>/auth/authenticate" method="POST">

                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required>
                    <label for="floatingInput">Username</label>
                </div>

                <div class="form-floating mb-4 position-relative">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                    <i class="bi bi-eye-slash password-toggle-clean" id="togglePassword"></i>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary btn-login-submit">
                        Masuk
                    </button>
                </div>

                <div class="text-center text-muted">
                    Belum punya akun?
                    <a href="<?= BASEURL; ?>/auth/register" class="link-primary-clean ms-1">
                        Daftar Sekarang
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

<div class="text-center pb-4">
    <small class="text-muted opacity-50">&copy; 2025 KoloCheck - FKM UMI</small>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#floatingPassword');

    togglePassword.addEventListener('click', function(e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
</script>