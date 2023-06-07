<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Aplikasi E-Magang</h3>
              <p>Aplikasi Pendaftaran Magang Mahasiswa - Diskominfosan Kota Yogyakarta</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-clipboard"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= hitungData('tbl_pendaftaran') ?></h3>

              <p>Jumlah Pendaftar</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-users"></i>
            </div>
            <a href="<?php echo base_url('datapendaftaran'); ?>" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= hitungData('tbl_bidang') ?></h3>

              <p>Bidang Tersedia</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-university"></i>
            </div>
            <a href="<?php echo base_url('databidang'); ?>" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= hitungData('tbl_kategori') ?></h3>

              <p>Kategori Tersedia</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-school"></i>
            </div>
            <a href="<?php echo base_url('databidang'); ?>" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>

    <div class="col-lg-6">
      <div class="card text-white bg-primary">
        <div class="card-header">GRAFIK PENDAFTAR</div>
        <div class="card-body bg-white">
          <div id="container" style="width:100%; height:400px;"></div>
        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>