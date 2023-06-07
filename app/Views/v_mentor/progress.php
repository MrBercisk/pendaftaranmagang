<?= $this->extend('layouts_mentor/template_mentor') ?>

<?= $this->section('content') ?>
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
    <section class="content mt-5">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style=" color:#17A2B8;"><i class="fas fa-list"></i> Tabel Data Progress Magang</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead style="background-color: #17A2B8; color:#fff;">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peserta</th>
                                        <th>Judul Project</th>
                                        <th>Tanggal Bimbingan</th>
                                        <th>Pencapaian</th>
                                        <th>Catatan</th>
                                        <th>File Presentasi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>
    .circle-img {
        width: 100px;
        height: 120px;
        object-fit: cover;
    }

    .dataTables_wrapper {
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
                "url": "mentorprogress/ajaxDataProgress",
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

    });
</script>
<?= $this->endSection() ?>