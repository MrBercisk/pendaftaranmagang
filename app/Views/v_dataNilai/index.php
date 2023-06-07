<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')) { ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php } ?>
<?php if (session()->getFlashdata('error')) { ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php if (session()->has('pesan_error')) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses ditolak!',
                text: '<?= session()->getFlashdata('pesan_error') ?>',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
                // matikan styling default tombol Swal
            })
        </script>

    <?php endif; ?>
    <section class="content-header bg-white" style="height: 50px; max-height: 100px;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <p class="text-muted">SI AMANG (Sistem Informasi Aplikasi Magang)</p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mt-5">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="color:#ffff;"><i class="fas fa-list"></i> Data Nilai Magang Peserta :</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <!-- Tombol Cetak PDF -->
                            <a href="<?php echo site_url('nilai/cetakPDF'); ?>" class="btn btn-danger mb-3">
                                <span class="icon"><i class="fas fa-file-pdf"></i></span>
                                Cetak PDF
                            </a>
                            <table class="table table-bordered bg-white table-hover" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peserta</th>
                                        <th>Nama Kampus</th>
                                        <th>Ketepatan Waktu</th>
                                        <th>Kehadiran</th>
                                        <th>Kemampuan Kerja</th>
                                        <th>Kualitas Kerja</th>
                                        <th>Kerjasama</th>
                                        <th>Inisiatif</th>
                                        <th>Rasa Percaya</th>
                                        <th>Penampilan</th>
                                        <th>Patuh Aturan PKL</th>
                                        <th>Tanggung Jawab</th>
                                        <th>Nilai Rata-rata</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>
    @media (max-width: 992px) {
        .row {
            flex-direction: column-reverse;
        }

    }

    .card-header {
        background-color: #17A2B8;
        color: #fff;
        padding: 10px;
    }

    label {
        font-weight: bold;
    }

    .form-group input[type="number"],
    .form-group select {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px;
        width: 100%;
    }

    .form-group input[type="number"]:focus,
    .form-group select:focus {
        border: 2px solid #17A2B8;
        outline: none;
    }

    small.text-danger {
        display: none;
    }

    #signature-pad {
        border: 3px solid #ccc;
        padding: 10px;
        margin-top: 20px;
    }

    .circle-img {
        width: 100px;
        height: 120px;
        object-fit: cover;
    }

    .status-oval {
        display: inline-block;
        border-radius: 9999px;
        padding: 5px 15px;
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        line-height: 1;
    }

    .status-oval .status-text {
        display: block;
        text-transform: uppercase;
    }

    .status-oval.diterima {
        background-color: #5cb85c;
        color: #fff;
    }

    .status-oval.ditolak {
        background-color: #d9534f;
        color: #fff;
    }

    .status-oval.belum-verifikasi {
        background-color: #f0ad4e;
        color: #fff;
    }

    .dataTables_wrapper {
        text-align: justify;
        /* untuk meletakkan teks di tengah */
        font-size: 14px;
        /* ukuran font */
        line-height: 1.5;
        /* jarak antar baris */
        font-family: Arial, Helvetica, sans-serif;
        /* jenis font */
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Load Signature Pad Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
<script>
    $(document).ready(function() {
        function calculateRataRata() {
            const ketepatan_waktu = parseInt(document.getElementById("ketepatan_waktu").value);
            const tanggung_jawab = parseInt(document.getElementById("tanggung_jawab").value);
            const kehadiran = parseInt(document.getElementById("kehadiran").value);
            const kemampuan_kerja = parseInt(document.getElementById("kemampuan_kerja").value);
            const kualitas_kerja = parseInt(document.getElementById("kualitas_kerja").value);
            const kerjasama = parseInt(document.getElementById("kerjasama").value);
            const inisiatif = parseInt(document.getElementById("inisiatif").value);
            const rasa_percaya = parseInt(document.getElementById("rasa_percaya").value);
            const penampilan = parseInt(document.getElementById("penampilan").value);
            const patuh_aturan_pkl = parseInt(document.getElementById("patuh_aturan_pkl").value);

            const sum = ketepatan_waktu + tanggung_jawab + kehadiran + kemampuan_kerja + kualitas_kerja +
                kerjasama + inisiatif + rasa_percaya + penampilan + patuh_aturan_pkl;

            const rata_rata = sum / 10;

            document.getElementById("rata_rata").value = rata_rata.toFixed(2);
            document.getElementById("rata_rata").readOnly = true;
        }

        //Menampilkan data Bidang (dataTable server-side)
        $('#example1').DataTable({
            "responsive": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "dataNilai/ajaxDataNilai",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],

            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "info": "_START_ sampai _END_ dari _MAX_ entri",
                "infoEmpty": "Data tidak tersedia",
                "search": "Cari:",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya"
                }
            }
        });
        //------------------------------------------------------------------
    });
</script>
<?= $this->endSection() ?>