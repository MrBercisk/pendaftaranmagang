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
          <h2>Login</h2>
          <ol>
            <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
            <li>Login</li>
          </ol>
        </div>

      </div>
    </section>

    <!-- ======= Login ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><span>Halaman Login</span></h2>
          <p class="text-muted">Aplikasi Pendaftaran Magang Mahasiswa - DISKOMINFOSAN</p>
        </div>

        <div class="row">

          <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_jcikwtux.json" background="transparent" speed="1" style="width: 400px; height: 400px;" loop autoplay></lottie-player>
          </div>

          <div class="col-lg-6">
            <?php if (session()->getFlashdata('success')) { ?>
              <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
              </div>
            <?php } ?>
            <form id="formLogin" role="form" class="php-email-form">

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="icofont-email"></i></span>
                  </div>
                  <input type="email" class="form-control" name="email" placeholder="Email" />
                </div>
                <small id="email_error" class="form-text text-danger mb-3"></small>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i id="show-password" class="icofont-eye-blocked"></i></span>
                  </div>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                </div>
                <small id="password_error" class="form-text text-danger mb-3"></small>
              </div>


              <div class="text-center mb-2">
                <button class="btn btn-primary btn-block" type="submit" id="btn-login">Login</button>
                <div class="text-muted mt-2">
                  <a href="<?= base_url('authController') ?>">Lupa Password?</a>
                </div>
              </div>
            </form>
          </div>

        </div>

      </div>
    </section>

  </main>

  <style>
    /* Style untuk button login */
    /* Style untuk button login */
    .btn-login {
      width: 100%;
      height: 50px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 18px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: all 0.3s ease-in-out;
    }

    .btn-login:hover {
      background-color: #388e3c;
    }

    /* Style untuk input field */
    input[type="text"],
    input[type="password"] {
      height: 50px;
      padding: 12px 20px;
      border-radius: 25px;
      background-color: #f2f2f2;
      border: none;
      font-size: 16px;
      font-weight: 400;
      letter-spacing: 1px;
      margin-bottom: 20px;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      background-color: #fff;
      box-shadow: 0 0 5px rgba(81, 203, 238, 1);
    }

    /* Style untuk input group */
    .input-group {
      margin-bottom: 20px;
    }

    .input-group-prepend .input-group-text {
      background-color: #f2f2f2;
      border: none;
    }

    /* Style untuk form validation error message */
    .form-text {
      font-size: 14px;
      font-weight: 400;
      letter-spacing: 1px;
    }
  </style>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

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