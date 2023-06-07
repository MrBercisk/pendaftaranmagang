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
<?php elseif (session()->has('pesan_info')) : ?>
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Informasi!',
            text: '<?= session()->getFlashdata('pesan_info') ?>',
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


    <!-- Main content -->
    <section class="content mt-4 p-4">
        <div class="container-fluid" data-aos="fade-up">
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php
                        $tanggal_sekarang = date('Y-m-d');
                        if ($tanggal_sekarang <= $tanggal_selesai) { ?>
                            <li class="nav-item active" role="presentation">
                                <a class="nav-link active" id="dataprogress-tab" data-toggle="tab" href="#dataprogress" role="tab" aria-controls="dataprogress" aria-selected="true"><i class="fas fa-chart-bar"></i> Data Progress</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="formprogress-tab" data-toggle="tab" href="#formprogress" role="tab" aria-controls="formprogress" aria-selected="true"><i class="fas fa-tasks"></i> Input Progress</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="dataprogress-tab" data-toggle="tab" href="#dataprogress" role="tab" aria-controls="dataprogress" aria-selected="true"><i class="fas fa-chart-bar"></i> Data Progress</a>
                            </li>
                        <?php } ?>
                    </ul>

                    <style>
                        .nav-tabs .nav-item.show .nav-link,
                        .nav-tabs .nav-link.active {
                            border-top: 3px solid blue;
                        }

                        .nav-tabs .nav-item .nav-link {
                            background-color: white;
                        }
                    </style>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade bg-white show active" id="dataprogress" role="tabpanel" aria-labelledby="dataprogress-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Progress</h3>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered bg-white table-hover" id="example1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Project</th>
                                            <th>Tanggal Bimbingan</th>
                                            <th>Pencapaian</th>
                                            <th>Catatan</th>
                                            <th>File Presentasi</th>
                                            <th>Tanggal Upload</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="formprogress" role="tabpanel" aria-labelledby="formprogress-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Progress Magang Mahasiswa</h3>
                                </div>
                                <div class="p-5">
                                    <form class="row g-3 needs-validation" action="/progressmagang/create" method="POST" enctype="multipart/form-data" novalidate>
                                        <div class="col-md-6">
                                            <label for="judul" class="form-label">Judul Project</label>
                                            <input type="text" name="judul" value="<?php echo $judul; ?>" class="form-control" id="judul" readonly required>
                                            <div class="invalid-feedback">
                                                Mohon isi judul project.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tgl_bimbingan" class="form-label">Tanggal Bimbingan</label>
                                            <input type="date" class="form-control" id="tgl_bimbingan" name="tgl_bimbingan" required>
                                            <div class="invalid-feedback">
                                                Mohon isi tanggal bimbingan.
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="pencapaian" class="form-label">Pencapaian</label>
                                            <textarea class="form-control" id="pencapaian" name="pencapaian" required></textarea>
                                            <div class="invalid-feedback">
                                                Mohon isi pencapaian.
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="catatan" class="form-label">Catatan</label>
                                            <textarea class="form-control" id="catatan" name="catatan" required placeholder="Isi catatan jika ada catatan dari mentor saat bimbingan"></textarea>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="file_presentasi" class="form-label">File Presentasi (PDF)</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="file_presentasi" name="file_presentasi" accept=".pdf" required>
                                            </div>
                                            <div class="form-text text-muted mb-3">
                                                File harus berformat PDF dan tidak lebih dari 2 MB.
                                            </div>
                                            <div class="invalid-feedback">
                                                Mohon upload file presentasi (PDF).
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Simpan
                                            </button>
                                        </div>


                                    </form>

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

        //Menampilkan data User (dataTable server-side)
        $('#example1').DataTable({
            "responsive": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "progressmagang/ajaxDataProgress",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });

        //-------------------------------------------------------------------

    });
</script>

<?= $this->endSection() ?>