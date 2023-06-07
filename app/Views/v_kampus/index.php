<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content'); ?>
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
    <section class="content mt-5">

        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <!-- Modal Add -->
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style=" color:#17A2B8;"><i class="fas fa-plus"></i> Tambah Kampus Yang Tersedia</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url("Kampus/tambah") ?>" method="post">
                                <div class="mb-3">
                                    <label for="nama_kampus" class="form-label">Nama Kampus</label>
                                    <input type="text" class="form-control" id="nama_kampus" name="nama_kampus" required >
                                    <small id="nama_kampus_error" class="text-danger"> </small>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>

                                <script>
                                    // SweetAlert notification
                                    <?php if (session()->getFlashdata('success')) : ?>
                                        Swal.fire({
                                            title: 'Sukses!',
                                            text: '<?php echo session()->getFlashdata('success'); ?>',
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        })
                                    <?php endif; ?>
                                </script>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-8">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style=" color:#17A2B8;"><i class="fas fa-list"></i> Daftar Kampus Yang Tersedia</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead style="background-color: #17A2B8; color:#fff;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kampus</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
    .dataTables_wrapper {

        font-size: 14px;
        /* ukuran font */
        line-height: 1.5;
        /* jarak antar baris */
        font-family: Arial, Helvetica, sans-serif;
        /* jenis font */
    }
</style>

<?= $this->endSection(); ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {

        //Menampilkan data Laporan (dataTable server-side)
        $('#example1').DataTable({
            "responsive": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "kampus/ajaxDataKampus",
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
        //-------------------------------------------------------------------
        //Hapus data
        $('body').on('click', '.btn-deleteKampus', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            Swal.fire({
                title: 'Hapus Data?',
                text: "Anda ingin menghapus data kampus ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Hapus Data!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: "POST",
                        success: function(response) {
                            $('#example1').DataTable().ajax.reload()
                            toastr.info('Data Mentor berhasil dihapus.');
                        }
                    });
                }
            });

        });
    });
</script>
<?= $this->endSection() ?>