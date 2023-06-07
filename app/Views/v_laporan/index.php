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
<?php elseif (session()->has('pesan_notif')) : ?>
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Informasi!',
            text: '<?= session()->getFlashdata('pesan_notif') ?>',
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

    <!-- Content Header (Page header) -->
    <section class="content-header mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <div class="d-flex align-items-center">
                                <div class="icon-container">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="text-container">
                                    <p class="m-0">Keterangan : <?= $keterangan_laporan ?></p>
                                </div>

                                <script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js" integrity="sha512-5kvlWpBwI5f5R5iKCT/QnsfdGHg7aFYZBaHslp7iytjz8zeNu2wElaMnZgmL0vCcP8FDrCTH+D1bX0gZolK8zw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.css" integrity="sha512-4bKLyaLkR9Y6FvU6SxU3JdD6zCZ+7TWHMwxTClF2KjJdX9V7av+eqxZuV7ZsGcZsM/JJmb4p4M4yNO+EpxR+dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


                            </div>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
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


    <!-- Main content -->
    <section class="content p-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Input Data Laporan</h3>
                        </div>

                        <div class="container">

                            <form class="mb-3 mt-3" action="/laporanmagang/create" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="judul_laporan" class="form-label">Judul Laporan</label>
                                    <input type="text" class="form-control" id="judul_laporan" name="judul_laporan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="file_laporan" class="form-label">File Laporan (PDF)</label>
                                    <input type="file" class="form-control" id="file_laporan" name="file_laporan" accept=".pdf" required>
                                    <div class="form-text text-danger">** File harus berformat PDF dan tidak lebih dari 2 MB.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="link_drive" class="form-label">Link Google Drive</label>
                                    <input type="url" class="form-control" id="link_drive" name="link_drive">
                                </div>
                                <div class="mb-3">
                                    <label for="form_nilai" class="form-label">Form Nilai (PDF)</label>
                                    <input type="file" class="form-control" id="form_nilai" name="form_nilai" accept=".pdf" required>
                                    <div class="form-text text-danger">** File harus berformat PDF dan tidak lebih dari 2 MB.</div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>

                            </form>

                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                        <?php if (session()->has('success')) : ?>
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: '<?= session('success') ?>',
                                })
                            </script>
                        <?php endif ?>
                        <?php if (session()->has('error')) : ?>
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: '<?= session('error') ?>',
                                })
                            </script>
                        <?php endif ?>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection() ?>