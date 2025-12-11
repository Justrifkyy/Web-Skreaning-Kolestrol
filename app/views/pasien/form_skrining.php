<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4 mb-5">
                <div class="card-header bg-primary text-white py-3 rounded-top-4">
                    <h4 class="mb-0 fw-bold"><i class="bi bi-clipboard-check me-2"></i>Kuesioner Skrining Kolesterol</h4>
                    <p class="mb-0 small opacity-75">Jawab 30 pertanyaan berikut dengan jujur untuk hasil akurat.</p>
                </div>
                <div class="card-body p-4 p-md-5">

                    <form action="<?= BASEURL; ?>/skrining/process" method="POST">

                        <div class="mb-5">
                            <h5 class="text-primary fw-bold border-bottom pb-2 mb-4">A. Pengetahuan tentang Kolesterol</h5>
                            <div class="alert alert-info py-2 small"><i class="bi bi-info-circle me-1"></i> Pilih seberapa setuju Anda (TS=Tidak Setuju, N=Netral, S=Setuju, SS=Sangat Setuju)</div>

                            <?php
                            $pengetahuan = [
                                1 => "Saya mengetahui bahwa kolesterol tinggi meningkatkan risiko serangan jantung dan stroke.",
                                2 => "Saya memahami bahwa kolesterol tinggi dapat terjadi tanpa gejala.",
                                3 => "Saya mengetahui bahwa makanan berlemak dapat menaikkan kadar kolesterol.",
                                4 => "Saya tahu bahwa kolesterol LDL lebih berbahaya dibanding HDL.",
                                5 => "Saya memahami bahwa gaya hidup kurang aktif dapat meningkatkan kolesterol.",
                                6 => "Saya mengetahui bahwa obesitas berhubungan dengan risiko kolesterol tinggi.",
                                7 => "Saya memahami bahwa merokok dapat memperburuk profil kolesterol.",
                                8 => "Saya mengetahui bahwa serat dari sayur dan buah dapat membantu menurunkan kolesterol.",
                                9 => "Saya tahu bahwa riwayat keluarga dapat meningkatkan risiko kolesterol tinggi.",
                                10 => "Saya mengetahui bahwa pemeriksaan darah adalah cara pasti mengetahui kadar kolesterol."
                            ];
                            ?>

                            <?php foreach ($pengetahuan as $no => $soal): ?>
                                <div class="mb-4 pb-3 border-bottom border-light">
                                    <label class="fw-bold mb-2 d-block"><?= $no; ?>. <?= $soal; ?></label>
                                    <div class="d-flex gap-3 gap-md-4 mobile-radio-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="p<?= $no ?>" id="p<?= $no ?>_1" value="1" required>
                                            <label class="form-check-label" for="p<?= $no ?>_1">TS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="p<?= $no ?>" id="p<?= $no ?>_2" value="2">
                                            <label class="form-check-label" for="p<?= $no ?>_2">N</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="p<?= $no ?>" id="p<?= $no ?>_3" value="3">
                                            <label class="form-check-label" for="p<?= $no ?>_3">S</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="p<?= $no ?>" id="p<?= $no ?>_4" value="4">
                                            <label class="form-check-label" for="p<?= $no ?>_4">SS</label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="mb-5">
                            <h5 class="text-danger fw-bold border-bottom pb-2 mb-4">B. Perilaku Terkait Kolesterol</h5>
                            <div class="alert alert-danger bg-danger bg-opacity-10 border-danger py-2 small text-danger"><i class="bi bi-exclamation-circle me-1"></i> Jawab Ya atau Tidak sesuai kebiasaan Anda sehari-hari.</div>

                            <?php
                            $perilaku = [
                                1 => "Saya sering mengonsumsi gorengan, jeroan, atau makanan tinggi lemak.",
                                2 => "Saya jarang berolahraga secara teratur (kurang dari 3 kali seminggu).",
                                3 => "Berat badan saya berada di atas kisaran ideal.",
                                4 => "Saya jarang melakukan pemeriksaan kolesterol.",
                                5 => "Saya sering mengonsumsi makanan cepat saji (fast food).",
                                6 => "Saya merokok atau sering terpapar asap rokok.",
                                7 => "Saya jarang mengonsumsi sayur dan buah setiap hari.",
                                8 => "Saya sering mengonsumsi minuman manis atau tinggi gula.",
                                9 => "Saya tidak memperhatikan label nutrisi saat membeli makanan.",
                                10 => "Saya sering merasa cepat lelah meskipun aktivitas tidak berat."
                            ];
                            ?>

                            <?php foreach ($perilaku as $no => $soal): ?>
                                <div class="mb-3 bg-light p-3 rounded-3 border-start border-4 border-danger">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <label class="mb-0 fw-semibold"><?= $no; ?>. <?= $soal; ?></label>
                                        </div>
                                        <div class="col-md-4 text-md-end mt-2 mt-md-0">
                                            <div class="btn-group w-100" role="group">
                                                <input type="radio" class="btn-check" name="b<?= $no ?>" id="b<?= $no ?>y" value="0" required>
                                                <label class="btn btn-outline-danger" for="b<?= $no ?>y">Ya</label>

                                                <input type="radio" class="btn-check" name="b<?= $no ?>" id="b<?= $no ?>t" value="2">
                                                <label class="btn btn-outline-success" for="b<?= $no ?>t">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="mb-5">
                            <h5 class="text-success fw-bold border-bottom pb-2 mb-4">C. Sikap Terhadap Pencegahan</h5>
                            <div class="alert alert-success bg-success bg-opacity-10 border-success py-2 small text-success"><i class="bi bi-check-circle me-1"></i> Bagaimana pandangan/sikap Anda?</div>

                            <?php
                            $sikap = [
                                1 => "Saya merasa menjaga kadar kolesterol sangat penting untuk kesehatan.",
                                2 => "Saya percaya bahwa pola makan sehat dapat mencegah kolesterol tinggi.",
                                3 => "Saya merasa perlu membatasi makanan berminyak.",
                                4 => "Saya setuju bahwa olahraga rutin membantu menjaga kadar kolesterol tetap normal.",
                                5 => "Pemeriksaan kolesterol secara berkala penting bagi saya.",
                                6 => "Saya menilai bahwa menjaga berat badan ideal penting untuk kesehatan kolesterol.",
                                7 => "Saya percaya bahwa rokok dapat memperburuk kadar kolesterol.",
                                8 => "Saya merasa perlu mengurangi makanan berlemak untuk menjaga kesehatan.",
                                9 => "Saya setuju bahwa perubahan gaya hidup sehat dapat mencegah komplikasi akibat kolesterol.",
                                10 => "Saya bersedia mengikuti anjuran tenaga kesehatan mengenai pengendalian kolesterol."
                            ];
                            ?>

                            <?php foreach ($sikap as $no => $soal): ?>
                                <div class="mb-4 pb-3 border-bottom border-light">
                                    <label class="fw-bold mb-2 d-block"><?= $no; ?>. <?= $soal; ?></label>
                                    <div class="d-flex gap-3 gap-md-4 mobile-radio-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="s<?= $no ?>" id="s<?= $no ?>_1" value="1" required>
                                            <label class="form-check-label" for="s<?= $no ?>_1">TS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="s<?= $no ?>" id="s<?= $no ?>_2" value="2">
                                            <label class="form-check-label" for="s<?= $no ?>_2">N</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="s<?= $no ?>" id="s<?= $no ?>_3" value="3">
                                            <label class="form-check-label" for="s<?= $no ?>_3">S</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="s<?= $no ?>" id="s<?= $no ?>_4" value="4">
                                            <label class="form-check-label" for="s<?= $no ?>_4">SS</label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg py-3 rounded-pill shadow hover-top">
                                <i class="bi bi-send-check-fill me-2"></i>Kirim Jawaban & Lihat Hasil
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Tambahan */
    .form-check-input {
        cursor: pointer;
    }

    .form-check-label {
        cursor: pointer;
    }

    .hover-top {
        transition: transform 0.2s;
    }

    .hover-top:hover {
        transform: translateY(-3px);
    }

    @media (max-width: 576px) {
        .mobile-radio-group {
            justify-content: space-between;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
        }
    }
</style>