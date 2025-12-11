</div>

<style>
    /* Global Setting */
    body {
        overflow-x: hidden;
        background-color: #ffffff;
    }

    /* 1. HERO SECTION (Tampilan Utama) */
    .hero-wrapper {
        position: relative;
        background: linear-gradient(120deg, #6ab465ff 0%, #ffffffff 100%);
        padding: 50px 0 60px;
        margin-top: -24px;
        overflow: hidden;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
    }

    /* Blob Animation */
    .blob {
        position: absolute;
        filter: blur(60px);
        z-index: 0;
        opacity: 0.5;
    }

    .blob-1 {
        top: -20%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: rgba(25, 135, 84, 0.15);
        border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        animation: morph 10s ease-in-out infinite;
    }

    .blob-2 {
        bottom: -20%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 193, 7, 0.15);
        border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        animation: morph 10s ease-in-out infinite reverse;
    }

    @keyframes morph {
        0% {
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        }

        50% {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        }

        100% {
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-weight: 800;
        letter-spacing: -1px;
        color: #212529;
        line-height: 1.2;
    }

    .highlight-text {
        color: #198754;
        position: relative;
        display: inline-block;
    }

    .highlight-text::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 10px;
        background-color: rgba(255, 193, 7, 0.3);
        bottom: 5px;
        left: 0;
        z-index: -1;
        border-radius: 5px;
    }

    .btn-main {
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 10px 25px rgba(25, 135, 84, 0.2);
        transition: all 0.3s;
    }

    .btn-main:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(25, 135, 84, 0.3);
    }

    /* 2. FITUR CARDS */
    .feature-box {
        background: white;
        padding: 35px 25px;
        border-radius: 20px;
        border: 1px solid #f0f0f0;
        transition: all 0.3s;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .feature-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: #198754;
        transition: width 0.3s;
    }

    .feature-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    }

    .feature-box:hover::before {
        width: 100%;
        opacity: 0.05;
    }

    .icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 25px;
        background: rgba(25, 135, 84, 0.1);
        color: #198754;
    }

    /* 3. ALUR DIAGRAM (Timeline Horizontal) */
    .step-icon-box {
        width: 80px;
        height: 80px;
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #6c757d;
        margin: 0 auto;
        transition: all 0.3s;
        position: relative;
        z-index: 2;
        /* Agar di atas garis */
    }

    /* Efek Hover Step */
    .step-col:hover .step-icon-box {
        border-color: #198754;
        background-color: #198754;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 0 0 8px rgba(25, 135, 84, 0.1);
    }

    /* Garis Penghubung */
    .step-connector {
        position: absolute;
        top: 40px;
        /* Setengah tinggi icon (80px / 2) */
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #e9ecef;
        z-index: 1;
        /* Di belakang icon */
    }

    /* Sembunyikan garis di mobile */
    @media (max-width: 768px) {
        .step-connector {
            display: none;
        }
    }
</style>

<div class="hero-wrapper">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="container hero-content">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10 text-center">
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-3">
                    <i class="bi bi-patch-check-fill me-1"></i> FKM UMI Project
                </span>

                <h1 class="display-4 hero-title mb-4">
                    Ketahui Risiko Kolesterol <br>
                    <span class="highlight-text">Dalam 2 Menit</span>
                </h1>

                <p class="lead text-muted mb-5 mx-auto" style="line-height: 1.8; max-width: 800px;">
                    Tanpa jarum suntik, tanpa antre. Cukup jawab 30 pertanyaan untuk mengetahui kondisi kesehatan Anda saat ini. <strong>Gratis dan Terpercaya.</strong>
                </p>

                <div class="d-flex gap-3 justify-content-center">
                    <a href="<?= BASEURL; ?>/skrining" class="btn btn-success btn-main text-white">
                        Mulai Sekarang
                    </a>
                    <a href="<?= BASEURL; ?>/auth/login" class="btn btn-outline-dark btn-main border-2 bg-transparent">
                        Masuk Akun
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h6 class="text-uppercase text-muted ls-2 small fw-bold">Mengapa Penting?</h6>
            <h2 class="fw-bold">Jaga Kesehatan Jantung Anda</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="icon-wrapper">
                        <i class="bi bi-search"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Tanpa Gejala</h4>
                    <p class="text-muted mb-0">
                        Kolesterol tinggi sering disebut <em>"Silent Killer"</em> karena seringkali tidak menunjukkan gejala fisik sampai terjadi serangan.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="icon-wrapper text-danger bg-danger bg-opacity-10">
                        <i class="bi bi-activity"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Cegah Komplikasi</h4>
                    <p class="text-muted mb-0">
                        Mengetahui risiko sejak dini adalah langkah terbaik untuk mencegah stroke, hipertensi, dan penyakit jantung koroner.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="icon-wrapper text-primary bg-primary bg-opacity-10">
                        <i class="bi bi-file-medical"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Hasil Medis</h4>
                    <p class="text-muted mb-0">
                        Dapatkan laporan PDF lengkap yang bisa Anda bawa saat berkonsultasi lebih lanjut ke Puskesmas atau Rumah Sakit.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Cara Kerja KoloCheck</h2>
            <p class="text-muted">Proses skrining mudah dalam 4 langkah</p>
        </div>

        <div class="position-relative px-lg-5">
            <div class="step-connector d-none d-md-block"></div>

            <div class="row text-center position-relative">
                <div class="col-md-3 mb-4 mb-md-0 step-col">
                    <div class="bg-white d-inline-block p-2 rounded-circle mb-3">
                        <div class="step-icon-box">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold">1. Isi Kuesioner</h5>
                    <p class="text-muted small px-3">Jawab 30 pertanyaan tentang gaya hidup & pola makan.</p>
                </div>

                <div class="col-md-3 mb-4 mb-md-0 step-col">
                    <div class="bg-white d-inline-block p-2 rounded-circle mb-3">
                        <div class="step-icon-box">
                            <i class="bi bi-cpu"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold">2. Analisis</h5>
                    <p class="text-muted small px-3">Sistem menghitung tingkat risiko Anda secara otomatis.</p>
                </div>

                <div class="col-md-3 mb-4 mb-md-0 step-col">
                    <div class="bg-white d-inline-block p-2 rounded-circle mb-3">
                        <div class="step-icon-box">
                            <i class="bi bi-prescription2"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold">3. Review Dokter</h5>
                    <p class="text-muted small px-3">Terima saran medis yang personal dari ahli.</p>
                </div>

                <div class="col-md-3 mb-4 mb-md-0 step-col">
                    <div class="bg-white d-inline-block p-2 rounded-circle mb-3">
                        <div class="step-icon-box">
                            <i class="bi bi-printer"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold">4. Ambil Hasil</h5>
                    <p class="text-muted small px-3">Simpan hasil sebagai arsip kesehatan pribadi.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5 pt-3">
            <a href="<?= BASEURL; ?>/skrining" class="btn btn-warning rounded-pill px-5 py-3 fw-bold shadow-sm">
                Mulai Skrining Gratis
            </a>
        </div>
    </div>
</section>

<div class="container">