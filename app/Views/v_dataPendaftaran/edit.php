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


        <!-- Main content -->
        <section class="content mt-5">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ubah Status Verifikasi Pendaftar</h3>
                            </div>
                            <div class="card-body ">
                                <?= form_open('dataPendaftaran/update/' . $pendaftaran['id']); ?>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama Peserta</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="<?= $pendaftaran['nama_peserta']; ?>" readonly >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_verifikasi" class="col-sm-2 col-form-label">Status Verifikasi</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="status_verifikasi" name="status_verifikasi">
                                            <option value="Diterima" <?= ($pendaftaran['status_verifikasi'] == 'Diterima') ? 'selected' : ''; ?>>Diterima</option>
                                            <option value="Tidak Diterima" <?= ($pendaftaran['status_verifikasi'] == 'Tidak Diterima') ? 'selected' : ''; ?>>Tidak Diterima</option>
                                            <option value="Belum Verifikasi" <?= ($pendaftaran['status_verifikasi'] == 'Belum Verifikasi') ? 'selected' : ''; ?>>Belum Verifikasi</option>
                                        </select>
                                    </div>
                                </div>

                                <?php if ($pendaftaran['status_verifikasi'] == 'Tidak Diterima') : ?>
                                    <div class="form-group row">
                                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan (Tidak Diterima)</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="keterangan" id="keterangan">
                                                <option selected>Pilih keterangan/alasan mengapa peserta tidak diterima</option>
                                                <option value="Bidang/Kategori yang dipilih tidak sesuai dengan keahlian">Bidang/Kategori yang dipilih tidak sesuai dengan keahlian</option>
                                                <option value="Keahlian/Tools yang dikuasai peserta belum memenuhi syarat">Keahlian/Tools yang dikuasai peserta belum memenuhi syarat</option>
                                                <option value="Jurusan tidak sesuai">Jurusan tidak sesuai</option>
                                                <option value="Berkas peserta tidak lengkap">Berkas peserta tidak lengkap</option>
                                                <option value="Slot sudah terisi/sudah penuh">Slot sudah terisi/sudah penuh</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>


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