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
              <h3 class="card-title" style=" color:#17A2B8;"><i class="fas fa-list"></i> Tabel Data Bidang</h3>

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
                    <th>Nama Bidang</th>
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

  <!-- Modal Edit -->
  <?php include 'edit.php';  ?>
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {

    //Menampilkan data Bidang (dataTable server-side)
    $('#example1').DataTable({
      "responsive": false,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "order": [],

      "ajax": {
        "url": "databidang/ajaxDataBidang",
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
            },
            
    });
    //-------------------------------------------------------------------

    //Save input data Bidang
    $('#btn-saveDataBidang').on('click', function() {
      const formInput = $('#formInputDataBidang');

      $.ajax({
        url: "databidang/add",
        method: "POST",
        data: formInput.serialize(),
        dataType: "JSON",
        success: function(data) {
          //Data error 
          if (data.error) {
            if (data.nama_bidang_error['nama_bidang'] != '') $('#nama_bidang_error').html(data.nama_bidang_error['nama_bidang']);
            else $('#nama_bidang_error').html('');
          }
          //Data bidang berhasil disimpan
          if (data.success) {
            formInput.trigger('reset');
            $('#modalAdd').modal('hide');
            $('#nama_bidang_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.success('Data bidang berhasil disimpan.');
          }

        }

      });

    });
    //-------------------------------------------------------------------

    //Menampilakan modal edit data bidang
    $('body').on('click', '.btn-editBidang', function() {
      const idBidang = $(this).attr('value');
      $.ajax({
        url: "databidang/ajaxUpdate/" + idBidang,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('[name="idBidang"]').val(data.id);
          $('[name="nama_bidang2"]').val(data.nama_bidang);
          $('#modalEdit').modal('show');
        }
      })

    });
    //-------------------------------------------------------------------

    //Save update data bidang
    $('#btn-updateDataBidang').on('click', function() {
      const formUpdate = $('#formUpdateDataBidang');

      $.ajax({
        url: "databidang/update",
        method: "POST",
        data: formUpdate.serialize(),
        dataType: "JSON",
        success: function(data) {
          //Data error 
          if (data.error) {
            if (data.nama_bidang_error['nama_bidang'] != '') $('#nama_bidang2_error').html(data.nama_bidang_error['nama_bidang']);
            else $('#nama_bidang2_error').html('');
          }
          //Data bidang berhasil disimpan
          if (data.success) {
            formUpdate.trigger('reset');
            $('#modalEdit').modal('hide');
            $('#nama_bidang2_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.info('Data bidang berhasil diupdate.');
          }

        }

      });

    });
    //-------------------------------------------------------------------

    //Hapus data formasi jabatan
    $('body').on('click', '.btn-deleteBidang', function(e) {
      e.preventDefault();
      const url = $(this).attr('href');

      Swal.fire({
        title: 'Hapus Data?',
        text: "Anda ingin menghapus data bidang ini?",
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
              toastr.info('Data bidang berhasil dihapus.');
            }
          });
        }
      });

    });
    //-------------------------------------------------------------------

  });
</script>
<?= $this->endSection() ?>