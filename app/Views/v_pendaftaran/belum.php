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
  <section id="team" class="faq section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Info</h2>
        <h3>Penerimaan <span>Mahasiswa Baru</span></h3>
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

