<?= $this->extend('layouts_admin/template_admin') ?>

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
                    <!-- Modal Add -->


                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style=" color:#17A2B8;"><i class="fas fa-list"></i> Tabel Data Mentor</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <a href="<?= base_url('datamentor/add') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"> Tambah Data</i></a>
                            <table class="table table-bordered table-striped" id="example1">
                                <thead style="background-color: #17A2B8; color:#fff;">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        //Menampilkan Pilihan kategori Berdasarkan bidang
        $('#bidang').on('change', function() {
            const id = $(this).val();

            $.ajax({
                url: "<?php echo base_url('dataMentor/ajaxPilihanKategori') ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: "JSON",
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama_kategori + '</option>';
                    }
                    $('#kategori').html(html);
                }

            });

        });

        //Menampilkan data User (dataTable server-side)
        $('#example1').DataTable({
            "responsive": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "datamentor/ajaxDataMentor",
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
        $('body').on('click', '.btn-deleteMentor', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            Swal.fire({
                title: 'Hapus Data?',
                text: "Anda ingin menghapus data mentor ini?",
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