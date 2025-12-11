<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="alert alert-warning border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center">
                <i class="bi bi-exclamation-circle-fill fs-3 me-3"></i>
                <div>
                    <strong>Mode Tamu:</strong> Hasil ini hanya sementara dan tidak tersimpan.
                    Silakan login/daftar untuk menyimpan riwayat dan mendapatkan saran dokter.
                </div>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header text-white text-center py-5 border-0"
                    style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">

                    <h3 class="fw-bold mb-2">Hasil Analisis Awal</h3>
                    <p class="mb-0 opacity-75">Berdasarkan jawaban kuesioner Anda</p>
                </div>

                <div class="card-body p-5 text-center">

                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light shadow-sm"
                            style="width: 180px; height: 180px;">
                            <div>
                                <span class="display-3 fw-bold text-primary"><?= $data['total_skor']; ?></span>
                                <span class="d-block text-muted">/100</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <?php
                        $bg = 'success';
                        $msg = 'Risiko Rendah';
                        if ($data['kategori_risiko'] == 'Tinggi') {
                            $bg = 'danger';
                            $msg = 'Risiko Tinggi';
                        } elseif ($data['kategori_risiko'] == 'Sedang') {
                            $bg = 'warning';
                            $msg = 'Risiko Sedang';
                        }
                        ?>
                        <span class="badge bg-<?= $bg; ?> fs-4 px-4 py-2 rounded-pill shadow-sm">
                            <?= $msg; ?>
                        </span>

                        <p class="mt-3 text-muted">
                            <?php if ($bg == 'danger'): ?>
                                Skor Anda mengindikasikan perlunya pemeriksaan kesehatan lebih lanjut.
                            <?php elseif ($bg == 'warning'): ?>
                                Gaya hidup Anda perlu diperbaiki untuk mencegah risiko penyakit.
                            <?php else: ?>
                                Pertahankan gaya hidup sehat Anda!
                            <?php endif; ?>
                        </p>
                    </div>

                    <div class="row mb-5 g-3">
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3">
                                <small class="d-block text-muted">Pengetahuan</small>
                                <strong><?= $data['skor_p']; ?>/40</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3">
                                <small class="d-block text-muted">Perilaku</small>
                                <strong><?= $data['skor_b']; ?>/20</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3">
                                <small class="d-block text-muted">Sikap</small>
                                <strong><?= $data['skor_s']; ?>/40</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-primary bg-opacity-10 border-0 rounded-4 p-4">
                        <h5 class="fw-bold text-primary mb-3">Ingin Penjelasan Medis & Simpan Hasil?</h5>
                        <p class="text-dark mb-4 small">
                            Daftar sekarang untuk mendapatkan: <br>
                            ✅ Feedback & Resep dari Dokter <br>
                            ✅ Riwayat Kesehatan Tersimpan <br>
                            ✅ Cetak Laporan PDF Resmi
                        </p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-center">
                            <a href="<?= BASEURL; ?>/auth/register" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                                <i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang
                            </a>
                            <a href="<?= BASEURL; ?>/auth/login" class="btn btn-outline-primary btn-lg rounded-pill px-5">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Sudah Punya Akun
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="text-center mt-4">
                <a href="<?= BASEURL; ?>/skrining" class="text-muted text-decoration-none">
                    <i class="bi bi-arrow-repeat me-1"></i> Ulangi Tes (Tanpa Simpan)
                </a>
            </div>

        </div>
    </div>
</div>