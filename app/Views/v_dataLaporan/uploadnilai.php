<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Upload Form Nilai</h1>

    <div class="row">
        <div class="col-md-8">
            <form action="<?= base_url('/upload-form-nilai/' . $id_laporan); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="form_nilai">Form Nilai</label>
                    <input type="file" class="form-control-file" id="form_nilai" name="form_nilai" accept=".pdf" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>