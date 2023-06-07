<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
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
        <section class="content-header mt-4">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('datamentor') ?>">Data Mentor</a></li>
                            <li class="breadcrumb-item active">Ubah Data Mentor</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content mt-2">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ubah Data Mentor</h3>
                            </div>
                            <div class="card-body ">
                                <?= form_open('dataMentor/update/' . $mentor['id']); ?>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama Mentor</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $mentor['nama']; ?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_bidang" class="col-sm-2 col-form-label">Nama Bidang</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="bidang" id="bidang" required>
                                            <option value="<?= $IdBidang; ?>"><?= $nama_bidang; ?></option>
                                            <?php foreach ($bidang as $fak) : ?>
                                                <option value="<?= $fak['id']; ?>"><?= $fak['nama_bidang']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <small id="bidang_error" class="form-text text-danger mb-3"></small>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kategori" id="kategori" >
                                            <option value="<?= $IdKategori; ?>"><?= $nama_kategori; ?></option>
                                        </select>
                                    </div>
                                    <small id="kategori_error" class="form-text text-danger mb-3"></small>
                                </div>


                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>
                                <?= form_close(); ?>
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

</div>

<?= $this->endSection(); ?>
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

    });
</script>
<?= $this->endSection() ?>