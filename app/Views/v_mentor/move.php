<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">

    <h2>Move Mentor</h2>

    <p>Silakan pilih kategori atau bidang untuk memindahkan peserta magang:</p>

    <form action="" method="post">
        <div class="form-group">
            <label for="kategori">Kategori:</label>
            <select class="form-control" id="kategori" name="kategori">
                <?php foreach ($kategori as $row) : ?>
                    <option value="<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="bidang">Bidang:</label>
            <select class="form-control" id="bidang" name="bidang">
                <?php foreach ($bidang as $row) : ?>
                    <option value="<?php echo $row['id_bidang']; ?>"><?php echo $row['nama_bidang']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="hidden" name="nama_peserta" value="<?php echo $namaPeserta; ?>">
        <button type="submit" class="btn btn-primary">Move Mentor</button>
    </form>
</div>
<?= $this->endSection() ?>