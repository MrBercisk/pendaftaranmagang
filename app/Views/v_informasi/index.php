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

          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style=" color:#17A2B8;"><i class="fas fa-list"></i> Tabel Informasi Pendaftaran Magang Mahasiswa</h3>
            </div>
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #17A2B8; color:#fff;">
                  <tr>
                    <th>No.</th>
                    <th>Tanggal Pembukaan Pendaftaran</th>
                    <th>Tanggal Penutupan Pendaftaran</th>
                    <th>Tanggal Pengumuman Lulus Administrasi</th>
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
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {

    //Menampilkan informasi (dataTable server-side)
    $('#example1').DataTable({
      "responsive": false,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "order": [],

      "ajax": {
        "url": "informasi/ajaxInformasi",
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

    //Date range picker
    $('#reservationdate').datetimepicker({
      format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker();

    //Menampilakan modal edit informasi
    $('body').on('click', '.btn-editInformaasi', function() {
      const idInformasi = $(this).attr('value');
      $.ajax({
        url: "informasi/ajaxUpdate/" + idInformasi,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('[name="idInformasi"]').val(data.id);
          $('[name="tgl_pendaftaran"]').val(data.tgl_pendaftaran);
          $('[name="tgl_pengumuman"]').val(data.tgl_pengumuman);
          $('#modalEdit').modal('show');
        }
      })

    });
    //-------------------------------------------------------------------

    //Save update informasi
    $('#btn-saveUpdateInformasi').on('click', function() {
      const formUpdate = $('#formUpdateInformasi');

      $.ajax({
        url: "informasi/update",
        method: "POST",
        data: formUpdate.serialize(),
        dataType: "JSON",
        success: function(data) {
          //Data error 
          if (data.error) {
            if (data.info_error['tgl_pendaftaran'] != '') $('#tgl_pendaftaran_error').html(data.info_error['tgl_pendaftaran']);
            else $('#tgl_pendaftaran_error').html('');

            if (data.info_error['tgl_pengumuman'] != '') $('#tgl_pengumuman_error').html(data.info_error['tgl_pengumuman']);
            else $('#tgl_pengumuman_error').html('');
          }
          //Data fakultas berhasil disimpan
          if (data.success) {
            formUpdate.trigger('reset');
            $('#modalEdit').modal('hide');
            $('#tgl_pendaftaran_error').html('');
            $('#tgl_pengumuman_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.info('Informasi berhasil diupdate.');
          }

        }

      });

    });
    //-------------------------------------------------------------------

  });
</script>
<?= $this->endSection() ?>