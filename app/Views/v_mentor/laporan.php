<?= $this->extend('layouts_mentor/template_mentor') ?>

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
              <h3 class="card-title" style=" color:#17A2B8;"><i class="fas fa-list"></i> Tabel Data Laporan Magang</h3>

            </div>
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #17A2B8; color:#fff;">
                  <tr>
                    <th>No.</th>
                    <th>Nama Peserta</th>
                    <th>Status Permohonan</th>
                    <th>Jenis Permohonan</th>
                    <th>Judul Laporan</th>
                    <th>Link Project</th>
                    <th>Form Nilai(Belum Dinilai)</th>
                    <th>Upload Form Nilai(Telah Dinilai)</th>
                    <th>Surat Selesai Magang</th>
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

</div>
<div class="modal fade" id="modalUploadNilai" tabindex="-1" role="dialog" aria-labelledby="modalUploadNilaiLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUploadNilaiLabel">Upload Form Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUploadNilai" action="<?= base_url('DataLaporan/uploadFormNilai') ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" id="laporan_id" name="laporan_id" value="">
          <div class="form-group">
            <label for="form_nilai">Form Nilai</label>
            <input type="file" class="form-control-file" id="form_nilai" name="form_nilai">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="formUploadNilai" class="btn btn-primary">Upload</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalUploadSurat" tabindex="-1" role="dialog" aria-labelledby="modalUploadSuratLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUploadSuratLabel">Upload Form Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUploadSurat" action="<?= base_url('DataLaporan/uploadFormSurat') ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" id="laporan_id" name="laporan_id" value="">
          <div class="form-group">
            <label for="surat_selesai_magang">Surat Selesai Magang</label>
            <input type="file" class="form-control-file" id="surat_selesai_magang" name="surat_selesai_magang">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="formUploadSurat" class="btn btn-primary">Upload</button>
      </div>
    </div>
  </div>
</div>
<style>
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
</style>

<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {

    //Menampilkan data Laporan (dataTable server-side)
    $('#example1').DataTable({
      "responsive": false,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "order": [],

      "ajax": {
        "url": "mentorlaporan/ajaxDataLaporan",
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

    // Sweet Alert 2
    <?php if (session('swal_success')) : ?>
      Swal.fire({
        icon: 'success',
        title: '<?= session('swal_success'); ?>',
        showConfirmButton: false,
        timer: 1500
      });
    <?php endif; ?>

    <?php if (session('swal_error')) : ?>
      Swal.fire({
        icon: 'error',
        title: '<?= session('swal_error'); ?>',
        showConfirmButton: false,
        timer: 1500
      });
    <?php endif; ?>
  });
</script>
<?= $this->endSection() ?>