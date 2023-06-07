<?= $this->extend('layouts_peserta/template_peserta') ?>

<?= $this->section('header') ?>
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">

    <img src="<?= base_url('/assets/logo.png'); ?>" width="35px">
    <h1 class="logo mr-auto"><a href="<?php echo base_url('/'); ?>">SI AMANG</a></h1>

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li><a href="<?php echo base_url('pendaftaran/logout'); ?>"><i class='bx bx-log-out'></i> Logout</a></li>
      </ul>
    </nav><!-- .nav-menu -->

  </div>
</header><!-- End Header -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main id="main" data-aos="fade-up">

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Resume Pendaftaran</h2>
        <ol>
          <li><a href="<?php echo base_url('pendaftaran/tahapsatu'); ?>">Biodata</a></li>
          <li><a href="<?php echo base_url('pendaftaran/tahapdua'); ?>">Kategori</a></li>
          <li><a href="<?php echo base_url('pendaftaran/tahaptiga'); ?>">Berkas</a></li>
          <li><b>Resume</b></li>
        </ol>
      </div>

    </div>
  </section>

  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="member">
            <div class="member-img">
              <img src="/file_peserta/<?= $resume['foto']; ?>" class="img-fluid" id="previewImg" alt="">
              <h4 class="text-center"><?= $resume['nama_peserta']; ?></h4>
              <h5 class="text-center"><?= $resume['keahlian']; ?></h5>
            </div>

            <!-- Preview Berkas Pendaftaran -->
            <button type="button" class="btn btn-primary col-lg mt-2" data-toggle="modal" data-target="#exampleModal">
              Preview Berkas Pendaftaran
            </button>
          </div>
        </div>

        <div class="col-lg">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Data Biodata</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="kampus-tab" data-toggle="tab" href="#kampus" role="tab" aria-controls="kampus" aria-selected="false">Data Kampus</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="bagian-tab" data-toggle="tab" href="#bagian" role="tab" aria-controls="bagian" aria-selected="false">Bagian/Kategori</a>
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
                    <td><?= $resume['nama_peserta']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Nomor Induk Mahasiswa</td>
                    <td><?= $resume['nim']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Keahlian</td>
                    <td><?= $resume['keahlian']; ?></td>
                  </tr>
                  <tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Tools Yang Dikuasai</td>
                    <td><?= $resume['tools']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Judul Project</td>
                    <td><?= $resume['judul']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">6</th>
                    <td>Alamat</td>
                    <td><?= $resume['alamat_peserta']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">7</th>
                    <td>No. Handphone</td>
                    <td><?= $resume['no_hp']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="kampus" role="tabpanel" aria-labelledby="kampus-tab">
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
                    <td>Nama Kampus</td>
                    <td><?= $resume['nama_kampus']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Program Studi</td>
                    <td><?= $resume['prodi']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="bagian" role="tabpanel" aria-labelledby="bagian-tab">
              <table class="table table-striped mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Bidang / Kategori</th>
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
                    <td>Nama Mentor</td>
                    <?php foreach ($mentor as $m) : ?>
                      <td><?= $m['nama'] ?></td>
                    <?php endforeach ?>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Jenis Permohonan</td>
                    <td><?= $resume['jenis_permohonan']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Status Permohonan</td>
                    <td><?= $resume['status_permohonan']; ?></td>
                  </tr>
                  <?php if ($resume['status_permohonan'] == 'Kelompok') : ?>
                    <?php if (!empty($resume['nama_anggota_1'])) : ?>
                      <tr>
                        <th scope="row">6</th>
                        <td>Anggota Kelompok 1</td>
                        <td><?= $resume['nama_anggota_1']; ?></td>
                      </tr>
                    <?php endif; ?>
                    <?php if (!empty($resume['nama_anggota_2'])) : ?>
                      <tr>
                        <th scope="row">7</th>
                        <td>Anggota Kelompok 2</td>
                        <td><?= $resume['nama_anggota_2']; ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>

          <form id="formFinalisasi" method="post" role="form" class="php-email-form">
            <input type="hidden" name="idPendaftaran" value="<?= $resume['id']; ?>" />
            <!-- Tombol Simpan -->
            <div class="mt-2">
              <h4 class="notif">Silahkan Cek Data Terlebih Dahulu Untuk Finalisasi Pendaftaran, Ketika Finalisasi Berhasil Maka Data Sudah <b>Tidak Bisa Diubah</b> </h4>
              <button class="col-lg-4" type="submit" id="btn-finalisasi">Finalisasi Pendaftaran</button>
            </div>
          </form>
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
        <h5 class="modal-title" id="exampleModalLabel">Preview Berkas Pendaftaran <?= $resume['nama_peserta']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <embed src="/file_peserta/<?= $resume['berkas']; ?>" type="application/pdf" width="100%" height="450px">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {

    //Submit Finalisasi Pendaftaran
    $('#btn-finalisasi').on('click', function() {
      const formfinalisasi = $('#formFinalisasi');

      $.ajax({
        url: "<?php echo base_url('pendaftaran/finalisasiPendaftaran') ?>",
        method: "POST",
        data: formfinalisasi.serialize(),
        dataType: "JSON",
        success: function(data) {
          //Pendaftaran tahap dua sukses
          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: 'Finalisasi pendaftaran berhasil!',
              showConfirmButton: false,
              timer: 1500
            });
            window.location.replace(data.link);
          }

        }

      });

    });
    //-------------------------------------------------------------------

  });
</script>
<?= $this->endSection() ?>