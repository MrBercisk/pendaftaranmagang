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
        <h2>Pilih Bidang Dan Kategori</h2>
        <ol>
          <li><a href="<?php echo base_url('pendaftaran/tahapsatu'); ?>">Biodata</a></li>
          <li><b>Kategori</b></li>
          <li>Berkas</li>
          <li>Resume</li>
        </ol>
      </div>

    </div>
  </section>

  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg">
          <form id="formBidangKategori" method="post" role="form" class="php-email-form">
            <input type="hidden" name="idPendaftaran" value="<?= $idPendaftaran; ?>" />
            <!-- Pilih bidang Dan kategori -->
            <label for="tahun">Pilih Bidang Dan Kategori Pada Diskominfosan<span style="color:red"> *</span></label>
            <div class="form-group">
              <select class="form-control" name="bidang" id="bidang">
                <option value="<?= $IdBidang; ?>"><?= $nama_bidang; ?></option>
                <?php foreach ($bidang as $fak) : ?>
                  <option value="<?= $fak['id']; ?>"><?= $fak['nama_bidang']; ?></option>
                <?php endforeach ?>
              </select>
              <small id="bidang_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <select class="form-control" id="kategori" name="kategori">
                <option value="<?= $IdKategori; ?>"><?= $nama_kategori; ?></option>
              </select>
              <small id="kategori_error" class="form-text text-danger mb-3"></small>
            </div>
           
            <!-- Tombol Simpan -->
            <div class="mb-2">
              <button class="col-lg-3" type="submit" id="btn-pendaftaran2">Simpan dan Lanjutkan</button>
              <?php if ($tahap_dua == "Selesai") : ?>
                <a href="<?php echo base_url('pendaftaran/tahaptiga'); ?>" role="button" class="btn btn-light col-lg-3">Lewati</a>
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
  $(document).ready(function() {
    $('#mentor-group').hide();
    //Menampilkan Pilihan kategori Berdasarkan bidang
    $('#bidang').on('change', function() {
      const id = $(this).val();

      $.ajax({
        url: "<?php echo base_url('pendaftaran/ajaxPilihanKategori') ?>",
        method: "POST",
        data: {
          id: id
        },
        async: true,
        dataType: "JSON",
        success: function(data) {
          var html = '';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value=' + data[i].id + '>' + data[i].nama_kategori + '</option>';
          }
          $('#kategori').html(html);
        }

      });


    });
    //-------------------------------------------------------------------

    //Submit pendaftaran tahap dua
    $('#btn-pendaftaran2').on('click', function() {
      const formBidangKategori = $('#formBidangKategori');

      $.ajax({
        url: "<?php echo base_url('pendaftaran/saveTahapDua') ?>",
        method: "POST",
        data: formBidangKategori.serialize(),
        dataType: "JSON",
        success: function(data) {
          //Data error 
          if (data.error) {
            if (data.tahap_dua_error['bidang_id'] != '') $('#bidang_error').html(data.tahap_dua_error['bidang_id']);
            else $('#bidang_error').html('');

            if (data.tahap_dua_error['kategori_id'] != '') $('#kategori_error').html(data.tahap_dua_error['kategori_id']);
            else $('#kategori_error').html('');


          }
          //Pendaftaran tahap dua sukses
          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: 'Tahap dua berhasil!',
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