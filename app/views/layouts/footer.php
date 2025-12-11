</div>
<footer class="bg-white border-top mt-auto py-4">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <h6 class="fw-bold text-success mb-1">
                    <i class="bi bi-heart-pulse-fill me-1"></i> KoloCheck
                </h6>
                <small class="text-muted">
                    &copy; 2025 Fakultas Kesehatan Masyarakat<br>
                    Universitas Muslim Indonesia (UMI) Makassar.
                </small>
            </div>

            <div class="col-md-6 text-center text-md-end">
                <small class="text-muted fst-italic">
                    "Mencegah lebih baik daripada mengobati."
                </small>
                <div class="mt-1">
                    <small class="text-muted">
                        Dibuat dengan <i class="bi bi-heart-fill text-danger animate-pulse"></i> oleh Mahasiswa Kesmas
                    </small>
                </div>
            </div>

        </div>
    </div>
</footer>

<style>
    .animate-pulse {
        animation: pulse 1.5s infinite;
        display: inline-block;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Agar footer selalu di bawah (Sticky Footer) */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php if (isset($data['screenings']) || isset($data['users'])): ?>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cek jika tabel pasien ada
            if ($('#tabelPasien').length) {
                $('#tabelPasien').DataTable({
                    "pageLength": 10,
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Semua"]
                    ],
                    "language": {
                        "search": "Cari:",
                        "paginate": {
                            "next": "›",
                            "previous": "‹"
                        }
                    },
                    "order": [],
                    "dom": '<"row mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>'
                });
            }
            // Cek jika tabel user ada
            if ($('#tabelUsers').length) {
                $('#tabelUsers').DataTable({
                    "language": {
                        "search": "Cari User:",
                        "paginate": {
                            "next": "›",
                            "previous": "‹"
                        }
                    }
                });
            }
        });
    </script>
<?php endif; ?>

</body>

</html>