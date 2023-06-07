<?= $this->extend('layouts_mentor/template_mentor') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')) { ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php } ?>
<?php if (session()->getFlashdata('error')) { ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php if (session()->has('pesan_error')) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses ditolak!',
                text: '<?= session()->getFlashdata('pesan_error') ?>',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
                // matikan styling default tombol Swal
            })
        </script>

    <?php endif; ?>
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
                <div class="col-md-4">

                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style=" color:#fff;"><i class="fas fa-list"></i> Input Nilai Magang</h3>
                        </div>
                        <?= form_open('nilai/add', ['id' => 'formTambahNilai']) ?>
                        <div class="card-body">
                            <input type="hidden" name="pendaftaran_id" />
                            <div class="form-group">
                                <label for="nama_peserta">Nama Peserta</label>
                                <select class="form-control" name="nama_peserta" required>
                                    <option value="">-- Pilih Nama Peserta --</option>
                                    <?php foreach ($laporan as $p) : ?>
                                        <option value="<?= $p['id'] ?>"><?= $p['nama_peserta'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small id="nama_peserta_error" class="text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label for="ketepatan_waktu">Ketepatan Waktu:</label>
                                <input type="number" name="ketepatan_waktu" class="form-control" id="ketepatan_waktu">
                                <small id="ketepatan_waktu_error" class="text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label for="tanggung_jawab">Tanggung Jawab:</label>
                                <input type="number" name="tanggung_jawab" class="form-control" id="tanggung_jawab">
                                <small id="tanggung_jawab_error" class="text-danger"> </small>
                            </div>

                            <div class="form-group">
                                <label for="kehadiran">Kehadiran:</label>
                                <input type="number" name="kehadiran" class="form-control" id="kehadiran">
                                <small id="kehadiran_error" class="text-danger"> </small>
                            </div>

                            <div class="form-group">
                                <label for="kemampuan_kerja">Kemampuan Kerja:</label>
                                <input type="number" name="kemampuan_kerja" class="form-control" id="kemampuan_kerja">
                                <small id="kemampuan_kerja_error" class="text-danger"> </small>
                            </div>

                            <div class="form-group">
                                <label for="kualitas_kerja">Kualitas Kerja:</label>
                                <input type="number" name="kualitas_kerja" class="form-control" id="kualitas_kerja">
                                <small id="kualitas_kerja_error" class="text-danger"> </small>
                            </div>

                            <div class="form-group">
                                <label for="kerjasama">Kerjasama:</label>
                                <input type="number" name="kerjasama" class="form-control" id="kerjasama">
                                <small id="kerjasama_error" class="text-danger"> </small>
                            </div>

                            <div class="form-group">
                                <label for="inisiatif">Inisiatif:</label>
                                <input type="number" name="inisiatif" class="form-control" id="inisiatif">
                                <small id="inisiatif_error" class="text-danger"> </small>
                            </div>

                            <div class="form-group">
                                <label for="rasa_percaya">Rasa Percaya:</label>
                                <input type="number" name="rasa_percaya" class="form-control" id="rasa_percaya">
                                <small id="rasa_percaya_error" class="text-danger"> </small>
                            </div>

                            <div class="form-group">
                                <label for="penampilan">Penampilan:</label>
                                <input type="number" name="penampilan" class="form-control" id="penampilan">
                                <small id="penampilan_error" class="text-danger"> </small>
                            </div>

                            <div class="form-group">
                                <label for="patuh_aturan_pkl">Patuh Aturan PKL:</label>
                                <input type="number" name="patuh_aturan_pkl" class="form-control" id="patuh_aturan_pkl">
                                <small id="patuh_aturan_pkl_error" class="text-danger"> </small>
                            </div>

                            <div class="form-group">
                                <label for="rata_rata">Rata-Rata:</label>
                                <input type="number" name="rata_rata" class="form-control" id="rata_rata" placeholder="Kolom akan terisi otomatis setelah semua nilai diatas terisi" readonly>
                                <small id="rata_rata_error" class="text-danger"> </small>
                            </div>
                            <div class="form-group">
                                <label for="tanda_tangan">Tanda Tangan</label>
                                <div id="signature-pad" class="signature-pad">
                                    <div class="signature-pad--body" style="border: 1px solid #ccc;">
                                        <canvas width="400" height="200"></canvas>
                                    </div>
                                    <div class="signature-pad--footer mt-2">
                                        <div class="signature-pad--actions col-12 d-flex justify-content-end">
                                            <button type="button" id="clear" data-action="clear" class="btn btn-danger">Reset Tanda Tangan</button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="tanda_tangan" id="tanda_tangan">
                                <!-- Tampilkan tanda tangan -->
                                <img src="" id="tanda_tangan_preview" style="display: none;">
                            </div>


                        </div>
                        <?= form_close() ?>
                        <div class="card-footer col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="btn-tambah">Simpan</button>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="color:#ffff;"><i class="fas fa-list"></i> Data Nilai Magang Peserta :</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered bg-white table-hover" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peserta</th>
                                        <th>Nama Kampus</th>
                                        <th>Ketepatan Waktu</th>
                                        <th>Kehadiran</th>
                                        <th>Kemampuan Kerja</th>
                                        <th>Kualitas Kerja</th>
                                        <th>Kerjasama</th>
                                        <th>Inisiatif</th>
                                        <th>Rasa Percaya</th>
                                        <th>Penampilan</th>
                                        <th>Patuh Aturan PKL</th>
                                        <th>Tanggung Jawab</th>
                                        <th>Nilai Rata-rata</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>
    @media (max-width: 992px) {
        .row {
            flex-direction: column-reverse;
        }

    }

    .card-header {
        background-color: #17A2B8;
        color: #fff;
        padding: 10px;
    }

    label {
        font-weight: bold;
    }

    .form-group input[type="number"],
    .form-group select {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px;
        width: 100%;
    }

    .form-group input[type="number"]:focus,
    .form-group select:focus {
        border: 2px solid #17A2B8;
        outline: none;
    }

    small.text-danger {
        display: none;
    }

    #signature-pad {
        border: 3px solid #ccc;
        padding: 10px;
        margin-top: 20px;
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
</style>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Load Signature Pad Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
<script>
    $(document).ready(function() {
        function calculateRataRata() {
            const ketepatan_waktu = parseInt(document.getElementById("ketepatan_waktu").value);
            const tanggung_jawab = parseInt(document.getElementById("tanggung_jawab").value);
            const kehadiran = parseInt(document.getElementById("kehadiran").value);
            const kemampuan_kerja = parseInt(document.getElementById("kemampuan_kerja").value);
            const kualitas_kerja = parseInt(document.getElementById("kualitas_kerja").value);
            const kerjasama = parseInt(document.getElementById("kerjasama").value);
            const inisiatif = parseInt(document.getElementById("inisiatif").value);
            const rasa_percaya = parseInt(document.getElementById("rasa_percaya").value);
            const penampilan = parseInt(document.getElementById("penampilan").value);
            const patuh_aturan_pkl = parseInt(document.getElementById("patuh_aturan_pkl").value);

            const sum = ketepatan_waktu + tanggung_jawab + kehadiran + kemampuan_kerja + kualitas_kerja +
                kerjasama + inisiatif + rasa_percaya + penampilan + patuh_aturan_pkl;

            const rata_rata = sum / 10;

            document.getElementById("rata_rata").value = rata_rata.toFixed(2);
            document.getElementById("rata_rata").readOnly = true;
        }

        // Call the calculateRataRata function whenever a numerical field changes
        document.querySelectorAll("input[type=number]").forEach(input => {
            input.addEventListener("input", calculateRataRata);
        });
        var canvas = document.querySelector("canvas");
        var signaturePad = new SignaturePad(canvas);
        var hiddenInput = document.querySelector("#tanda_tangan");

        // Clear signature pada signature pad
        document.getElementById('clear').addEventListener('click', function() {
            signaturePad.clear();
             // Kosongkan tanda tangan yang ditampilkan
        document.getElementById('tanda_tangan_preview').style.display = 'none';
        document.getElementById('tanda_tangan_preview').src = '';
        });

        // Simpan tanda tangan ke input hidden saat tombol Simpan ditekan
        document.getElementById('btn-tambah').addEventListener('click', function() {
            var canvas = document.querySelector('canvas');
            var signatureData = signaturePad.toDataURL();
            document.getElementById('tanda_tangan').value = signatureData;
            // Tampilkan tanda tangan pada elemen <img>
        document.getElementById('tanda_tangan_preview').src = signatureData;
        document.getElementById('tanda_tangan_preview').style.display = 'block';
            // Submit form atau lakukan tindakan lainnya
            document.getElementById('formTambahNilai').submit();
        });

        $('select[name="nama_peserta"]').on('change', function() {
            var pendaftaran_id = $(this).val();
            $('input[name="pendaftaran_id"]').val(pendaftaran_id);
        });
        //Menampilkan data Bidang (dataTable server-side)
        $('#example1').DataTable({
            "responsive": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "nilai/ajaxDataNilai",
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
        //------------------------------------------------------------------

        //Submit p
        $('#btn-tambah').on('click', function() {
            const formTambahNilai = $('#formTambahNilai');

            $.ajax({
                url: "nilai/add",
                method: "POST",
                data: formTambahNilai.serialize(),
                dataType: "JSON",
                success: function(data) {
                    //Data Error
                    if (data.error) {
                        if (data.nama_error['nama_peserta'] != '') $('#nama_peserta_error').html(data.nama_peserta_error['nama_peserta']);
                        else $('#nama_peserta_error').html('');

                    }

                    //Pendaftaran Sukses
                    if (data.success) {
                        formTambahNilai.trigger('reset');
                        Swal.fire({
                            icon: 'success',
                            title: 'Tambah Data Nilai Berhasil',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        window.location.replace(data.link)
                    }
                }
            });
        });

    });
</script>
<?= $this->endSection() ?>