<?php
// 1. Decode Jawaban JSON dari Database
// Jika data lama (NULL), set array kosong agar tidak error
$jawaban = !empty($data['detail_jawaban']) ? json_decode($data['detail_jawaban'], true) : [];

$soal_p = [
    1 => "Kolesterol tinggi meningkatkan risiko jantung dan stroke.",
    2 => "Kolesterol tinggi dapat terjadi tanpa gejala.",
    3 => "Makanan berlemak dapat menaikkan kadar kolesterol.",
    4 => "Kolesterol LDL lebih berbahaya dibanding HDL.",
    5 => "Gaya hidup kurang aktif dapat meningkatkan kolesterol.",
    6 => "Obesitas berhubungan dengan risiko kolesterol tinggi.",
    7 => "Merokok dapat memperburuk profil kolesterol.",
    8 => "Serat dari sayur dan buah dapat membantu menurunkan kolesterol.",
    9 => "Riwayat keluarga dapat meningkatkan risiko kolesterol tinggi.",
    10 => "Pemeriksaan darah adalah cara pasti mengetahui kadar kolesterol."
];

$soal_b = [
    1 => "Sering mengonsumsi gorengan, jeroan, atau makanan tinggi lemak.",
    2 => "Jarang berolahraga secara teratur (kurang dari 3x seminggu).",
    3 => "Berat badan berada di atas kisaran ideal.",
    4 => "Jarang melakukan pemeriksaan kolesterol.",
    5 => "Sering mengonsumsi makanan cepat saji (fast food).",
    6 => "Merokok atau sering terpapar asap rokok.",
    7 => "Jarang mengonsumsi sayur dan buah setiap hari.",
    8 => "Sering mengonsumsi minuman manis atau tinggi gula.",
    9 => "Tidak memperhatikan label nutrisi saat membeli makanan.",
    10 => "Sering merasa cepat lelah meskipun aktivitas tidak berat."
];

$soal_s = [
    1 => "Menjaga kadar kolesterol sangat penting untuk kesehatan.",
    2 => "Pola makan sehat dapat mencegah kolesterol tinggi.",
    3 => "Perlu membatasi makanan berminyak.",
    4 => "Olahraga rutin membantu menjaga kadar kolesterol tetap normal.",
    5 => "Pemeriksaan kolesterol secara berkala penting bagi saya.",
    6 => "Menjaga berat badan ideal penting untuk kesehatan kolesterol.",
    7 => "Rokok dapat memperburuk kadar kolesterol.",
    8 => "Perlu mengurangi makanan berlemak untuk menjaga kesehatan.",
    9 => "Perubahan gaya hidup sehat dapat mencegah komplikasi.",
    10 => "Bersedia mengikuti anjuran tenaga kesehatan."
];

// 3. Helper Function untuk Translate Nilai Angka ke Teks
function translateP($val)
{
    if ($val == 4) return '<span class="badge bg-success">Sangat Setuju</span>';
    if ($val == 3) return '<span class="badge bg-info">Setuju</span>';
    if ($val == 2) return '<span class="badge bg-warning">Netral</span>';
    return '<span class="badge bg-danger">Tdk Setuju</span>';
}

function translateB($val)
{
    // Di form skrining: Ya=0 (Buruk), Tidak=2 (Baik)
    // Handle string '0' juga karena JSON decode bisa jadi string
    if ($val === 0 || $val === '0') return '<span class="badge bg-danger">Ya (Berisiko)</span>';
    return '<span class="badge bg-success">Tidak (Sehat)</span>';
}

function translateS($val)
{
    if ($val == 4) return '<span class="badge bg-success">Sangat Setuju</span>';
    if ($val == 3) return '<span class="badge bg-info">Setuju</span>';
    if ($val == 2) return '<span class="badge bg-warning">Netral</span>';
    return '<span class="badge bg-danger">Tdk Setuju</span>';
}
?>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-primary mb-0"><i class="bi bi-clipboard2-pulse me-2"></i>Review Hasil Skrining</h3>
            <p class="text-muted small mb-0">Analisis jawaban pasien dan berikan rekomendasi medis.</p>
        </div>
        <a href="<?= BASEURL; ?>/admin/pasien" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row g-4">

        <div class="col-lg-5">

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-person-lines-fill me-2 text-primary"></i>Identitas Pasien</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 20px;">
                            <?= strtoupper(substr($data['nama_lengkap'], 0, 2)); ?>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0"><?= $data['nama_lengkap']; ?></h5>
                            <span class="text-muted small">NIK: <?= $data['nik']; ?></span>
                        </div>
                    </div>

                    <div class="row g-2 small border-top pt-3 mt-2">
                        <div class="col-6">
                            <span class="text-muted d-block">Usia</span>
                            <strong><?= date_diff(date_create($data['tgl_lahir']), date_create('today'))->y; ?> Tahun</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block">Jenis Kelamin</span>
                            <strong><?= $data['jenis_kelamin']; ?></strong>
                        </div>
                        <div class="col-6 mt-2">
                            <span class="text-muted d-block">Pekerjaan</span>
                            <strong><?= $data['pekerjaan']; ?></strong>
                        </div>
                        <div class="col-6 mt-2">
                            <span class="text-muted d-block">Tanggal Tes</span>
                            <strong><?= date('d/m/Y', strtotime($data['tanggal_skrining'])); ?></strong>
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-muted small text-uppercase">Kategori Risiko:</span>
                        <?php
                        $badge = 'success';
                        if ($data['kategori_risiko'] == 'Tinggi') $badge = 'danger';
                        if ($data['kategori_risiko'] == 'Sedang') $badge = 'warning';
                        ?>
                        <span class="badge bg-<?= $badge; ?> fs-6 rounded-pill px-3 shadow-sm"><?= $data['kategori_risiko']; ?></span>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-list-check me-2 text-primary"></i>Detail Jawaban Kuesioner</h6>
                </div>

                <?php if (empty($jawaban)): ?>
                    <div class="card-body text-center py-5">
                        <i class="bi bi-info-circle text-muted fs-1 mb-2 d-block"></i>
                        <p class="text-muted small fst-italic mb-0">
                            Detail jawaban tidak tersedia untuk data ini (Data Lama).
                        </p>
                    </div>
                <?php else: ?>
                    <div class="accordion accordion-flush" id="accordionJawaban">

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-p">
                                    A. Pengetahuan (Skor: <?= $data['skor_pengetahuan']; ?>/28)
                                </button>
                            </h2>
                            <div id="flush-p" class="accordion-collapse collapse" data-bs-parent="#accordionJawaban">
                                <div class="accordion-body p-0">
                                    <ul class="list-group list-group-flush small">
                                        <?php foreach ($soal_p as $no => $soal): ?>
                                            <li class="list-group-item bg-light border-bottom py-2">
                                                <div class="mb-1 text-dark fw-semibold"><?= $no . '. ' . $soal; ?></div>
                                                <?= translateP($jawaban['p' . $no] ?? 0); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-danger" type="button" data-bs-toggle="collapse" data-bs-target="#flush-b">
                                    B. Perilaku (Skor: <?= $data['skor_perilaku']; ?>/20)
                                </button>
                            </h2>
                            <div id="flush-b" class="accordion-collapse collapse" data-bs-parent="#accordionJawaban">
                                <div class="accordion-body p-0">
                                    <ul class="list-group list-group-flush small">
                                        <?php foreach ($soal_b as $no => $soal): ?>
                                            <li class="list-group-item bg-light border-bottom py-2">
                                                <div class="mb-1 text-dark fw-semibold"><?= $no . '. ' . $soal; ?></div>
                                                <?= translateB($jawaban['b' . $no] ?? 2); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-s">
                                    C. Sikap (Skor: <?= $data['skor_sikap']; ?>/28)
                                </button>
                            </h2>
                            <div id="flush-s" class="accordion-collapse collapse" data-bs-parent="#accordionJawaban">
                                <div class="accordion-body p-0">
                                    <ul class="list-group list-group-flush small">
                                        <?php foreach ($soal_s as $no => $soal): ?>
                                            <li class="list-group-item bg-light border-bottom py-2">
                                                <div class="mb-1 text-dark fw-semibold"><?= $no . '. ' . $soal; ?></div>
                                                <?= translateS($jawaban['s' . $no] ?? 0); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endif; ?>
            </div>

        </div>

        <div class="col-lg-7">
            <div class="card shadow-lg border-0 h-100 rounded-4">
                <div class="card-header bg-primary text-white py-3 rounded-top-4">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-chat-heart-fill me-2"></i>Diagnosis & Saran Dokter</h5>
                </div>
                <div class="card-body p-4">

                    <form action="<?= BASEURL; ?>/admin/storeFeedback" method="POST">
                        <input type="hidden" name="id_skrining" value="<?= $data['id']; ?>">

                        <div class="alert alert-light border-start border-4 border-info shadow-sm mb-4">
                            <div class="d-flex">
                                <i class="bi bi-lightbulb-fill text-info fs-4 me-3"></i>
                                <div>
                                    <strong>Panduan Pengisian:</strong>
                                    <ul class="mb-0 small text-muted ps-3">
                                        <li>Tentukan diagnosis awal (suspect) berdasarkan skor.</li>
                                        <li>Berikan saran gaya hidup spesifik berdasarkan jawaban di kiri.</li>
                                        <li>Rujuk ke faskes jika risiko tinggi.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">
                                <i class="bi bi-activity me-1 text-danger"></i>Diagnosis Medis / Kesimpulan
                            </label>

                            <?php
                            // Auto-fill Diagnosis jika kosong
                            $saran_diagnosa = $data['diagnosa'];
                            if (empty($saran_diagnosa)) {
                                if ($data['kategori_risiko'] == 'Tinggi') $saran_diagnosa = "Suspect Hiperkolesterolemia (Perlu Rujukan Lab)";
                                elseif ($data['kategori_risiko'] == 'Sedang') $saran_diagnosa = "Borderline High Cholesterol (Peringatan Awal)";
                                else $saran_diagnosa = "Kondisi Sehat / Risiko Rendah";
                            }
                            ?>

                            <input type="text" name="diagnosa" class="form-control form-control-lg fw-bold text-primary bg-light"
                                value="<?= $saran_diagnosa; ?>"
                                placeholder="Contoh: Hiperkolesterolemia" required>
                            <div class="form-text small">Anda dapat mengubah diagnosis otomatis di atas sesuai penilaian medis.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark"><i class="bi bi-chat-text-fill me-1 text-success"></i>Isi Pesan / Resep / Saran:</label>
                            <textarea name="feedback_admin" class="form-control bg-light" style="height: 250px; border-radius: 12px; font-size: 1rem; line-height: 1.6;" placeholder="Yth. <?= $data['nama_lengkap']; ?>,&#10;&#10;Berdasarkan hasil skrining awal, kami menemukan bahwa...&#10;&#10;Saran kami:&#10;1. ...&#10;2. ...&#10;&#10;Salam Sehat,&#10;dr. Admin KoloCheck" required><?= $data['feedback_admin']; ?></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow hover-lift">
                                <i class="bi bi-send-fill me-2"></i>Simpan & Kirim Hasil
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .hover-lift {
        transition: transform 0.2s;
    }

    .hover-lift:hover {
        transform: translateY(-3px);
    }

    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: inherit;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, .125);
    }

    /* Scrollbar cantik untuk textarea */
    textarea::-webkit-scrollbar {
        width: 8px;
    }

    textarea::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 4px;
    }

    textarea::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }
</style>