<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <?php
            // Logic Penentuan Konten Berdasarkan Kategori Risiko Kolesterol
            // Default (Rendah)
            $warna = 'success';
            $bgGradient = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
            $icon = 'bi-shield-check-fill';
            $iconBg = 'rgba(16, 185, 129, 0.1)';
            $pesan = 'Selamat! Risiko Kolesterol Anda rendah. Tetap pertahankan pola hidup sehat ini untuk kesehatan jantung jangka panjang.';
            $rekomendasi = [
                'Pertahankan konsumsi serat (sayur & buah)',
                'Lanjutkan rutinitas olahraga ringan',
                'Tetap batasi asupan gula dan garam',
                'Cek kesehatan rutin setahun sekali'
            ];

            // Jika Risiko Tinggi
            if ($data['kategori_risiko'] == 'Tinggi') {
                $warna = 'danger';
                $bgGradient = 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)';
                $icon = 'bi-heart-pulse-fill';
                $iconBg = 'rgba(239, 68, 68, 0.1)';
                $pesan = 'Perhatian! Skor Anda mengindikasikan risiko tinggi kolesterol. Hal ini dapat meningkatkan risiko penyakit jantung jika tidak segera ditangani.';
                $rekomendasi = [
                    'Segera konsultasi dengan dokter untuk cek profil lipid lengkap',
                    'Hindari total gorengan, santan, dan jeroan',
                    'Stop merokok segera',
                    'Wajib berolahraga minimal 30 menit setiap hari'
                ];
            }
            // Jika Risiko Sedang
            elseif ($data['kategori_risiko'] == 'Sedang') {
                $warna = 'warning';
                $bgGradient = 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)';
                $icon = 'bi-exclamation-triangle-fill';
                $iconBg = 'rgba(245, 158, 11, 0.1)';
                $pesan = 'Waspada! Anda memiliki risiko menengah. Gaya hidup Anda saat ini mulai membahayakan kesehatan pembuluh darah.';
                $rekomendasi = [
                    'Kurangi konsumsi makanan cepat saji (Fast Food)',
                    'Batasi makanan berlemak dan kulit ayam',
                    'Tingkatkan aktivitas fisik harian',
                    'Perbanyak minum air putih'
                ];
            }
            ?>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4 result-card">
                <div class="card-header text-white text-center py-5 border-0 position-relative" style="background: <?= $bgGradient; ?>">
                    <div class="confetti-container"></div>
                    <div class="result-icon mb-4">
                        <div class="icon-circle">
                            <i class="bi <?= $icon; ?>"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-2">Hasil Analisis Risiko</h3>
                    <p class="mb-0 opacity-90">Kuesioner Anda telah berhasil dianalisis sistem</p>
                </div>

                <div class="card-body p-5 text-center">
                    <div class="score-display mb-4">
                        <div class="score-circle mx-auto" style="background: <?= $iconBg; ?>">
                            <div class="score-number">
                                <span class="display-1 fw-bold text-<?= $warna; ?>"><?= $data['total_skor']; ?></span>
                                <span class="fs-4 text-muted">/76</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <span class="badge badge-<?= $warna; ?> px-4 py-3 fs-5 fw-semibold shadow-sm">
                            <i class="bi <?= $icon; ?> me-2"></i>Risiko <?= $data['kategori_risiko']; ?>
                        </span>
                    </div>

                    <div class="alert alert-<?= $warna; ?> alert-modern border-0 shadow-sm mx-auto" style="max-width: 600px;">
                        <div class="d-flex align-items-center">
                            <i class="bi <?= $icon; ?> fs-3 me-3 flex-shrink-0"></i>
                            <p class="mb-0 text-start"><?= $pesan; ?></p>
                        </div>
                    </div>

                    <div class="recommendations-section mt-5">
                        <h5 class="fw-bold mb-4 text-start border-bottom pb-2">
                            <i class="bi bi-lightbulb-fill text-warning me-2"></i>
                            Rekomendasi Medis Awal
                        </h5>
                        <div class="row g-3">
                            <?php foreach ($rekomendasi as $index => $item): ?>
                                <div class="col-md-6">
                                    <div class="recommendation-card h-100">
                                        <div class="d-flex align-items-start">
                                            <div class="recommendation-number me-3">
                                                <?= $index + 1; ?>
                                            </div>
                                            <p class="mb-0 text-start"><?= $item; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="info-box mt-5">
                        <div class="card border-0 shadow-sm rounded-3" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start">
                                    <div class="info-icon me-3">
                                        <i class="bi bi-info-circle-fill text-primary fs-3"></i>
                                    </div>
                                    <div class="text-start flex-grow-1">
                                        <h6 class="fw-bold mb-2 text-primary">Langkah Selanjutnya</h6>
                                        <p class="mb-2 text-dark">Hasil ini bersifat skrining awal. Admin/Dokter kami akan meninjau jawaban Anda.</p>
                                        <p class="mb-0 small text-muted">
                                            <i class="bi bi-clock-history me-1"></i>
                                            Pantau menu <strong>"Riwayat Skrining"</strong> di dashboard untuk melihat feedback resmi dari Dokter.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons mt-5">
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-5">
                                <a href="<?= BASEURL; ?>/pasien" class="btn btn-primary btn-lg w-100 rounded-pill shadow">
                                    <i class="bi bi-house-fill me-2"></i>Ke Dashboard
                                </a>
                            </div>
                            <div class="col-md-5">
                                <a href="<?= BASEURL; ?>/skrining" class="btn btn-outline-secondary btn-lg w-100 rounded-pill">
                                    <i class="bi bi-arrow-repeat me-2"></i>Ulangi Tes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* CSS Animations & Styling */
    .result-card {
        animation: slideInUp 0.8s ease;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .result-icon {
        animation: scaleIn 0.5s ease 0.3s both;
    }

    .icon-circle {
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        animation: pulse 2s ease-in-out infinite;
    }

    .icon-circle i {
        font-size: 3.5rem;
        color: white;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
        }

        50% {
            transform: scale(1.05);
            box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
        }
    }

    .score-circle {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        animation: scoreReveal 0.8s ease 0.5s both;
    }

    @keyframes scoreReveal {
        from {
            transform: scale(0) rotate(180deg);
            opacity: 0;
        }

        to {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
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

    .alert-modern {
        border-radius: 16px;
        animation: fadeIn 0.6s ease 0.7s both;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .recommendations-section {
        animation: fadeIn 0.6s ease 0.9s both;
    }

    .recommendation-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .recommendation-card:hover {
        border-color: #10b981;
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(16, 185, 129, 0.1);
    }

    .recommendation-number {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
        font-size: 0.9rem;
    }

    .info-box {
        animation: fadeIn 0.6s ease 1.1s both;
    }

    .action-buttons {
        animation: fadeIn 0.6s ease 1.3s both;
    }

    .confetti-container {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        overflow: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategori = '<?= $data['kategori_risiko']; ?>';
        // Confetti hanya muncul jika Risiko Rendah (Hasil Bagus)
        if (kategori === 'Rendah') {
            createConfetti();
        }

        function createConfetti() {
            const container = document.querySelector('.confetti-container');
            if (!container) return;
            const colors = ['#ffffff', '#a8e6cf', '#dcedc1', '#ffd3b6', '#ffaaa5'];

            for (let i = 0; i < 40; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'absolute';
                confetti.style.width = '8px';
                confetti.style.height = '8px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = '-10px';
                confetti.style.opacity = '0';
                confetti.style.transform = 'rotate(' + Math.random() * 360 + 'deg)';
                confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                confetti.style.animation = `confettiFall ${2 + Math.random() * 3}s ease-out ${Math.random() * 2}s`;
                container.appendChild(confetti);
                setTimeout(() => confetti.remove(), 5000);
            }
        }

        const style = document.createElement('style');
        style.textContent = `
        @keyframes confettiFall {
            0% { top: -10px; opacity: 1; }
            100% { top: 100%; opacity: 0; transform: translateX(${Math.random() * 200 - 100}px) rotate(${Math.random() * 720}deg); }
        }`;
        document.head.appendChild(style);
    });
</script>