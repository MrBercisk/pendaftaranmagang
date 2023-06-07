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
            <div class="form-group">
              <label for="nama_peserta">Nama Lengkap Peserta<span style="color:red"> *</span></label>
              <input type="text" class="form-control" name="nama_peserta" placeholder="Nama Lengkap Peserta" value="<?= $cekTahapSatu['nama_peserta']; ?>" />
              <small id="nama_peserta_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
            <label for="nim">Nomor Induk Mahasiswa<span style="color:red"> *</span></label>
              <input type="text" class="form-control" name="nim" placeholder="Nomor Induk Mahasiswa" value="<?= $cekTahapSatu['nim']; ?>" />
              <small id="nim_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
            <label for="nama_kampus">Nama Kampus<span style="color:red"> *</span></label>
              <select class="form-control" name="nama_kampus">
                <?php foreach ($nama_kampus as $a) : ?>
                  <option value="<?= $a['nama_kampus']; ?>" <?= $a['nama_kampus'] == $cekTahapSatu['nama_kampus'] ? 'selected' : '' ?>>
                    <?= $a['nama_kampus']; ?>
                  </option>
                <?php endforeach; ?>

              </select>
              <small id="nama_kampus_error" class="form-text text-danger mb-3"></small>
            </div>

            <div class="form-group">
              <label for="prodi">Program Studi<span style="color:red"> *</span></label>
              <input type="text" class="form-control" name="prodi" placeholder="Program Studi" value="<?= $cekTahapSatu['prodi']; ?>" />
              <small id="prodi_error" class="form-text text-danger mb-3"></small>
            </div>

            <div class="form-group">
            <label for="judul">Judul Project<span style="color:red"> *</span></label>
              <input type="text" class="form-control" name="judul" placeholder="Judul Project Yang Ingin Diajukan" value="<?= $cekTahapSatu['judul']; ?>" />
              <small id="judul_error" class="form-text text-danger mb-3"></small>
            </div>

            <div class="form-group">
            <label for="no_hp">No. Handphone<span style="color:red"> *</span></label>
              <input type="text" class="form-control" name="no_hp" placeholder="No. Handphone Anda" value="<?= $cekTahapSatu['no_hp']; ?>" />
              <small id="no_hp_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
            <label for="alamat_peserta">Alamat Anda<span style="color:red"> *</span></label>
              <textarea class="form-control" name="alamat_peserta" rows="5" placeholder="Alamat Anda"><?= $cekTahapSatu['alamat_peserta']; ?></textarea>
              <small id="alamat_peserta_error" class="form-text text-danger mb-3"></small>
            </div>

            <div class="form-group">
            <label for="keahlian">Keahlian Anda<span style="color:red"> *</span></label>
              <textarea name="keahlian" class="form-control" id="keahlian" cols="30" rows="5" placeholder="Keahlian Anda (Front End Web, Data Analyst, UI UX Designer,dll)" value="<?= $cekTahapSatu['keahlian']; ?>"></textarea>
              <small id="keahlian_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
            <label for="tools">Tools Yang Anda Kuasai<span style="color:red"> *</span></label>
              <textarea name="tools" class="form-control" id="tools" cols="30" rows="5" placeholder="Tools Yang Anda Kuasai (Codeigniter, Laravel, Figma, dll)" value="<?= $cekTahapSatu['tools']; ?>"></textarea>
              <small id="tools_error" class="form-text text-danger mb-3"></small>
            </div>

            <div class="form-group">
            <label for="jenis_permohonan">Jenis Permohonan<span style="color:red"> *</span></label>
              <select class="form-control" name="jenis_permohonan">
                <option value="">--Jenis Permohonan--</option>
                <option value="Riset" <?php if ($cekTahapSatu['jenis_permohonan'] == 'Riset') {
                                        echo "selected";
                                      } ?>>Riset</option>
                <option value="Kerja Praktek" <?php if ($cekTahapSatu['jenis_permohonan'] == 'Kerja Praktek') {
                                                echo "selected";
                                              } ?>>Kerja Praktek</option>
              </select>
              <small id="jenis_permohonan_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
            <label for="status_permohonan">Status Permohonan<span style="color:red"> *</span></label>
              <select class="form-control" name="status_permohonan" id="status_permohonan">
                <option value="">--Status Permohonan--</option>
                <option value="Individu" <?php if ($cekTahapSatu['status_permohonan'] == 'Individu') {
                                            echo "selected";
                                          } ?>>Individu</option>
                <option value="Kelompok" <?php if ($cekTahapSatu['status_permohonan'] == 'Kelompok') {
                                            echo "selected";
                                          } ?>>Kelompok</option>
              </select>
              <p class="text-danger mt-2">**Maksimal 3 Anggota jika memilih kelompok</p>
              <small id="status_permohonan_error" class="form-text text-danger mb-3"></small>
            </div>

            <div id="form-nama-anggota-1" class="form-group d-none">
              <label for="nama_anggota_1">Nama Anggota 1</label>
              <input type="text" class="form-control" name="nama_anggota_1" required>
              <small id="nama_anggota_1_error" class="form-text text-danger mb-3"></small>
            </div>

            <div id="form-nama-anggota-2" class="form-group d-none">
              <label for="nama_anggota_2">Nama Anggota 2</label>
              <input type="text" class="form-control" name="nama_anggota_2">
              <small id="nama_anggota_2_error" class="form-text text-danger mb-3"></small>
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
    $("#status_permohonan").change(function() {
      if ($(this).val() == "Kelompok") {
        $("#form-nama-anggota-1").removeClass("d-none");
        $("#form-nama-anggota-2").removeClass("d-none");
      } else {
        $("#form-nama-anggota-1").addClass("d-none");
        $("#form-nama-anggota-2").addClass("d-none");
      }
    });
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

            if (data.tahap_satu_error['nim'] != '') $('#nim_error').html(data.tahap_satu_error['nim']);
            else $('#nim_error').html('');

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