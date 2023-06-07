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


    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-2">
                        <h4>Profil Peserta</h4>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-2">
                        <div class="card-body text-center">
                            <img src="<?php echo base_url('file_peserta/' . $foto); ?>" alt="User profile picture" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"><?= $nama; ?></h5>
                            <p class="text-muted mb-1"><?= $keahlian; ?></p>
                            <p class="text-muted mb-4"><?= $alamat_peserta; ?></p>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-8">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">NIM</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $nim; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Nama Peserta</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $nama_peserta; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $email; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">No. Telp</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $no_hp; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Nama Kampus</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $nama_kampus; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Judul Proyek</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $judul; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Status Permohonan</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $status_permohonan; ?></p>
                                    <?php if ($status_permohonan === 'Kelompok') : ?>
                                        <p class="text-muted mb-0">Anggota 1 : <?= $nama_anggota_1; ?></p>
                                        <p class="text-muted mb-0">Anggota 2 : <?= $nama_anggota_2; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">Progress Selama Kegiatan Magang</span></p>
                                    <p class="mb-1" style="font-size: .77rem;">Progress Magang</p>
                                    <div class="progress rounded" style="height: 12px;">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $progressMagang ?>%" aria-valuenow="<?= $progressMagang ?>" aria-valuemin="0" aria-valuemax="100">
                                            <?php if ($progressMagang > 0) : ?>
                                                <div class="progress-value">
                                                    <span class="value"><?= $progressMagang ?>%</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Laporan Magang</p>
                                    <div class="progress rounded" style="height: 12px;">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $progressLaporan ?>%" aria-valuenow="<?= $progressLaporan ?>" aria-valuemin="0" aria-valuemax="100">
                                            <?php if ($progressLaporan > 0) : ?>
                                                <div class="progress-value">
                                                    <span class="value"><?= $progressLaporan ?>%</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="text-container">
                                        <p class="m-0">Keterangan: <?= $keterangan_laporan ?></p>
                                        <p class="m-0">Status Magang: <?= $status_magang ?></p>
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