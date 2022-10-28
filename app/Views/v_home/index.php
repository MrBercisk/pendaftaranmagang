<?= $this->extend('layouts_peserta/template_peserta') ?>

<?= $this->section('header') ?>
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">

    <h1 class="logo mr-auto"><a href="<?php echo base_url('/'); ?>">E-Magang<span> Diskominfosan</span></a></h1>

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="<?php echo base_url('/'); ?>">Home</a></li>
        <li><a href="#team">Info Magang</a></li>
        <li><a href="<?php echo base_url('login'); ?>">Login</a></li>

      </ul>
    </nav><!-- .nav-menu -->

  </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="container" data-aos="zoom-out" data-aos-delay="100">
    <h1>Magang<span> Diskominfosan</spa>
    </h1>
    <h2>Aplikasi Pendaftaran Magang Mahasiswa - Kota Yogyakarta</h2>
    <div class="d-flex">
      <a href="<?php echo base_url('pendaftaran'); ?>" class="btn-get-started scrollto">Daftar Sekarang</a>
    </div>
  </div>
</section><!-- End Hero -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main id="main">

  <!-- ======= Tanggal ======= -->
  <section id="featured-services" class="featured-services">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-md-6 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class="bx bx-calendar"></i></div>
            <h4 class="title"><a href="">Tanggal Pendaftaran</a></h4>
            <p class="description">Pendaftaran magang dapat dilakukan mulai dari tanggal <b><?= tgl_indonesia($tanggal['tgl_buka']); ?></b> sampai dengan tanggal <b><?= tgl_indonesia($tanggal['tgl_tutup']); ?></b> melalui Aplikasi E-Magang</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bx bx-calendar-exclamation"></i></div>
            <h4 class="title"><a href="">Tanggal Pengumuman Lulus Administrasi</a></h4>
            <p class="description">Pengumuman lulus administrasi dapat dilihat pada tanggal <b><?= tgl_indonesia($tanggal['tgl_pengumuman']); ?></b> dengan cara login menggunakan akun pendaftaran Aplikasi E-Magang</p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ======= Info PMB ======= -->
  <section id="team" class="faq section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Info</h2>
        <h3>Penerimaan <span>Magang Mahasiswa</span></h3>
        <p>Penerimaan Magang Mahasiswa DISKOMINFOSAN Kota Yogyakarta Menciptakan Peserta Magang Terbiasa Dengan Situasi Dan Kondisi Dunia Kerja</p>
      </div>

      <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

        <li>
          <a data-toggle="collapse" class="collapsed" href="#faq1">Syarat Pendaftaran Magang Mahasiswa <i class="icofont-simple-up"></i></a>
          <div id="faq1" class="collapse" data-parent=".faq-list">
            <p>
              Curriculum Vitae (CV), Video Perkenalan ,Surat Tanda Keterangan Magang Dari Universitas. Pas photo 3 x 4. Seleksi Calon Peserta Magang Sesuai Bidangnya.
            </p>
          </div>
        </li>
      </ul>

    </div>
  </section>

</main>
<?= $this->endSection() ?>