<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="http://localhost/diskominfosan/public/assets/logo.png">

    <!-- Vendor CSS Files -->
    <link href="/assets/bizland/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/bizland/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="/assets/bizland/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/bizland/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/assets/bizland/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="/assets/bizland/vendor/aos/aos.css" rel="stylesheet">
    <!-- daterange picker -->
    <link rel="stylesheet" href="/assets/adminlte3/plugins/daterangepicker/daterangepicker.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="/assets/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Template Main CSS File -->
    <link href="/assets/bizland/css/style.css" rel="stylesheet">
    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


    <!-- WEBCAM -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js">
    <!-- =======================================================
  * Template Name: BizLand - v1.1.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <main id="main">

        <section class="breadcrumbs m-0">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center ">
                    <h2>Lupa Password</h2>
                    <ol>
                        <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('/login'); ?>">Login</a></li>
                        <li>Lupa Password</li>
                    </ol>
                </div>

            </div>
        </section>

        <!-- ======= Login ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <!-- Tambahkan class "animate__animated" dan class animasi lainnya ke elemen yang ingin dianimasikan -->
                <div class="section-title animate__animated animate__fadeInUp">
                    <h3><span>Halaman Lupa Password</span></h3>
                    <p>Aplikasi Pendaftaran Magang Mahasiswa - DISKOMINFOSAN</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
                    <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_xvrofzfk.json"  background="transparent" speed="1" style="width: 600px; height: 500px;" loop autoplay></lottie-player>
                    </div>

                    <div class="col-lg-6 animate__animated animate__fadeInRight">
                        <div class="card-body">
                            <p>Keterangan : Kami Akan Mengirim Link Reset Password Ke Email Kamu,Cek Spam Atau Inbox Email Anda Setelah Mengisi Email Yang Terdaftar</p>
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
                            <form action="<?= base_url('AuthController/forgotPassword') ?>" method="POST">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Masukan Alamat Email Akun Anda" value="<?= old('email') ?>">
                                    <?php if (isset($validation) && $validation->hasError('email')) { ?>
                                        <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
                                    <?php } ?>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
    <!-- Vendor JS Files -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="/assets/bizland/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/bizland/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/bizland/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="/assets/bizland/vendor/php-email-form/validate.js"></script>
    <script src="/assets/bizland/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="/assets/bizland/vendor/counterup/counterup.min.js"></script>
    <script src="/assets/bizland/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="/assets/bizland/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/assets/bizland/vendor/venobox/venobox.min.js"></script>
    <script src="/assets/bizland/vendor/aos/aos.js"></script>
    <!-- Sweetalert 2 -->
    <script src="/assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="/assets/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- InputMask -->
    <script src="/assets/adminlte3/plugins/moment/moment.min.js"></script>
    <script src="/assets/adminlte3/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="/assets/adminlte3/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/assets/adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Template Main JS File -->
    <script src="/assets/bizland/js/main.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>

    <script>
        $(document).ready(function() {

            //Show Password
            $('#show-password').on('click', function() {
                if ($(this).hasClass('icofont-eye-blocked')) {
                    $('#password').attr('type', 'text');
                    $(this).removeClass('icofont-eye-blocked');
                    $(this).addClass('icofont-eye');
                } else {
                    $('#password').attr('type', 'password');
                    $(this).removeClass('icofont-eye');
                    $(this).addClass('icofont-eye-blocked');
                }
            });
            //-------------------------------------------------------------------

            //Submit pendaftaran user
            $('#btn-login').on('click', function() {
                const formLogin = $('#formLogin');

                $.ajax({

                    url: "login/cekUser",
                    method: "POST",
                    data: formLogin.serialize(),
                    dataType: "JSON",
                    success: function(data) {

                        //Login Error
                        if (data.error) {

                            if (data.login_error['email'] != '') $('#email_error').html(data.login_error['email']);
                            else $('#email_error').html('');

                            if (data.login_error['password'] != '') $('#password_error').html(data.login_error['password']);
                            else $('#password_error').html('');
                        }

                        //Login Succes
                        if (data.success) {
                            formLogin.trigger('reset');
                            $('#email_error').html('');
                            $('#password_error').html('');

                            Swal.fire({
                                icon: 'success',
                                title: 'Login Berhasil',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.location.replace(data.link);
                        }

                    }

                });

            });
            //-------------------------------------------------------------------

        });
    </script>

</body>

</html>