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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
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
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= hitungDataDiterima('tbl_pendaftaran') ?></h3>
              <p>Jumlah Pendaftar Diterima</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-check"></i>
            </div>
            <a href="<?php echo base_url('datapendaftaran'); ?>" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
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
        <div class="col-lg-3 col-6">
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

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title"><i class="far fa-calendar-alt"></i> Kalender Magang</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div id="calendar"></div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Grafik Pendaftar Magang Diskominfosan</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="myChart" width="100%" height="70"></canvas>
            </div>
          </div>
        </div>

      </div>
    </div>



    <script>
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?= json_encode($labels); ?>,
          datasets: [{
            label: 'Diterima',
            data: <?= json_encode($diterima); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2
          }, {
            label: 'Tidak Diterima',
            data: <?= json_encode($tidak_diterima); ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 2
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    </script>

    <style>
      .calendar-container {
        background-color: #f8f8f8;
        margin: 10px 0;
        padding: 20px;
        border-radius: 5px;
      }

      .calendar-header {
        margin-bottom: 20px;
      }

      .calendar-header h2 {
        font-size: 28px;
        font-weight: bold;
        color: #333;
      }

      .calendar-body {
        overflow: auto;
      }
    </style>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>