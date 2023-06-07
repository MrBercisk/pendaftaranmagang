<div class="modal fade" id="modalAdd">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Data Jadwal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('jadwalPeserta/add', ['id' => 'formTambahJadwal']) ?>
            <div class="modal-body">
                <input type="hidden" name="pendaftaran_id" />
                <div class="form-group">
                    <label for="nama_peserta">Nama Peserta</label>
                    <select class="form-control" name="nama_peserta" required>
                        <option value="">-- Pilih Nama Peserta --</option>
                        <?php foreach ($peserta as $p) : ?>
                            <option value="<?= $p['id'] ?>"><?= $p['nama_peserta'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small id="nama_peserta_error" class="text-danger"></small>
                </div>

                <?php if (!isset($dataExists) || empty($dataExists)) : ?>
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" value="<?= set_value('tanggal_mulai') ?>">
                        <small id="tanggal_mulai_error" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tanggal_selesai" value="<?= set_value('tanggal_selesai') ?>">
                        <small id="tanggal_selesai_error" class="text-danger"></small>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="tanggal_bimbingan">Tanggal Bimbingan</label>
                    <input type="date" class="form-control" name="tanggal_bimbingan">
                    <small id="tanggal_bimbingan_error" class="text-danger"> </small>
                </div>
                <div class="form-group">
                    <label for="jam_bimbingan">Jam Bimbingan</label>
                    <input type="time" class="form-control" name="jam_bimbingan" step="3600">
                    <small id="jam_bimbingan_error" class="text-danger"> </small>
                </div>

            </div>
            <?= form_close() ?>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-tambah">Tambah</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>