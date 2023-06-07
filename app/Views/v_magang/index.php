<?= $this->extend('layouts_magang/template_magang') ?>

<?= $this->section('content') ?>
<?php if (session()->has('pesan_error')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Akses ditolak!',
            text: '<?= session()->getFlashdata('pesan_error') ?>',
            footer: '<a href="<?= base_url('kalender'); ?>">Klik disini untuk cek jadwal magang Anda</a>',
            customClass: {
                confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
            // matikan styling default tombol Swal
        })
    </script>
<?php endif; ?>


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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <!-- small box -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row mt-5">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card card-outline">
                                            <div class="card-body box-profile">
                                                <h5>Informasi Profil</h5>
                                                <p>Perbarui informasi profil dan alamat email akun Anda</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="p-5">
                                                <div class="card animate__animated animate__fadeInUp">
                                                    <div class="card-header bg-primary text-white">
                                                        <h4 class="mb-0 text-center align-items-center"> Periode Magang Anda</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="text-container text-center">

                                                            <?php
                                                            $tanggal_mulai = date_create($tanggal_mulai);
                                                            $tanggal_selesai = date_create($tanggal_selesai);
                                                            $now = date_create();
                                                            // Hitung selisih waktu dari tanggal mulai dan tanggal sekarang
                                                            $diff_mulai_sekarang = date_diff($tanggal_mulai, $now);
                                                            $diff_selesai_sekarang = date_diff($tanggal_selesai, $now);

                                                            if ($now > $tanggal_selesai) {
                                                                echo "<h4 class='m-0'>Periode Magang Telah Berakhir</h4>";
                                                            } else if ($now >= $tanggal_mulai) {
                                                                // Hitung sisa waktu magang dalam hari
                                                                $diff_sisa_waktu = date_diff($now, $tanggal_selesai);
                                                                $sisa_hari = $diff_sisa_waktu->days;

                                                                // Hitung sisa pertemuan
                                                                $sisa_pertemuan = floor($sisa_hari / 14);

                                                                echo "<div class='countdown-container'>
                                                            <div class='countdown-item days'>
                                                            <div class='label'>Hari</div>
                                                            <div class='number'>$sisa_hari</div>
                                                            </div>
                                                            <div class='countdown-item hours'>
                                                            <div class='label'>Jam</div>
                                                            <div class='number'>0</div>
                                                            </div>
                                                            <div class='countdown-item minutes'>
                                                            <div class='label'>Menit</div>
                                                            <div class='number'>0</div>
                                                            </div>
                                                            <div class='countdown-item seconds'>
                                                            <div class='label'>Detik</div>
                                                            <div class='number'>0</div>
                                                            </div></div>";
                                                                echo "<h5 class='mt-2 text-muted'><i class='bx bxs-info-circle'></i> Sisa Pertemuan: $sisa_pertemuan Kali (Setiap 2 Minggu Sekali)</h5>";
                                                            } else {
                                                                echo "<h4 class='m-0'>Periode magang belum dimulai</h4>";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>

                                                </div>


                                                <style>
                                                    .countdown-container {
                                                        display: flex;
                                                        justify-content: center;
                                                        align-items: center;
                                                        gap: 20px;
                                                    }

                                                    .countdown-item {
                                                        display: flex;
                                                        flex-direction: column;
                                                        justify-content: center;
                                                        align-items: center;
                                                        gap: 5px;
                                                        font-size: 24px;
                                                        color: #fff;
                                                        background-color: #333;
                                                        border-radius: 10px;
                                                        width: 100px;
                                                        height: 100px;
                                                    }

                                                    .countdown-item .number {
                                                        font-size: 36px;
                                                    }

                                                    .countdown-item .label {
                                                        font-size: 14px;
                                                    }

                                                    .countdown-item.seconds {
                                                        background-color: #f44336;
                                                    }
                                                </style>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js" integrity="sha512-5kvlWpBwI5f5R5iKCT/QnsfdGHg7aFYZBaHslp7iytjz8zeNu2wElaMnZgmL0vCcP8FDrCTH+D1bX0gZolK8zw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.css" integrity="sha512-4bKLyaLkR9Y6FvU6SxU3JdD6zCZ+7TWHMwxTClF2KjJdX9V7av+eqxZuV7ZsGcZsM/JJmb4p4M4yNO+EpxR+dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


                                                <script>
                                                    function countdown() {
                                                        var now = new Date().getTime();
                                                        var deadline = new Date("<?php echo $tanggal_selesai->format('Y-m-d H:i:s'); ?>").getTime();
                                                        var diff = deadline - now;
                                                        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                                                        var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                                                        var seconds = Math.floor((diff % (1000 * 60)) / 1000);

                                                        // Update Countdown UI
                                                        document.querySelector('.countdown-item.days .number').innerHTML = days;
                                                        document.querySelector('.countdown-item.hours .number').innerHTML = hours;
                                                        document.querySelector('.countdown-item.minutes .number').innerHTML = minutes;
                                                        document.querySelector('.countdown-item.seconds .number').innerHTML = seconds;
                                                        if (diff < 0) {
                                                            clearInterval(x);
                                                            document.getElementById("countdown").innerHTML = "Waktu pengumpulan laporan telah berakhir";
                                                        }
                                                    }
                                                    countdown();
                                                    var x = setInterval(countdown, 1000);
                                                </script>


                                                <style>
                                                    .icon-container {

                                                        border-radius: 50%;
                                                        width: 50px;
                                                        height: 50px;
                                                        display: flex;
                                                        justify-content: center;
                                                        align-items: center;
                                                        font-size: 1.5rem;
                                                    }

                                                    .text-container p {
                                                        font-size: 1rem;
                                                        font-weight: bold;
                                                    }
                                                </style>

                                                <div class="text-center">
                                                    <img class="profile-user-img fotoo img-fluid img-circle" src="<?php echo base_url('file_peserta/' . $foto); ?>" alt="User profile picture" style="max-width: 128px; max-height: 128px;">
                                                </div>
                                                <h3 class="profile-username text-center"></h3>
                                                <p class="text-muted text-center"><?= $keahlian ?></p>

                                                <!-- views/profile/update_photo.php -->
                                                <form class="text-center mb-5" method="POST" action="<?= base_url('updateprofile/update') ?>" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <input type="file" class="" id="foto" name="foto">
                                                    </div>
                                                    <button type="submit" class="btn tombol btn-primary" id="btn-submit">
                                                        <i class="fas fa-sync-alt"></i> Update Foto
                                                    </button>

                                                </form>

                                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#btn-submit').click(function(event) {
                                                            event.preventDefault();
                                                            Swal.fire({
                                                                title: 'Apakah Anda yakin?',
                                                                text: "Anda akan mengupload foto baru!",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Ya, upload!',
                                                                cancelButtonText: 'Batal'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    $('form').submit();
                                                                }
                                                            })
                                                        });
                                                    });
                                                </script>


                                                <form>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                                                        <input type="text" name="nama_peserta" value="<?php echo $nama_peserta; ?>" class="form-control" id="exampleFormControlInput1" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                                        <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="exampleFormControlInput1" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label">Nomor Induk Mahasiswa</label>
                                                        <input type="text" name="nim" value="<?php echo $nim; ?>" class="form-control" id="exampleFormControlInput1" readonly>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card card-outline">
                                            <div class="card-body box-profile">
                                                <h5>Surat Diterima Magang</h5>
                                                <p>Silahkan Download Surat Diterima Magang Anda</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="p-5">
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Surat Diterima Magang</h5>
                                                            <p class="card-text">Klik tombol di bawah untuk mengunduh</p>
                                                            <a href="<?php echo base_url('updateProfile/buktiPendaftaran'); ?>" class="btn btn-primary"><i class="fa fa-download"></i> Unduh Surat Diterima</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Panduan Penggunaan Aplikasi SIAMANG</h5>
                                                            <p class="card-text">Klik tombol di bawah untuk mengunduh</p>
                                                            <a href="https://drive.google.com/file/d/1CkILAWrxZX3W1lxnxu2ayyr22vwXtOXN/view?usp=sharing" class="btn btn-primary"><i class="fa fa-download"></i> Panduan Penggunaan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-3">
                                    <div class="card card-outline">
                                        <div class="card-body box-profile">
                                            <h5>Update Password</h5>
                                            <p><?= $judul; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="p-5">
                                            <form method="POST" action="<?= base_url('updateprofile/updatePassword') ?>">
                                                <div class="form-group">
                                                    <label for="old_password">Password Lama</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" id="toggleOldPassword"><i class="fas fa-eye"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="new_password">Password Baru</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="new_password" name="new_password" minlength="6" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword"><i class="fas fa-eye"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="confirm_password">Konfirmasi Password Baru</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="6" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword"><i class="fas fa-eye"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Update Password</button>
                                            </form>

                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    // toggle password visibility
                                                    $('#toggleOldPassword, #toggleNewPassword, #toggleConfirmPassword').click(function() {
                                                        const passwordField = $(this).closest('.input-group').find('input[type="password"]');
                                                        const passwordFieldType = passwordField.attr('type');
                                                        const newPasswordFieldType = (passwordFieldType === 'password') ? 'text' : 'password';
                                                        passwordField.attr('type', newPasswordFieldType);
                                                        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
                                                    });
                                                });
                                            </script>


                                            <!-- Sweet Alert 2 -->
                                            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                            <?php if (session()->getFlashdata('success')) : ?>
                                                <script>
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: '<?= session()->getFlashdata('success') ?>',
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    })
                                                </script>
                                            <?php elseif (session()->getFlashdata('error')) : ?>
                                                <script>
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: '<?= session()->getFlashdata('error') ?>',
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    })
                                                </script>
                                            <?php endif; ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?= $this->endSection() ?>