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
        <h2>Upload Berkas Pendaftaran</h2>
        <ol>
          <li><a href="<?php echo base_url('pendaftaran/tahapsatu'); ?>">Biodata</a></li>
          <li><a href="<?php echo base_url('pendaftaran/tahapdua'); ?>">Kategori</a></li>
          <li><b>Berkas</b></li>
          <li>Resume</li>
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
              <img src="<?= $lokasi_foto; ?>" class="img-fluid" id="previewImg" alt="">
            </div>
          </div>
        </div>

        <div class="col-lg">
          <form id="formUploadBerkas" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
            <input type="hidden" name="idPendaftaran" value="<?= $idPendaftaran; ?>" />
            <label for="tahun" class="mt-3">NDA(Non Disclosure Agreement) Yang Telah Terisi Dengan Biodata Mahasiswa</label>
            <div class="custom-file mb-3">
              <a href="<?php echo base_url('pendaftaran/nda_login'); ?>" type="button" class="btn btn-primary col-lg-4 mt-2 " type="submit" id="btn-cetakKartu" target="_blank">Cetak NDA Mahasiswa</a>
            </div>
            <!-- Upload Berkas Pendaftaran -->
            <label for="tahun">Pas photo 3 x 4 (Ukuran Max. 500Kb Dengan Format .jpg)<span style="color:red"> *</span></label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewFile(this);">
              <small id="foto_error" class="form-text text-danger mb-3"></small>
              <label class="custom-file-label" for="foto"><?= $foto_peserta; ?></label>
            </div>
            <!-- Live webcam untuk take foto live -->
            <!--    <label for="tahun">Ambil Gambar (Webcam) </label>
            <div class="custom-file">
              <div id="my_camera">

              </div>
              <p>
                <button type="button" class="btn btn-sm btn-info" onclick="take_picture()">Ambil Gambar</button>
              </p>
            </div>
            <div class="custom-file">
              <label for="" class="col-sm-2 col-form-label">Capture</label>
              <div class="col-sm-6" id="results"></div>
              <input type="hidden" name="foto" id="foto" class="image-tag">
            </div> -->
            <!-- End live webcam -->

            <label for="tahun" class="mt-3">Berkas syarat pendaftaran dalam 1 file (Ukuran Max. 2Mb Dengan Format .pdf)<span style="color:red"> *</span></label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="berkas" name="berkas">
              <small id="berkas_error" class="form-text text-danger mb-3"></small>
              <label class="custom-file-label" for="berkas"><?= $berkas_peserta; ?></label>
            </div>
            <label for="tahun" class="mt-3">Surat NDA Perjanjian Magang Mahasiswa(Yang sudah ditanda tangan peserta)<span style="color:red"> *</span></label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="nda" name="nda">
              <small id="nda_error" class="form-text text-danger mb-3"></small>
              <label class="custom-file-label" for="nda"><?= $nda; ?></label>
            </div>
            <label for="tahun" class="mt-3">Surat Permohonan (Ukuran Max. 1Mb Dengan Format .pdf)<span style="color:red"> *</span></label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="surat_permohonan" name="surat_permohonan">
              <small id="surat_permohonan_error" class="form-text text-danger mb-3"></small>
              <label class="custom-file-label" for="surat_permohonan"><?= $surat_permohonan; ?></label>
            </div>
            <label for="tahun" class="mt-3">Video Perkenalan (Ukuran Max. 20Mb Dengan Format .mp4)<span style="color:red"> *</span></label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="video_perkenalan" name="video_perkenalan">
              <small id="video_perkenalan_error" class="form-text text-danger mb-3"></small>
              <label class="custom-file-label" for="video_perkenalan"><?= $video_perkenalan; ?></label>
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-2">
              <button class="col-lg-4" type="submit" id="btn-pendaftaran3">Simpan dan Lanjutkan</button>
              <?php if ($tahap_tiga == "Selesai") : ?>
                <a href="<?php echo base_url('pendaftaran/tahapempat'); ?>" role="button" class="btn btn-light col-lg-3">Lewati</a>
              <?php endif ?>
            </div>
          </form>
        </div>

      </div>

    </div>
  </section>

</main>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $('#register').on('submit', function(event) {
    event.preventDefault();
    var image = '';
    var username = $('#username').val();
    var email = $('#email').val();
    var password = $('#password').val();
    Webcam.snap(function(data_uri) {
      image = data_uri;
    });
    $.ajax({
        url: '<?php echo site_url("capture/save"); ?>',
        type: 'POST',
        dataType: 'json',
        data: {
          username: username,
          email: email,
          password: password,
          image: image
        },
      })
      .done(function(data) {
        if (data > 0) {
          alert('insert data sukses');
          $('#register')[0].reset();
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });


  });
  //Preview pas photo yang di upload peserta
  function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function() {
        $("#previewImg").attr("src", reader.result);
      }
      reader.readAsDataURL(file);
    }
  }
  //-------------------------------------------------------------------

  $(document).ready(function() {

    bsCustomFileInput.init();

    //Submit pendaftaran tahap tiga
    $('#formUploadBerkas').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        url: "<?php echo base_url('pendaftaran/saveTahapTiga') ?>",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "JSON",
        success: function(res) {
          //Data error 
          if (res.error) {
            if (res.tahap_tiga_error['foto'] != '') $('#foto_error').html(res.tahap_tiga_error['foto']);
            else $('#foto_error').html('');

            if (res.tahap_tiga_error['berkas'] != '') $('#berkas_error').html(res.tahap_tiga_error['berkas']);
            else $('#berkas_error').html('');

            if (res.tahap_tiga_error['surat_permohonan'] != '') $('#surat_permohonan_error').html(res.tahap_tiga_error['surat_permohonan']);
            else $('#surat_permohonan_error').html('');

            if (res.tahap_tiga_error['video_perkenalan'] != '') $('#video_perkenalan_error').html(res.tahap_tiga_error['video_perkenalan']);
            else $('#video_perkenalan_error').html('');
          }

          //Pendaftaran tahap tiga sukses
          if (res.success) {
            Swal.fire({
              icon: 'success',
              title: 'Tahap tiga berhasil!',
              showConfirmButton: false,
              timer: 1500
            });
            window.location.replace(res.link);
          }

        }

      });

    });
    //-------------------------------------------------------------------



  });
</script>

<!-- <script>
  Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 100
  });
  Webcam.attach('#my_camera');


</script> -->
<?= $this->endSection() ?>