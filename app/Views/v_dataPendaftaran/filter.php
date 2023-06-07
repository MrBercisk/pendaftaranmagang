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
        <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('datapendaftaran') ?>">Data Pendaftar</a></li>
                <li class="breadcrumb-item active">Filter Status Verifikasi</li>
            </ol>
        </div>
    </section>

    <!-- Main content -->
    <section class="content mt-5">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style=" color:#17A2B8;"><i class="fas fa-list"></i> Data Pendaftar Magang</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <form method="post" action="<?= base_url('DataPendaftaran/filterData') ?>">
                                <div class="form-row align-items-center mb-3">
                                    <div class="col-auto">
                                        <label class="sr-only" for="status_verifikasi">Status Verifikasi</label>
                                        <select class="form-control" id="status_verifikasi" name="status_verifikasi">
                                            <option value="">-- Status Verifikasi --</option>
                                            <option value="Diterima">Diterima</option>
                                            <option value="Tidak Diterima">Tidak Diterima</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Main content -->
                            <section class="content mt-5">
                                <div class="container-fluid">
                                    <div class="row">
                                        <?php foreach ($results as $row) : ?>
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="card">
                                                    <div class="card-header bg-primary">
                                                        <h5 class="card-title"><i class="fas fa-user me-4"></i> <?= $row['nama_peserta'] ?></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <img src="/file_peserta/<?= $row['foto'] ?>" class="card-img-top" alt="Foto Peserta" style="max-width: 85px;">
                                                            </div>
                                                            <div class="col-8">
                                                                <p class="card-text"><strong>Nomor Pendaftaran:</strong> <?= $row['nomor_pendaftaran'] ?></p>
                                                                <p class="card-text"><strong>Kategori:</strong> <?= $row['nama_kategori'] ?></p>
                                                                <p class="card-text"><strong>Nama Kampus:</strong> <?= $row['nama_kampus'] ?></p>
                                                                <p class="card-text"><strong>Tanggal Pendaftaran:</strong> <?= tgl_indonesia($row['tanggal_pendaftaran']) ?></p>
                                                                <p class="card-text"><strong>Keterangan:</strong> <?= $row['keterangan'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </section>


                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
    </section>
    <!-- /.content -->
</div>

<!-- /.content-wrapper -->
<style>
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
</style>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        /* var table = $('#example1').DataTable({
      "responsive": false,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "order": [],

      "ajax": {
        "url": "<?= base_url('DataPendaftaran/filterData') ?>",
        "type": "POST",
        "data": function(data) {
          data.status_verifikasi = $('#status_verifikasi').val();
        }
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

    $('#filter-form').on('submit', function(e) {
      e.preventDefault();
      table.ajax.reload();
    });
 */

        $('#example1').DataTable({
            "responsive": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "datapendaftaran/ajaxDataPendaftaran",
                "type": "POST",
                "data": function(data) {
                    data.status_verifikasi = $('#status_verifikasi').val();
                }
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
        $('#filter-form').on('submit', function(e) {
            e.preventDefault();
            table.ajax.reload();
        });
        //-------------------------------------------------------------------

        //Diterima magang
        $('body').on('click', '.btn-diterimaPendaftaran', function(e) {
            e.preventDefault();
            const urlDiterima = $(this).attr('href');
            console.log(urlDiterima);

            Swal.fire({
                title: 'Diterima Magang?',
                text: "Apakah peserta memenuhi persyaratan pendaftaran?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Diterima!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: urlDiterima,
                        method: "POST",
                        success: function(response) {
                            console.log(response);
                            // Mengambil data email
                            const user_id = response.user_id;
                            const email = response.email;

                            // Mengirim email
                            $.ajax({
                                url: '/send-email.php',
                                method: 'POST',
                                data: {
                                    email: email,
                                    subject: 'Pendaftaran Diterima',
                                    message: 'Selamat, pendaftaran Anda telah diterima!'
                                },
                                success: function(response) {
                                    console.log('Email berhasil dikirim');
                                }
                            });

                            // Memperbarui data tabel
                            $('#example1').DataTable().ajax.reload();
                            toastr.info('Data pendaftaran berhasil diverifikasi.');

                            // Refresh halaman
                            location.reload();
                        }
                    });
                }
            });
        });



        //-------------------------------------------------------------------
        // tidak diterima
        $('body').on('click', '.btn-tidakDiterimaPendaftaran', function(e) {
            e.preventDefault();
            const urlTidakDiterima = $(this).attr('href');


            Swal.fire({
                title: 'Tidak Diterima Magang?',
                text: "Apakah peserta TIDAK memenuhi persyaratan pendaftaran?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, tidak diterima!',
                input: 'select',
                inputPlaceholder: 'Pilih keterangan/alasan mengapa peserta tidak diterima',
                inputOptions: {
                    'Bidang/Kategori Yang Dipilih Tidak Sesuai Dengan Keahlian': 'Bidang/Kategori Yang Dipilih Tidak Sesuai Dengan Keahlian',
                    'Keahlian/Tools Yang Dikuasai Peserta Belum Memenuhi Syarat': 'Keahlian/Tools Yang Dikuasai Peserta Belum Memenuhi Syarat',
                    'Jurusan Tidak Sesuai': 'Jurusan Tidak Sesuai',
                    'Berkas Peserta Tidak Lengkap': 'Berkas Peserta Tidak Lengkap',
                    'Slot Sudah Terisi/Sudah Penuh': 'Slot Sudah Terisi/Sudah Penuh',
                    'Lainnya': 'Lainnya',
                },
                preConfirm: function(keterangan) {
                    return new Promise(function(resolve) {
                        resolve({
                            keterangan: keterangan
                        })
                    })
                }
            }).then((result) => {
                if (result.value) {
                    const keterangan = result.value.keterangan;
                    if (keterangan == "Lainnya") {
                        Swal.fire({
                            title: 'Keterangan Lainnya',
                            input: 'textarea',
                            inputPlaceholder: 'Masukkan keterangan lainnya disini...',
                            showCancelButton: true,
                            confirmButtonText: 'Submit',
                            preConfirm: function(text) {
                                return new Promise(function(resolve) {
                                    resolve({
                                        keterangan: text
                                    })
                                })
                            }
                        }).then((result) => {
                            if (result.value) {
                                const keteranganLainnya = result.value.keterangan;
                                $.ajax({
                                    url: urlTidakDiterima,
                                    method: "POST",
                                    data: {
                                        keterangan: keteranganLainnya
                                    },
                                    success: function(response) {
                                        $('#example1').DataTable().ajax.reload()
                                        toastr.info('Data pendaftaran berhasil diverifikasi.');
                                    }
                                });
                            }
                        });
                    } else {
                        $.ajax({
                            url: urlTidakDiterima,
                            method: "POST",
                            data: {
                                keterangan: keterangan
                            },
                            success: function(response) {

                                // Mengambil data email
                                const user_id = response.user_id;
                                const email = response.email;

                                // Mengirim email
                                $.ajax({
                                    url: '/send-email.php',
                                    method: 'POST',
                                    data: {
                                        email: email,
                                    },
                                    success: function(response) {
                                        console.log('Email berhasil dikirim');
                                    }
                                });

                                // memperbarui tabel
                                $('#example1').DataTable().ajax.reload()
                                toastr.info('Data pendaftaran berhasil diverifikasi.');
                            }
                        });
                    }
                }
            });
        });


        //-------------------------------------------------------------------


        $(document).ready(function() {
            $('body').on('click', '.btn-kirim-email', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('pendaftaran/kirim_email'); ?>',
                    data: {
                        'id': id
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat mengirim email.');
                    }
                });
            });
        });


    });
</script>
<?= $this->endSection() ?>