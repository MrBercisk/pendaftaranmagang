<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <p class="text-info">Selamat Datang, <b><?= $nama ?></b> !</p>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right me-3">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="/assets/adminlte3/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                <?= $nama; ?>
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-xs"><?= $email; ?></p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url('dashboard/logout'); ?>" class="dropdown-item dropdown-footer">Logout</a>
      </div>
    </li>
  </ul>



  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifikasi Pendaftar -->
    <li class="nav-item">
      <a href="<?php echo base_url('datapendaftaran'); ?>" class="nav-link" role="button">
        <i class="fas fa-bell text-warning" id="bell-icon"></i>
        <?php
        // Memeriksa apakah ada data pendaftaran yang belum diolah
        if ($jumlah_pendaftaran > 0) :
        ?>
          <span class="badge bg-danger  ">Pendaftar Baru (<?php echo $jumlah_pendaftaran ?>)</span>
        <?php endif ?>

        <style>
          /* Membuat animasi kedip-kedip */
          @keyframes blink {
            0% {
              opacity: 1;
            }

            50% {
              opacity: 0;
            }

            100% {
              opacity: 1;
            }
          }

          /* Mengatur animasi pada icon bel */
          #bell-icon {
            font-size: 20px;
          }
          .badge{
            animation: blink 1s infinite;
          }
        </style>

        <script>
          // Menambahkan event listener untuk mengatur perilaku notifikasi bell
          document.getElementById('bell-icon').addEventListener('click', function() {
            // Menghilangkan notifikasi badge
            this.nextElementSibling.remove();
            // Lakukan tindakan yang sesuai ketika notifikasi bell ditekan
            // contohnya: membuka halaman pengolahan data pendaftaran
            window.location.href = 'datapendaftaran';
          });
        </script>

      </a>
    </li>

    <!-- End notif -->
    <!-- Messages Dropdown Menu -->
  </ul>
</nav>