<?= $this->extend('layouts_peserta/template_peserta') ?>

<?= $this->section('header') ?>
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">

    <img src="<?= base_url('/assets/logo.png'); ?>" width="35px">
    <h1 class="logo mr-auto"><a href="<?php echo base_url('/'); ?>">SI AMANG</a></h1>

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="<?php echo base_url('/'); ?>">Home</a></li>
        <li><a href="#info">Info Magang</a></li>
        <li><a href="#pedoman">Pedoman</a></li>
        <li><a href="#panduan">Panduan Magang</a></li>
        <li><a href="<?php echo base_url('login'); ?>"><i class='bx bx-log-in'></i> Login</a></li>
      </ul>
    </nav><!-- .nav-menu -->

  </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="container" data-aos="zoom-out" data-aos-delay="100">
    <div class="row">
      <div class="text col lg-8">
        <h1>SI AMANG</h1>
        <h2>Sistem Informasi Aplikasi Magang DISKOMINFOSAN Kota Yogyakarta memudahkan untuk mendaftar magang bagi mahasiswa di Kota Yogyakarta</h2>
        <div class="d-flex">
          <a href="<?php echo base_url('pendaftaran'); ?>" class="btn-get-started scrollto"> Daftar Sekarang</a>
        </div>
      </div>
      <div class="col-lg-4">
        <lottie-player class="animasi" src="https://assets6.lottiefiles.com/private_files/lf30_vAtD7F.json" background="transparent" speed="1" style="width: 400px; height: 400px;" loop autoplay></lottie-player>
      </div>
    </div>

  </div>
</section><!-- End Hero -->

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main id="main">
  <section id="kategori">
    <div class="container data-aos=" fade-up"">
      <div class="row mb-3">
        <div class="section-title col-md-12" data-aos="fade-up">
          <h3>Pilihan<span> Bidang dan Kategori</span> Yang Tersedia</h3>
          <p>Terdapat beberapa pilihan Bidang dan Kategori yang sesuai dengan keahlian dan tools yang anda kuasai</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-4 p-4" data-aos="fade-up">
          <div class="row">
            <div class="col-12">
              <img src="assets/bizland/img/Bidang dan Kategori/1.png" class="card-img img-fluid">
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 p-4" data-aos="fade-up">
          <div class="row ">
            <div class="col-12">
              <img src="assets/bizland/img/Bidang dan Kategori/2.png" class="card-img img-fluid">
            </div>
          </div>
        </div>

        <div class="col-md-6 mb-4 p-4" data-aos="fade-up">
          <div class="row ">
            <div class="col-12">
              <img src="assets/bizland/img/Bidang dan Kategori/4.png" class="card-img img-fluid">
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 p-4" data-aos="fade-up">
          <div class="row ">
            <div class="col-12">
              <img src="assets/bizland/img/Bidang dan Kategori/3.png" class="card-img img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
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
              <div class="col-md-2 col-lg d-flex">
                <div class="card h-100">
                  <img src="assets/img/info/surat.jpg" class="card-img-top" alt="Surat Keterangan">
                  <div class="card-body">
                    <h5 class="card-title">Surat Permohonan Magang & NDA</h5>
                    <p class="card-text">Mahasiswa wajib memiliki surat permohonan magang dari kampus dan NDA perjanjian magang DISKOMINFOSAN yang dapat di download<a href="<?php echo base_url('pendaftaran/nda'); ?>" id="btn-cetakKartu" target="_blank">Disini</a></p>
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
      <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

        <li class="syarat">
          <a data-toggle="collapse" class="collapsed" href="#faq2">Lowongan Yang Tersedia <i class="icofont-simple-up"></i></a>
          <div id="faq2" class="collapse" data-parent=".faq-list">
            <div class="table-responsive mt-2">
              <table class="table table-hover">
                <thead class="text-center">
                  <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Project yang Tersedia</th>
                    <th>Definisi</th>
                    <th>Fitur yang Dibutuhkan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ?>
                  <?php foreach ($kategori as $k) : ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $k['nama_kategori']; ?></td>
                      <td><?= $k['syarat']; ?></td>
                      <td><?= $k['tugas']; ?></td>
                      <td><?= $k['fitur']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </li>
      </ul>
      <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

        <li class="syarat">
          <a data-toggle="collapse" class="collapsed" href="#faq3">Pendaftar Yang Diterima <i class="icofont-simple-up"></i></a>
          <div id="faq3" class="collapse" data-parent=".faq-list">
            <div class="table-responsive mt-2">
              <table class="table table-hover">
                <thead class="text-center">
                  <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>Nomor Pendaftaran</th>
                    <th>Nama Peserta</th>
                    <th>Tanggal Mendaftar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ?>
                  <?php foreach ($pendaftaran as $p) : ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><img src="<?= base_url('/file_peserta/' . $p['foto']); ?>" style="width: 80px; height: 80px; border-radius: 50%;"></td>
                      <td><?= $p['nomor_pendaftaran']; ?></td>
                      <td><?= $p['nama_peserta']; ?></td>
                      <td><?= $p['tanggal_pendaftaran']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </li>

      </ul>

    </div>
  </section>

  <!-- ======= Pedoman ======= -->
  <section id="pedoman">
    <div class="container">
      <div class="section-title">
        <!-- <h2>Pedoman</h2> -->
        <h3>Pedoman <span>Magang Mahasiswa</span></h3>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-5 pedoman-image" data-aos="flip-right" data-aos-duration="3000">
            <img src="assets/img/pedoman/pedoman.jpg" alt="Pedoman">
          </div>
          <div class="isi-pedoman col-lg-5" data-aos="fade-up" data-aos-duration="3000">
            <h5>Pedoman magang berisikan hal-hal penting yang harus diperhatikan oleh mahasiswa magang, seperti : </h5>
            <ul>
              <li>Aturan Magang</li>
              <li>Format Laporan</li>
              <li>Tentang Instansi</li>
              <li>Untuk selengkapnya <a href="https://docs.google.com/document/d/18MTJJ2lfO7cCuekA1WAfEjBX1N_RkzL7PqrJ4WFtMOE/edit" target="_blank">Klik Disini !</a></li>
            </ul>
            <h5 class="card-title"></h5>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ======= Panduan ======= -->
  <section id="panduan">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h3>Panduan <span>Magang Mahasiswa</span></h3>
      </div>
      <div class="container">
        <div class="group" data-aos="flip-right" data-aos-duration="3000">
          <i class="bi bi-1-circle"></i>
          <img src="<?= base_url('assets/img/panduan/1.jpg'); ?>" alt="" width="200px">
          <h6>Melihat Info Lowongan Magang</h6>
          <p>Mahasiswa dapat memilih program magang sesuai dengan kemampuan dan kebutuhan perusahaan</p>
        </div>
        <div class="group" data-aos="flip-right" data-aos-duration="3000">
          <i class="bi bi-2-circle"></i>
          <img src="<?= base_url('assets/img/panduan/2.jpg'); ?>" alt="" width="200px">
          <h6>Login</h6>
          <p>Mahasiswa melakukan login terlebih dahulu sebelum mendaftar program magang</p>
        </div>
        <div class="group" data-aos="flip-right" data-aos-duration="3000">
          <i class="bi bi-3-circle"></i>
          <img src="<?= base_url('assets/img/panduan/3.jpg'); ?>" alt="" width="200px">
          <h6>Mengisi Form Pendaftaran</h6>
          <p>Mahasiswa diwajibkan mengisi form pendaftaran dengan benar</p>
        </div>
        <div class="group" data-aos="flip-right" data-aos-duration="3000">
          <i class="bi bi-4-circle"></i>
          <img src="<?= base_url('assets/img/panduan/4.jpg'); ?>" alt="" width="200px">
          <h6>Konfirmasi</h6>
          <p>Mahasiswa diharapkan menunggu konfirmasi diterima magang agar dapat melakukan kegiatan magang</p>
        </div>
        <div class="group" data-aos="flip-right" data-aos-duration="3000">
          <i class="bi bi-5-circle"></i>
          <img src="<?= base_url('assets/img/panduan/5.jpg'); ?>" alt="" width="200px">
          <h6>Magang</h6>
          <p>Mahasiswa melakukan kegiatan magang sesuai dengan peraturan dan jadwal yang telah ditentukan</p>
        </div>
        <div class="group" data-aos="flip-right" data-aos-duration="3000">
          <i class="bi bi-6-circle"></i>
          <img src="<?= base_url('assets/img/panduan/6.jpg'); ?>" alt="" width="200px">
          <h6>Progress</h6>
          <p>Mahasiswa wajib memberikan info progress magang agar pembimbing dapat memantau kegiatan magang mahasiswa</p>
        </div>
        <div class="group" data-aos="flip-right" data-aos-duration="3000">
          <i class="bi bi-7-circle"></i>
          <img src="<?= base_url('assets/img/panduan/7.jpg'); ?>" alt="" width="200px">
          <h6>Laporan</h6>
          <p>Bagi mahasiswa yang sudah selesai mengerjakan tugas magang diwajibkan membuat dan mengumpulkan laporan kegiatan magang</p>
        </div>
        <div class="group" data-aos="flip-right" data-aos-duration="3000">
          <i class="bi bi-8-circle"></i>
          <img src="<?= base_url('assets/img/panduan/8.jpg'); ?>" alt="" width="200px">
          <h6>Selesai</h6>
          <p>Mahasiswa yang sudah selesai mengumpulkan laporan magang dinyatakan telah selesai melaksanakan program magang dengan mendapatkan nilai magang</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ======= Mentor ======= -->
  <!-- <section id="team">
    <div class="container">
      <div class="section-title">
        <h2>Team</h2>
        <h3>Mahasiswa <span>Yang Diterima Magang</span></h3>
      </div>

      <div class="container">
        <div class="group">
          <?php foreach ($pendaftaran as $p) : ?>
            <img class="img-mentor" src="<?= base_url('/file_peserta/' . $p['foto']); ?>" style="width: 100px; height: 100px;">
            <h6 class="nama-mentor">Profil Peserta</h6>
            <p><?= $p['nama_peserta']; ?></p>
            <p><?= $p['keahlian']; ?></p>
            <p><?= $p['nama_kampus']; ?></p>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section> -->
  <style>
    .mentor-card {
      display: flex;
      flex-direction: row;
      justify-content: flex-start;
      align-items: center;
      margin-bottom: 20px;
      padding: 10px;
      background-color: #f9f9f9;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .img-mentor {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-right: 20px;
    }

    .mentor-info {
      display: flex;
      flex-direction: column;
    }

    .nama-mentor {
      margin: 0;
      font-size: 24px;
      font-weight: bold;
    }

    .mentor-detail {
      margin: 0;
      font-size: 18px;
    }
  </style>


  <input class='chatMenu hidden' id='offchatMenu' type='checkbox' />
  <label class='chatButton' for='offchatMenu'>
    <svg class='svg-1' viewBox='0 0 32 32'>
      <g>
        <path d='M16,2A13,13,0,0,0,8,25.23V29a1,1,0,0,0,.51.87A1,1,0,0,0,9,30a1,1,0,0,0,.51-.14l3.65-2.19A12.64,12.64,0,0,0,16,28,13,13,0,0,0,16,2Zm0,24a11.13,11.13,0,0,1-2.76-.36,1,1,0,0,0-.76.11L10,27.23v-2.5a1,1,0,0,0-.42-.81A11,11,0,1,1,16,26Z'></path>
        <path d='M19.86,15.18a1.9,1.9,0,0,0-2.64,0l-.09.09-1.4-1.4.09-.09a1.86,1.86,0,0,0,0-2.64L14.23,9.55a1.9,1.9,0,0,0-2.64,0l-.8.79a3.56,3.56,0,0,0-.5,3.76,10.64,10.64,0,0,0,2.62,4A8.7,8.7,0,0,0,18.56,21a2.92,2.92,0,0,0,2.1-.79l.79-.8a1.86,1.86,0,0,0,0-2.64Zm-.62,3.61c-.57.58-2.78,0-4.92-2.11a8.88,8.88,0,0,1-2.13-3.21c-.26-.79-.25-1.44,0-1.71l.7-.7,1.4,1.4-.7.7a1,1,0,0,0,0,1.41l2.82,2.82a1,1,0,0,0,1.41,0l.7-.7,1.4,1.4Z'></path>
      </g>
    </svg>
    <svg class='svg-2' viewBox='0 0 512 512'>
      <path d='M278.6 256l68.2-68.2c6.2-6.2 6.2-16.4 0-22.6-6.2-6.2-16.4-6.2-22.6 0L256 233.4l-68.2-68.2c-6.2-6.2-16.4-6.2-22.6 0-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3l68.2 68.2-68.2 68.2c-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3 6.2 6.2 16.4 6.2 22.6 0l68.2-68.2 68.2 68.2c6.2 6.2 16.4 6.2 22.6 0 6.2-6.2 6.2-16.4 0-22.6L278.6 256z'></path>
    </svg>
  </label>

  <div class='chatBox'>
    <div class='chatContent'>
      <div class='chatHeader'>
        <svg viewbox='0 0 32 32'>
          <path d='M24,22a1,1,0,0,1-.64-.23L18.84,18H17A8,8,0,0,1,17,2h6a8,8,0,0,1,2,15.74V21a1,1,0,0,1-.58.91A1,1,0,0,1,24,22ZM17,4a6,6,0,0,0,0,12h2.2a1,1,0,0,1,.64.23L23,18.86V16.92a1,1,0,0,1,.86-1A6,6,0,0,0,23,4Z'></path>
          <rect height='2' width='2' x='19' y='9'></rect>
          <rect height='2' width='2' x='14' y='9'></rect>
          <rect height='2' width='2' x='24' y='9'></rect>
          <path d='M8,30a1,1,0,0,1-.42-.09A1,1,0,0,1,7,29V25.74a8,8,0,0,1-1.28-15,1,1,0,1,1,.82,1.82,6,6,0,0,0,1.6,11.4,1,1,0,0,1,.86,1v1.94l3.16-2.63A1,1,0,0,1,12.8,24H15a5.94,5.94,0,0,0,4.29-1.82,1,1,0,0,1,1.44,1.4A8,8,0,0,1,15,26H13.16L8.64,29.77A1,1,0,0,1,8,30Z'></path>
        </svg>
        <div class='chatTitle'>Silahkan chat dengan tim kami <span>Admin akan membalas dalam beberapa menit</span></div>
      </div>
      <div class='chatText'>
        <span>Halo, Ada yang bisa kami bantu?</span>
        <span class='typing'>...</span>
      </div>
    </div>

    <a class='chatStart' href='https://api.whatsapp.com/send?phone=6281334485889&text=Assalamualaikum,%20Saya%20ingin%20bertanya' rel='nofollow noreferrer' target='_blank'>
      <span>Mulai chat...</span>
    </a>
  </div>

  <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#42a895" fill-opacity="1" d="M0,288L80,293.3C160,299,320,309,480,298.7C640,288,800,256,960,229.3C1120,203,1280,181,1360,170.7L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
  </svg> -->

</main>
<?= $this->endSection() ?>