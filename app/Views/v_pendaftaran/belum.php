<?= $this->extend('layouts_peserta/template_peserta') ?>

<?= $this->section('header') ?>
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
  <img src="<?= base_url('/assets/logo.png'); ?>" width="55px">
    <h1 class="logo mr-auto"><a href="<?php echo base_url('/'); ?>">E-Magang<span> Diskominfosan</span></a></h1>
    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="<?php echo base_url('/'); ?>">Home</a></li>
        <li><a href="#team">Info Magang</a></li>
        <li><a href="<?php echo base_url('login'); ?>">Login</a></li>
      </ul>
    </nav>
  </div>
</header>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>Pendaftaran Belum Dibuka</h2>
      </div>
    </div>
  </section>

  <!-- ======= Pendaftaran ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h3><span>Pendaftaran Belum Dibuka</span></h3>
        <p>Aplikasi Pendaftaran Magang Mahasiswa - Diskominfosan</p>
      </div>
      <p class="description">Pendaftaran dapat dilakukan mulai dari tanggal <b><?= tgl_indonesia($tgl_buka); ?></b> sampai dengan tanggal <b><?= tgl_indonesia($tgl_tutup); ?></b> melalui Aplikasi E-Magang</p>
    </div>
  </section>

  <!-- ======= Info PMB ======= -->
  <section id="info" class="faq section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Info</h2>
        <h3>Penerimaan <span>Magang Mahasiswa</span></h3>
        <p>Penerimaan Magang Mahasiswa DISKOMINFOSAN Kota Yogyakarta Menciptakan Peserta Magang Terbiasa Dengan Situasi Dan Kondisi Dunia Kerja</p>
      </div>

      <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

        <li class="syarat">
          <a data-toggle="collapse" class="collapsed" href="#faq1">Syarat Umum Pendaftaran Magang Mahasiswa <i class="icofont-simple-up"></i></a>
          <div id="faq1" class="collapse" data-parent=".faq-list">
            <div class="row pt-3">
              <div class="col-md col-lg d-flex">
                <div class="card h-100">
                  <img src="assets/img/info/mahasiswa.jpg" class="card-img-top text-center" alt="Pas Foto">
                  <div class="card-body">
                    <h5 class="card-title">Pendidikan</h5>
                    <p class="card-text">Mahasiswa Semester 5 (D3) / 7 (S1)</p>
                  </div>
                </div>
              </div>
              <div class="col-md col-lg d-flex">
                <div class="card h-100">
                  <img src="assets/img/info/surat.jpg" class="card-img-top" alt="Surat Keterangan">
                  <div class="card-body">
                    <h5 class="card-title">Surat Permohonan Magang</h5>
                    <p class="card-text">Mahasiswa wajib memiliki surat permohonan magang dari kampus</p>
                  </div>
                </div>
              </div>
              <div class="col-md col-lg d-flex">
                <div class="card h-100">
                  <img src="assets/img/info/foto.jpg" class="card-img-top text-center" alt="Pas Foto">
                  <div class="card-body">
                    <h5 class="card-title">Pas Foto</h5>
                    <p class="card-text">Mahasiswa wajib memiliki pas foto dengan ukuran 3 x 4</p>
                  </div>
                </div>
              </div>
              <div class="col-md col-lg d-flex">
                <div class="card h-100">
                  <img src="assets/img/info/video.jpg" class="card-img-top" alt="Video Perkenalan">
                  <div class="card-body">
                    <h5 class="card-title">Video Perkenalan</h5>
                    <p class="card-text">Mahasiswa wajib membuat video perkenalan dengan durasi maksimal 2 menit dan ukuran 20MB</p>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </li>

      </ul>

    </div>
  </section>

  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#42a895" fill-opacity="1" d="M0,288L80,293.3C160,299,320,309,480,298.7C640,288,800,256,960,229.3C1120,203,1280,181,1360,170.7L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
  
</main>
<?= $this->endSection() ?>

