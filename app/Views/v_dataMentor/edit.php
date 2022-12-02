<div class="modal fade" id="modalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Data Mentor <?=$nama_bidang; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdateDataMentor">
        <input type="hidden" name="idMentor">
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_mentor">Nama Mentor</label>
            <input type="text" class="form-control" name="nama_mentor2" placeholder="Nama Mentor">
            <small id="nama_mentor2_error" class="text-danger"> </small>
          </div>
        </div>
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn-updateDataMentor"class="btn btn-primary">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>