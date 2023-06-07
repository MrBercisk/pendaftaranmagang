<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
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

  <link rel="stylesheet" href="https://unpkg.com/waves.css@0.7.6/dist/waves.min.css" />

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

  <!-- ======= Header ======= -->
  <?= $this->renderSection('header') ?>

  <!-- ======= Content ======= -->
  <?= $this->renderSection('content') ?>

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 footer-contact">
            <img src="<?= base_url('/assets/logo.png'); ?>" width="70px" class="mb-3">
            <h3>SI AMANG</h3>
            <p>
              Website Pendaftaran Magang <br>
              Dinas Komunikasi Informatika dan Persandian <br>
              Yogyakarta,Indonesia<br>
            </p>
          </div>
          <div class="col-lg-5 col-md-6 mb-3 footer-info">
            <p><i class="bi bi-geo-alt-fill me-2"></i> Jl. Kenari, Muja Muju, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta, 55165</p>
            <p><i class="bi bi-telephone-fill me-2"></i> (+62) 8123489122</p>
            <p><i class="bi bi-envelope-fill me-2"></i> kominfosandi@jogjakota.go.id</p>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->
  <div class="container ">
    <div class="row">
      <div class="col-md-12 text-center">
        <p>&copy; <?= date('Y'); ?> SI AMANG. All Rights Reserved.</p>
      </div>
    </div>
  </div>

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

  <!-- page script -->
  <?= $this->renderSection('script') ?>

</body>

</html>