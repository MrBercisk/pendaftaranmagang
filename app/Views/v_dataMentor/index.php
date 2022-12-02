<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Data Mentor <?=$nama_bidang; ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- Modal Add -->
            <?php include 'add.php';  ?>

            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Mentor <?=$nama_bidang; ?></h3>

                <div class="card-tools">
                  <a data-toggle="tooltip" data-placement="top" title="Add">
                    <button id="addBankSoal" type="button" class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#modalAdd">
                      <i class="fas fa-plus"></i>
                    </button>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Mentor</th>
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
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  <?php 
      $link = base_url('datamentor/ajaxDataMentor/'.$id_bidang);
  ?>

  $(document).ready(function() {

    //Menampilkan data Mentor (dataTable server-side)
    $('#example1').DataTable({ 
      "responsive": true,
      "autoWidth": false,
      "processing" : true, 
      "serverSide" : true, 
      "order"    : [], 

      "ajax": {
        "url" : "<?php echo $link; ?>",
        "type"  : "POST"
      },

      "columnDefs" : [
        { 
          "targets" : [ 0 ], 
          "orderable" : false,
        },
      ],
    });
    //-------------------------------------------------------------------

    //Save input data Mentor
    $('#btn-saveDataMentor').on('click', function(){
      const formInput = $('#formInputDataMentor');
      
      $.ajax({
        url: "<?php echo base_url('datamentor/add')?>",
        method: "POST",
        data: formInput.serialize(),
        dataType: "JSON",
        success: function (data) {
          //Data error 
          if(data.error){
            if(data.nama_mentor_error['nama_mentor'] != '') $('#nama_mentor_error').html(data.nama_mentor_error['nama_mentor']); 
            else $('#nama_mentor_error').html('');
          }
         
          //Data bidang berhasil disimpan
          if(data.success){
            formInput.trigger('reset');
            $('#modalAdd').modal('hide');
            $('#nama_mentor_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.success('Data Mentor berhasil disimpan.');
          }
            
        }
        
      });

    });
    //-------------------------------------------------------------------

    //Menampilakan modal edit data Mentor
    $('body').on('click', '.btn-editMentor', function () {
      const idMentor = $(this).attr('value');
      $.ajax({
        url : "<?php echo site_url('datamentor/ajaxUpdate/')?>" + idMentor,
        type: "GET",
        dataType: "JSON", 
        success: function(data)
        {
          $('[name="idMentor"]').val(data.id);
          $('[name="nama_mentor2"]').val(data.nama_mentor);
          $('[name="syarat2"]').val(data.syarat);
          $('[name="tugas2"]').val(data.tugas);
          $('#modalEdit').modal('show');
        }        
      })

    });
    //-------------------------------------------------------------------

    //Save update data Mentor
    $('#btn-updateDataMentor').on('click', function(){
      const formUpdate = $('#formUpdateDataMentor');
      
      $.ajax({
        url: "<?php echo base_url('datamentor/update')?>",
        method: "POST",
        data: formUpdate.serialize(),
        dataType: "JSON",
        success: function (data) {
          //Data error 
          if(data.error){
            if(data.nama_mentor2_error['nama_mentor'] != '') $('#nama_mentor2_error').html(data.nama_mentor2_error['nama_mentor']); 
            else $('#nama_mentor2_error').html('');
          }
          
          //Data mentor berhasil disimpan
          if(data.success){
            formUpdate.trigger('reset');
            $('#modalEdit').modal('hide');
            $('#nama_mentor2_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.info('Data mentor berhasil diupdate.');
          }
            
        }
        
      });

    });
    //-------------------------------------------------------------------

    //Hapus data formasi mentor
    $('body').on('click', '.btn-deleteMentor', function (e) {
      e.preventDefault();
      const url = $(this).attr('href');

      Swal.fire({
        title: 'Hapus Data?',
        text: "Anda ingin menghapus data Mentor ini?",
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
            success: function (response) {
                $('#example1').DataTable().ajax.reload()
                toastr.info('Data Mentor berhasil dihapus.');
            }
          });
        }
      });
      
    });
    //-------------------------------------------------------------------

  });

</script>
<?= $this->endSection() ?>

