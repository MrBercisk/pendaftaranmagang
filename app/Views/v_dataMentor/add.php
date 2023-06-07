<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
    <section class="content-header mt-4">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('datamentor') ?>">Data Mentor</a></li>
                        <li class="breadcrumb-item active">Tambah Data Mentor</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Data Mentor</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- /.card-header -->
                        <?= form_open('dataMentor/tambah_mentor', ['id' => 'formTambahMentor']) ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" required>
                                <small id="nama_error" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                                <small id="email_error" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                                <small id="password_error" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Masukkan konfirmasi password" required>
                                <small id="confirm_password_error" class="text-danger"></small>
                            </div>
                            <label for="tahun">Pilih Bidang Dan Kategori Pada Diskominfosan</label>
                            <div class="form-group">
                                <select class="form-control" name="bidang" id="bidang" required>
                                    <option value="<?= $IdBidang; ?>"><?= $nama_bidang; ?></option>
                                    <?php foreach ($bidang as $fak) : ?>
                                        <option value="<?= $fak['id']; ?>"><?= $fak['nama_bidang']; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <small id="bidang_error" class="form-text text-danger mb-3"></small>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="kategori" name="kategori" required>
                                    <option value="<?= $IdKategori; ?>"><?= $nama_kategori; ?></option>
                                </select>
                                <small id="kategori_error" class="form-text text-danger mb-3"></small>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="btn-tambah">Tambah</button>
                        </div>

                        <?= form_close() ?>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

        //Submit pendaftaran user
        $('#btn-tambah').on('click', function(e) {
            e.preventDefault(); // Menghentikan aksi default tombol submit

            const formTambahMentor = $('#formTambahMentor');

            $.ajax({
                url: "<?php echo base_url('dataMentor/tambah_mentor') ?>",
                method: "POST",
                data: formTambahMentor.serialize(),
                dataType: "JSON",
                success: function(data) {
                    // Data Error
                    if (data.error) {
                        if (data.tambah_mentor_error['nama'] != '') $('#nama_error').html(data.tambah_mentor_error['nama']);
                        else $('#nama_error').html('');

                        if (data.tambah_mentor_error['email'] != '') $('#email_error').html(data.tambah_mentor_error['email']);
                        else $('#email_error').html('');

                        if (data.tambah_mentor_error['password'] != '') $('#password_error').html(data.tambah_mentor_error['password']);
                        else $('#password_error').html('');

                        if (data.tambah_mentor_error['confirm_password'] != '') $('#confirm_password_error').html(data.tambah_mentor_error['confirm_password']);
                        else $('#confirm_password_error').html('');
                    } else {
                        // Pendaftaran Sukses
                        formTambahMentor.trigger('reset');
                        $('#nama_error').html('');
                        $('#email_error').html('');
                        $('#password_error').html('');
                        $('#confirm_password_error').html('');
                        $('#bidang_error').html('');
                        $('#kategori_error').html('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Tambah Data Mentor Berhasil',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            window.location.replace(data.link); // Mengarahkan ke halaman dataMentor setelah sukses
                        });
                    }
                }
            });
        });

        //-------------------------------------------------------------------

    });
</script>
<?= $this->endSection() ?>