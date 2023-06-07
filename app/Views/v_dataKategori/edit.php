<div class="modal fade" id="modalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Data Kategori <?=$nama_bidang; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdateDataKategori">
        <input type="hidden" name="idKategori">
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" class="form-control" name="nama_kategori2" placeholder="Nama Kategori">
            <small id="nama_kategori2_error" class="text-danger"> </small>
          </div>
          <div class="form-group">
            <label for="syarat">Project yang Tersedia</label>
            <input type="text" class="form-control" name="syarat2" placeholder="Project yang Tersedia">
            <small id="syarat2_error" class="text-danger"> </small>
          </div>
          <div class="form-group">
            <label for="tugas">Definisi</label>
            <input type="text" class="form-control" name="tugas2" placeholder="Definisi">
            <small id="tugas2_error" class="text-danger"> </small>
          </div>
          <div class="form-group">
            <label for="fitur">Fitur yang Dibutuhkan</label>
            <input type="text" class="form-control" name="fitur2" placeholder="Fitur yang Dibutuhkan">
            <small id="fitur2_error" class="text-danger"> </small>
          </div>
        </div>
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn-updateDataKategori"class="btn btn-primary">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>