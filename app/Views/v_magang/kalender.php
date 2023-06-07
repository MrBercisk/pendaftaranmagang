<?= $this->extend('layouts_magang/template_magang') ?>
<?= $this->section('content') ?>
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
<!-- Content Wrapper. Contains page content -->
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
    <section class="content">
        <div class="container-fluid">

            <div class="calendar-container">
                <div class="calendar-body">
                    <div id="calendar"></div>
                </div>
            </div>

            <style>
                .calendar-container {
                    background-color: #f8f8f8;
                    margin: 10px 0;
                    padding: 20px;
                    border-radius: 5px;
                }

                .calendar-header {
                    margin-bottom: 20px;
                }

                .calendar-header h2 {
                    font-size: 28px;
                    font-weight: bold;
                    color: #333;
                }

                .calendar-body {
                    overflow: auto;
                }
            </style>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>