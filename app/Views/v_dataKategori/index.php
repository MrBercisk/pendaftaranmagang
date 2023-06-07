<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header bg-white" style="height: 50px; max-height: 100px;">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <p class="text-muted">SI AMANG (Sistem Informasi Aplikasi Magang)</p>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content mt-5">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- Modal Add -->
          <?php include 'add.php';  ?>

          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style=" color:#17A2B8;"><i class="fas fa-list"></i> Tabel Data Kategori <?= $nama_bidang; ?></h3>

              <div class="card-tools">
                <a data-toggle="tooltip" data-placement="top" title="Add">
                  <button id="addBankSoal" type="button" class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#modalAdd">
                    <i class="fas fa-plus">Tambah Data</i>
                  </button>
                </a>
              </div>
            </div>
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #17A2B8; color:#fff;">
                  <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Project yang Tersedia</th>
                    <th>Definisi</th>
                    <th>Fitur yang Dibutuhkan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->

  <!-- Modal Edit -->
  <?php include 'edit.php';  ?>
</div>
<!-- /.content-wrapper -->
<style>
  .dataTables_wrapper {

    font-size: 14px;
    /* ukuran font */
    line-height: 1.5;
    /* jarak antar baris */
    font-family: Arial, Helvetica, sans-serif;
    /* jenis font */
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  <?php
  $link = base_url('datakategori/ajaxDataKategori/' . $id_bidang);
  ?>

  $(document).ready(function() {

    //Menampilkan data Kategori (dataTable server-side)
    $('#example1').DataTable({
      "responsive": false,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "order": [],

      "ajax": {
        "url": "<?php echo $link; ?>",
        "type": "POST"
      },

      "columnDefs": [{
        "targets": [0],
        "orderable": false,
      }, ],
      "language": {
        "lengthMenu": "Tampilkan _MENU_ data per halaman",
        "zeroRecords": "Tidak ditemukan data yang sesuai",
        "info": "_START_ sampai _END_ dari _MAX_ entri",
        "infoEmpty": "Data tidak tersedia",
        "search": "Cari:",
        "paginate": {
          "previous": "Sebelumnya",
          "next": "Selanjutnya"
        }
      }
    });
    //-------------------------------------------------------------------

    //Save input data Kategori
    $('#btn-saveDataKategori').on('click', function() {
      const formInput = $('#formInputDataKategori');

      $.ajax({
        url: "<?php echo base_url('datakategori/add') ?>",
        method: "POST",
        data: formInput.serialize(),
        dataType: "JSON",
        success: function(data) {
          //Data error 
          if (data.error) {
            if (data.nama_kategori_error['nama_kategori'] != '') $('#nama_kategori_error').html(data.nama_kategori_error['nama_kategori']);
            else $('#nama_kategori_error').html('');
          }
          if (data.error) {
            if (data.nama_kategori_error['syarat'] != '') $('#syarat_error').html(data.syarat_error['syarat']);
            else $('#syarat_error').html('');
          }
          if (data.error) {
            if (data.nama_kategori_error['tugas'] != '') $('#tugas_error').html(data.tugas_error['tugas']);
            else $('#tugas_error').html('');
          }
          if (data.error) {
            if (data.fitur_error['fitur'] != '') $('#fitur_error').html(data.fitur_error['fitur']);
            else $('#fitur_error').html('');
          }
          //Data bidang berhasil disimpan
          if (data.success) {
            formInput.trigger('reset');
            $('#modalAdd').modal('hide');
            $('#nama_kategori_error').html('');
            $('#syarat_error').html('');
            $('#tugas_error').html('');
            $('#fitur_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.success('Data kategori berhasil disimpan.');
          }

        }

      });

    });
    //-------------------------------------------------------------------

    //Menampilakan modal edit data kategori
    $('body').on('click', '.btn-editKategori', function() {
      const idKategori = $(this).attr('value');
      $.ajax({
        url: "<?php echo site_url('datakategori/ajaxUpdate/') ?>" + idKategori,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('[name="idKategori"]').val(data.id);
          $('[name="nama_kategori2"]').val(data.nama_kategori);
          $('[name="syarat2"]').val(data.syarat);
          $('[name="tugas2"]').val(data.tugas);
          $('[name="fitur2"]').val(data.fitur);
          $('#modalEdit').modal('show');
        }
      })

    });
    //-------------------------------------------------------------------

    //Save update data Kategori
    $('#btn-updateDataKategori').on('click', function() {
      const formUpdate = $('#formUpdateDataKategori');

      $.ajax({
        url: "<?php echo base_url('datakategori/update') ?>",
        method: "POST",
        data: formUpdate.serialize(),
        dataType: "JSON",
        success: function(data) {
          //Data error 
          if (data.error) {
            if (data.nama_kategori2_error['nama_kategori'] != '') $('#nama_kategori2_error').html(data.nama_kategori2_error['nama_kategori']);
            else $('#nama_kategori2_error').html('');
          }
          if (data.error) {
            if (data.nama_kategori2_error['syarat2'] != '') $('#syarat2_error').html(data.syarat2_error['syarat']);
            else $('#syarat2_error').html('');
          }
          if (data.error) {
            if (data.nama_kategori2_error['tugas2'] != '') $('#tugas2_error').html(data.tugas2_error['tugas']);
            else $('#tugas2_error').html('');
          }
          if (data.error) {
            if (data.fitur2_error['fitur2'] != '') $('#fitur2_error').html(data.fitur2_error['fitur']);
            else $('#fitur2_error').html('');
          }
          //Data kategori berhasil disimpan
          if (data.success) {
            formUpdate.trigger('reset');
            $('#modalEdit').modal('hide');
            $('#nama_kategori2_error').html('');
            $('#syarat2_error').html('');
            $('#tugas2_error').html('');
            $('#fitur2_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.info('Data kategori berhasil diupdate.');
          }

        }

      });

    });
    //-------------------------------------------------------------------

    //Hapus data formasi kategori
    $('body').on('click', '.btn-deleteKategori', function(e) {
      e.preventDefault();
      const url = $(this).attr('href');

      Swal.fire({
        title: 'Hapus Data?',
        text: "Anda ingin menghapus data kategori ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: url,
            method: "POST",
            success: function(response) {
              $('#example1').DataTable().ajax.reload()
              toastr.info('Data kategori berhasil dihapus.');
            }
          });
        }
      });

    });
    //-------------------------------------------------------------------

  });
</script>
<?= $this->endSection() ?>