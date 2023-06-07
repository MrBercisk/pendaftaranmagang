<?= $this->extend('layouts_magang/template_magang') ?>

<?= $this->section('content') ?>
<?php if (session()->has('pesan_error')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Akses ditolak!',
            text: '<?= session()->getFlashdata('pesan_error') ?>',
            footer: '<a href="<?= base_url('kalender'); ?>">Klik disini untuk cek jadwal magang Anda</a>',
            customClass: {
                confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
            // matikan styling default tombol Swal
        })
    </script>
<?php elseif (session()->has('pesan_sukses')) : ?>
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Informasi!',
            text: '<?= session()->getFlashdata('pesan_sukses') ?>',
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
            // matikan styling default tombol Swal
        })
    </script>
<?php endif; ?>
<div class="content-wrapper">
    <section class="content-header bg-white" style="height: 50px; max-height: 100px;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <p class="text-muted">SI AMANG (Sistem Informasi Aplikasi Magang)</p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <style>
        .icon-container {
            color: #fff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
        }

        .text-container p {
            font-size: 1rem;
            font-weight: bold;
        }
    </style>

    <section class="content mt-4 p-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Download Dokumen Akhir</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <p><b>Panduan Mengunduh Dokumen:</b></p>
                                    <ol>
                                        <li>Halaman bisa diakses jika anda telah menyelesaikan magang dan telah upload Laporan.</li>
                                        <li>Klik tombol "Unduh Form Nilai" atau "Unduh Surat Selesai Magang".</li>
                                        <li>File akan terunduh dan tersimpan pada device Anda.</li>
                                        <li>Jika form nilai atau surat selesai magang belum terisi,silahkan tunggu karena sedang dalam proses.</li>
                                        <li>File dalam format PDF, pastikan Anda memiliki aplikasi pembaca PDF untuk membukanya.</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-container">
                                                <p class="m-0">Keterangan : <?= $keterangan_nilai ?></p>
                                            </div>
                                            <h5 class="card-title">Form Nilai</h5>
                                            <p class="card-text">Klik tombol di bawah untuk mengunduh</p>
                                            <a href="<?php echo base_url('selesaiMagang/form_nilai'); ?>" class="btn btn-primary"><i class="fa fa-download"></i> Unduh Form Nilai</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Surat Selesai Magang</h5>
                                            <p class="card-text">Klik tombol di bawah untuk mengunduh</p>
                                            <a href="<?php echo base_url('selesaiMagang/surat_selesai'); ?>" class="btn btn-primary"><i class="fa fa-download"></i> Unduh Surat Selesai Magang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {


        // Sweet Alert 2
        <?php if (session('swal_success')) : ?>
            Swal.fire({
                icon: 'success',
                title: '<?= session('swal_success'); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>

        <?php if (session('swal_error')) : ?>
            Swal.fire({
                icon: 'error',
                title: '<?= session('swal_error'); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>
    });
</script>
<?= $this->endSection() ?>