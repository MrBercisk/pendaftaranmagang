<?= $this->extend('layouts_peserta/template_peserta') ?>

<?= $this->section('header') ?>
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
    <img src="<?= base_url('/assets/logo.png'); ?>" width="55px">
    <h1 class="logo mr-auto"><a href="#">E-Magang<span> Diskominfosan</span></a></h1>
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
        <h2>Biodata Peserta</h2>
        <ol>
          <li><b>Biodata</b></li>
          <li>Kategori</li>
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
          <form id="formBiodataPeserta" method="post" role="form" class="php-email-form">
            <input type="hidden" name="idPendaftaran" value="<?= $cekTahapSatu['id']; ?>" />
            <!-- Data Diri Peserta -->
            <label for="tahun">Data Diri Peserta</label>
            <div class="form-group">
              <input type="text" class="form-control" name="nama_peserta" placeholder="Nama Peserta" value="<?= $cekTahapSatu['nama_peserta']; ?>" />
              <small id="nama_peserta_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <select class="form-control" name="nama_kampus">
                <option value="">--Nama Kampus--</option>
                <option value="UBSI" <?php if ($cekTahapSatu['nama_kampus'] == 'UBSI') {
                                        echo "selected";
                                      }  ?>>UBSI</option>
                <option value="UGM" <?php if ($cekTahapSatu['nama_kampus'] == 'UGM') {
                                      echo "selected";
                                    }  ?>>UGM</option>
                <option value="UNY" <?php if ($cekTahapSatu['nama_kampus'] == 'UNY') {
                                      echo "selected";
                                    }  ?>>UNY</option>
                <option value="UMY" <?php if ($cekTahapSatu['nama_kampus'] == 'UMY') {
                                      echo "selected";
                                    }  ?>>UMY</option>
                <option value="UAD" <?php if ($cekTahapSatu['nama_kampus'] == 'UAD') {
                                      echo "selected";
                                    }  ?>>UAD</option>
                <option value="UPN" <?php if ($cekTahapSatu['nama_kampus'] == 'UPN') {
                                      echo "selected";
                                    }  ?>>UPN</option>
                <option value="STPMD" <?php if ($cekTahapSatu['nama_kampus'] == 'STPMD') {
                                        echo "selected";
                                      }  ?>>STPMD</option>
                <option value="AMIKOM" <?php if ($cekTahapSatu['nama_kampus'] == 'AMIKOM') {
                                          echo "selected";
                                        }  ?>>AMIKOM</option>
              </select>
              <small id="nama_kampus_error" class="form-text text-danger mb-3"></small>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="prodi" placeholder="Program Studi" value="<?= $cekTahapSatu['prodi']; ?>" />
              <small id="prodi_error" class="form-text text-danger mb-3"></small>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="judul" placeholder="Judul Project" value="<?= $cekTahapSatu['judul']; ?>" />
              <small id="judul_error" class="form-text text-danger mb-3"></small>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="no_hp" placeholder="No. Handphone" value="<?= $cekTahapSatu['no_hp']; ?>" />
              <small id="no_hp_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="alamat_peserta" rows="5" placeholder="Alamat"><?= $cekTahapSatu['alamat_peserta']; ?></textarea>
              <small id="alamat_peserta_error" class="form-text text-danger mb-3"></small>
            </div>

            <div class="form-group">
              <textarea name="keahlian" class="form-control" id="keahlian" cols="30" rows="5" placeholder="Keahlian Anda" value="<?= $cekTahapSatu['keahlian']; ?>"></textarea>
              <small id="keahlian_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <textarea name="tools" class="form-control" id="tools" cols="30" rows="5" placeholder="Tools Yang Anda Kuasai" value="<?= $cekTahapSatu['tools']; ?>"></textarea>
              <small id="tools_error" class="form-text text-danger mb-3"></small>
            </div>

            <div class="form-group">
              <select class="form-control" name="jenis_permohonan">
                <option value="">--Jenis Permohonan--</option>
                <option value="Riset" <?php if ($cekTahapSatu['jenis_permohonan'] == 'Riset') {
                                        echo "selected";
                                      }  ?>>Riset</option>
                <option value="Kerja Praktek" <?php if ($cekTahapSatu['jenis_permohonan'] == 'Kerja Praktek') {
                                                echo "selected";
                                              }  ?>>Kerja Praktek</option>
              </select>
              <small id="jenis_permohonan_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <select class="form-control" name="status_permohonan">
                <option value="">--Status Permohonan--</option>
                <option value="Individu" <?php if ($cekTahapSatu['status_permohonan'] == 'Individu') {
                                            echo "selected";
                                          }  ?>>Individu</option>
                <option value="Kelompok" <?php if ($cekTahapSatu['status_permohonan'] == 'Kelompok') {
                                            echo "selected";
                                          }  ?>>Kelompok</option>
              </select>
              <small id="status_permohonan_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <label>Tanggal Mulai</label>
              <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" value="<?= $cekTahapSatu['tanggal_mulai']; ?>">
              <small id="tanggal_mulai_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <label>Tanggal Selesai</label>
              <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" value="<?= $cekTahapSatu['tanggal_selesai']; ?>">
              <small id="tanggal_selesai_error" class="form-text text-danger mb-3"></small>
            </div>
            <!-- Tombol Simpan -->
            <div class="mb-2">
              <button class="col-lg-3" type="submit" id="btn-pendaftaran1">Simpan dan Lanjutkan</button>
              <?php if ($cekTahapSatu['tahap_satu'] == "Selesai") : ?>
                <a href="<?php echo base_url('pendaftaran/tahapdua'); ?>" role="button" class="btn btn-light col-lg-3">Lewati</a>
              <?php endif ?>
            </div>
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

    //Date range picker
    $('#reservationdate').datetimepicker({
      format: 'L'
    });

    //Submit pendaftaran tahap satu
    $('#btn-pendaftaran1').on('click', function() {
      const formBiodataPeserta = $('#formBiodataPeserta');

      $.ajax({
        url: "<?php echo base_url('pendaftaran/saveTahapSatu') ?>",
        method: "POST",
        data: formBiodataPeserta.serialize(),
        dataType: "JSON",
        success: function(data) {
          //Data Error
          if (data.error) {
            if (data.tahap_satu_error['nama_peserta'] != '') $('#nama_peserta_error').html(data.tahap_satu_error['nama_peserta']);
            else $('#nama_peserta_error').html('');

            if (data.tahap_satu_error['no_hp'] != '') $('#no_hp_error').html(data.tahap_satu_error['no_hp']);
            else $('#no_hp_error').html('');

            if (data.tahap_satu_error['alamat_peserta'] != '') $('#alamat_peserta_error').html(data.tahap_satu_error['alamat_peserta']);
            else $('#alamat_peserta_error').html('');

            if (data.tahap_satu_error['nama_kampus'] != '') $('#nama_kampus_error').html(data.tahap_satu_error['nama_kampus']);
            else $('#nama_kampus_error').html('');

            if (data.tahap_satu_error['keahlian'] != '') $('#keahlian_error').html(data.tahap_satu_error['keahlian']);
            else $('#keahlian_error').html('');

            if (data.tahap_satu_error['tools'] != '') $('#tools_error').html(data.tahap_satu_error['tools']);
            else $('#tools_error').html('');

            if (data.tahap_satu_error['judul'] != '') $('#judul_error').html(data.tahap_satu_error['judul']);
            else $('#judul_error').html('');

            if (data.tahap_dua_error['jenis_permohonan'] != '') $('#jenis_permohonan_error').html(data.tahap_dua_error['jenis_permohonan']);
            else $('#jenis_permohonan_error').html('');

            if (data.tahap_dua_error['status_permohonan'] != '') $('#status_permohonan_error').html(data.tahap_dua_error['status_permohonan']);
            else $('#status_permohonan_error').html('');

            if (data.tahap_dua_error['tanggal_mulai'] != '') $('#tanggal_mulai_error').html(data.tahap_dua_error['tanggal_mulai']);
            else $('#tanggal_mulai_error').html('');

            if (data.tahap_dua_error['tanggal_selesai'] != '') $('#tanggal_selesai_error').html(data.tahap_dua_error['tanggal_selesai']);
            else $('#tanggal_selesai_error').html('');

          }

          //Pendaftaran tahap satu sukses
          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: 'Tahap satu berhasil!',
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