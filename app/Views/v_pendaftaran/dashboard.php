<?= $this->extend('layouts_peserta/template_peserta') ?>

<?= $this->section('header') ?>
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
  <img src="<?= base_url('/assets/logo.png'); ?>" width="55px">
    <h1 class="logo mr-auto"><a href="#">Magang<span> Diskominfosan</span></a></h1>
    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="#">Home</a></li>
        <li><a href="<?php echo base_url('pendaftaran/logout'); ?>">Logout</a></li>
      </ul>
    </nav>
  </div>
</header>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main id="main" data-aos="fade-up">

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>Dashboard Peserta</h2>
      </div>
    </div>
  </section>

  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h3>Nomor Pendaftaran <span><?= $pendaftaran['nomor_pendaftaran']; ?></span></h3>
        <p>Pendaftaran berhasil dilakukan pada tanggal - <?= tgl_indonesia($pendaftaran['tanggal_pendaftaran']); ?></p>
      </div>
      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="member">
            <div class="member-img">
              <img src="/file_peserta/<?= $pendaftaran['foto']; ?>" class="img-fluid " id="previewImg" alt="">
            </div>
            <h5 class="profile-username text-center"><?= $pendaftaran['keahlian']; ?></h5>
            <h4 class="profile-username text-center"><?= $pendaftaran['nama_peserta']; ?></h4>


          </div>
        </div>

        <div class="col-lg">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Data Biodata</a>
            </li>

            <li class="nav-item" role="presentation">
              <a class="nav-link" id="sekolah-tab" data-toggle="tab" href="#sekolah" role="tab" aria-controls="sekolah" aria-selected="false">Data Kampus</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="bidang-tab" data-toggle="tab" href="#bidang" role="tab" aria-controls="bidang" aria-selected="false">Bidang/Kategori</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="periode-tab" data-toggle="tab" href="#periode" role="tab" aria-controls="periode" aria-selected="false">Periode Magang</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <table class="table table-striped mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Biodata</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Nama</td>
                    <td><?= $pendaftaran['nama_peserta']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Keahlian</td>
                    <td><?=$pendaftaran['keahlian']; ?></td>
                  </tr>
                  <tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Tools Yang Dikuasai</td>
                    <td><?=$pendaftaran['tools']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Alamat</td>
                    <td><?= $pendaftaran['alamat_peserta']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>No. Handphone</td>
                    <td><?= $pendaftaran['no_hp']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="sekolah" role="tabpanel" aria-labelledby="sekolah-tab">
              <table class="table table-striped mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kampus</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Nama Univ</td>
                    <td><?= $pendaftaran['nama_kampus']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Program Studi</td>
                    <td><?=$pendaftaran['prodi']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="periode" role="tabpanel" aria-labelledby="periode-tab">
              <table class="table table-striped mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Tanggal Mulai</td>
                    <td><?=$pendaftaran['tanggal_mulai'] ; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Tanggal Selesai</td>
                    <td><?=$pendaftaran['tanggal_selesai'] ; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="bidang" role="tabpanel" aria-labelledby="bidang-tab">
              <table class="table table-striped mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Bidang /Kategori</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Bidang</td>
                    <td><?= $nama_bidang; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Kategori</td>
                    <td><?= $nama_kategori; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Jenis Permohonan</td>
                    <td><?= $pendaftaran['jenis_permohonan']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Status Permohonan</td>
                    <td><?= $pendaftaran['status_permohonan']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Judul Project</td>
                    <td><?= $pendaftaran['judul']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Preview Berkas Pendaftaran -->
          <button type="button" class="btn btn-primary col-lg-4 mt-2" data-toggle="modal" data-target="#exampleModal">
            View Berkas Pendaftaran
          </button>
          <!-- Cetak Bukti Pendaftaran -->
          <a href="<?php echo base_url('pendaftaran/buktipendaftaran'); ?>" type="button" class="btn btn-primary col-lg-4 mt-2 " type="submit" id="btn-cetakKartu" target="_blank">Cetak Bukti Pendaftaran</a>

          <!-- Tanggal Pengumuman Lulus Administrasi -->
          <?php if ($tgl_sekarang < $tgl_pengumuman) : ?>
            <div class="alert alert-info mt-4" role="alert">
              <h4 class="alert-heading">Pengumuman Lulus Administrasi!</h4>
              <p>Pengumuman lulus administrasi dapat dilihat pada tanggal <b><?= tgl_indonesia($tgl_pengumuman); ?></b></p>
              <hr>
            </div>
          <?php endif ?>

          <!-- Verifikasi Pendaftaran -->
          <?php if ($tgl_sekarang >= $tgl_pengumuman) : ?>
            <!-- Lulus -->
            <?php if ($pendaftaran['status_verifikasi'] == "Lulus") : ?>
              <div class="alert alert-primary mt-4" role="alert">
                <h4 class="alert-heading">Selamat!</h4>
                <p>Anda lulus pada kategori <b><?= $nama_kategori . " - " . $nama_bidang; ?></b></p>
                <p>Link Magang : <a href="<?= base_url('magang'); ?>">Anda bisa masuk ke link ini untuk magang</a></p>  
                <i class='bx bxs-pin'></i><b>DIMOHON UNTUK TIDAK SHARE LINK MAGANG KEPADA SIAPAPUN !!!</b></i>
                <hr>
              </div>
            <?php endif ?>
            <!-- Tidak Lulus -->
            <?php if ($pendaftaran['status_verifikasi'] == "Tidak Lulus") : ?>
              <div class="alert alert-danger mt-4" role="alert">
                <h4 class="alert-heading">Mohon maaf!</h4>
                <p>Anda tidak lulus pendaftaran penerimaan magang diskominfosan karena tidak memenuhi syarat</b></p>
                <hr>
              </div>
            <?php endif ?>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>

</main>

<!-- Preview Berkas -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Berkas Pendaftaran <?= $pendaftaran['nama_peserta']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <embed src="/file_peserta/<?= $pendaftaran['berkas']; ?>" type="application/pdf" width="100%" height="450px">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>