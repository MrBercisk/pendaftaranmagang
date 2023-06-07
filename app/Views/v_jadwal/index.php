<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php if (session()->getFlashdata('success')) { ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php } ?>
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
        <?php include 'add.php';  ?>
        <!-- Default box -->
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style=" color:#17A2B8;"><i class="fas fa-calendar"></i> Jadwal Peserta Magang</h3>
            </div>
            <div class="card-body">
              <a data-toggle="tooltip" data-placement="top" title="Add">
                <button id="addBankSoal" type="button" class="btn btn-primary mb-3" type="button" data-toggle="modal" data-target="#modalAdd">
                  <i class="fas fa-plus"> Tambah Event</i>
                </button>
              </a>
              <div class="calendar-container">
                <div class="calendar-body">
                  <div id="calendar"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>

<!-- /.content-wrapper -->
<style>
  #calendar {
    max-width: 100%;
    width: 100%;
  }

  .circle-img {
    width: 100px;
    height: 120px;
    object-fit: cover;
  }

  .status-oval {
    display: inline-block;
    border-radius: 9999px;
    padding: 5px 15px;
    text-align: center;
    font-weight: bold;
    font-size: 12px;
    line-height: 1;
  }

  .status-oval .status-text {
    display: block;
    text-transform: uppercase;
  }

  .status-oval.diterima {
    background-color: #5cb85c;
    color: #fff;
  }

  .status-oval.ditolak {
    background-color: #d9534f;
    color: #fff;
  }

  .status-oval.belum-verifikasi {
    background-color: #f0ad4e;
    color: #fff;
  }

  .dataTables_wrapper {
    text-align: justify;
    /* untuk meletakkan teks di tengah */
    font-size: 14px;
    /* ukuran font */
    line-height: 1.5;
    /* jarak antar baris */
    font-family: Arial, Helvetica, sans-serif;
    /* jenis font */
  }

  .calendar-container {
    background-color: #f8f8f8;
    margin: 10px 0;
    padding: 20px;
    border-radius: 5px;
  }

  .calendar-header {
    margin-bottom: 20px;
  }

  .calendar-header h2 {
    font-size: 28px;
    font-weight: bold;
    color: #333;
  }

  .calendar-body {
    overflow: auto;
  }
</style>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    $('select[name="nama_peserta"]').on('change', function() {
      var pendaftaran_id = $(this).val();
      $('input[name="pendaftaran_id"]').val(pendaftaran_id);
    });

    //Menampilkan (dataTable server-side)
    $('#example1').DataTable({
      "responsive": false,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "order": [],

      "ajax": {
        "url": "jadwalPeserta/ajaxDataJadwal",
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

    //Submit jadwal
    $('#btn-tambah').on('click', function() {
      const formTambahJadwal = $('#formTambahJadwal');

      $.ajax({
        url: "jadwalPeserta/add",
        method: "POST",
        data: formTambahJadwal.serialize(),
        dataType: "JSON",
        success: function(data) {
          //Data Error
          if (data.error) {
            if (data.nama_error['nama_peserta'] != '') $('#nama_peserta_error').html(data.nama_peserta_error['nama_peserta']);
            else $('#nama_peserta_error').html('');

          }

          if (data.success) {
            formTambahJadwal.trigger('reset');
            $('#modalAdd').modal('hide');
            $('#nama_peserta_error').html('');
            $('#example1').DataTable().ajax.reload();

            Swal.fire({
              icon: 'success',
              title: 'Tambah Data Jadwal Berhasil',
              showConfirmButton: false,
              timer: 2000
            });
            window.location.replace(data.link);
          }
        }
      });
    });
    //-------------------------------------------------------------------
    //Hapus data
    $('body').on('click', '.btn-deleteJadwal', function(e) {
      e.preventDefault();
      const url = $(this).attr('href');

      Swal.fire({
        title: 'Hapus Data?',
        text: "Anda ingin menghapus data jadwal ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Hapus Data!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: url,
            method: "POST",
            success: function(response) {
              $('#example1').DataTable().ajax.reload()
              toastr.info('Data Mentor berhasil dihapus.');
            }
          });
        }
      });

    });
  });
</script>
<?= $this->endSection() ?>