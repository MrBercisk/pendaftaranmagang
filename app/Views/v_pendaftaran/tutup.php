<?= $this->extend('layouts_peserta/template_peserta') ?>

<?= $this->section('content') ?>
<main id="main">
  <section class="breadcrumbs m-0">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center ">
        <h2>Pendaftaran</h2>
        <ol>
          <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
          <li>Pendaftaran</li>
        </ol>
      </div>

    </div>
  </section>

  <!-- ======= Pendaftaran ======= -->
  <section id="contact" class="contact mt-4 text-center">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2 class="mt-2">Info</h2>
        <h3><span>Pendaftaran Sudah Ditutup</span></h3>
        <p>Aplikasi Pendaftaran Magang - Diskominfosan Sudah Tutup</p>
      </div>
      <p class="description">Pendaftaran pada Aplikasi E-Magang DISKOMINFOSAN sudah ditutup sejak tanggal <b><?= tgl_indonesia($tgl_tutup); ?></b></p>
    </div>
  </section>

  <!-- ======= Tanggal ======= -->
  <section id="featured-services" class="featured-services">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-md col-lg d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class="bx bx-calendar"></i></div>
            <h4 class="title"><a href="">Tanggal Pendaftaran</a></h4>
            <p class="description">Pendaftaran magang dapat dilakukan mulai dari tanggal <b><?= tgl_indonesia($tanggal['tgl_buka']); ?></b> sampai dengan tanggal <b><?= tgl_indonesia($tanggal['tgl_tutup']); ?></b> melalui Aplikasi E-Magang</p>
          </div>
        </div>
        <div class="col-md col-lg d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bx bx-calendar-exclamation"></i></div>
            <h4 class="title"><a href="">Tanggal Pengumuman Lulus Administrasi</a></h4>
            <p class="description">Pengumuman lulus administrasi dapat dilihat pada tanggal <b><?= tgl_indonesia($tanggal['tgl_pengumuman']); ?></b> dengan cara login menggunakan akun pendaftaran Aplikasi E-Magang</p>
          </div>
        </div>
        <div class="col-md col-lg d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bx bx-alarm-exclamation"></i></div>
            <h4 class="title"><a href="">Durasi Magang</a></h4>
            <p class="description">Kegiatan magang dilaksanakan minimal 3 bulan secara hybrid, dimana mahasiswa datang ke kantor sesuai dengan jadwal yang sudah ditentukan</p>
          </div>
        </div>

      </div>
  </section>


  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#42a895" fill-opacity="1" d="M0,288L80,293.3C160,299,320,309,480,298.7C640,288,800,256,960,229.3C1120,203,1280,181,1360,170.7L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
  </svg>

</main>
<?= $this->endSection() ?>