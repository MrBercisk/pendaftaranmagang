<aside class="main-sidebar sidebar-light-info elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('updateprofile'); ?>" class="brand-link">
    <img src="<?= base_url('/assets/logo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SI AMANG</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <h4 class="ml-2 mt-2 text-sm text-lightblue">Menu</h4>
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="<?php echo base_url('updateProfile'); ?>" class="nav-link <?php if ($page == 'magang') echo " active";  ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('kalender'); ?>" class="nav-link <?php if ($page == 'jadwalbimbingan') echo " active";  ?>">
            <i class="nav-icon fas fa-calendar"></i>
            <p>
              Jadwal Bimbingan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('Profile'); ?>" class="nav-link <?php if ($page == 'Profil') echo " active";  ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Profil
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('diskusiForum'); ?>" class="nav-link <?php if ($page == 'Diskusi') echo " active";  ?>" onclick="resetNotification()">
            <i class="nav-icon fas fa-comments chat-icon"></i>
            <p>
              Forum Diskusi
            </p>
            <?php
            // Memeriksa apakah ada chat baru
            if ($chat_baru > 0) :
              // Cek apakah halaman diskusi diakses, jika iya, sembunyikan notifikasi chat baru
              if ($page == 'Diskusi') {
            
              }
            ?>
              <span id="notificationBadge" class="badge badge-danger"><?php echo $chat_baru ?> Pesan Baru</span> <!-- Tambahkan id untuk elemen span -->
            <?php endif ?>
          </a>
        </li>

        <script>
          // Cek jika halaman diskusi diakses, sembunyikan notifikasi chat baru
          window.onload = function() {
            var currentUrl = window.location.href;
            if (currentUrl.includes("<?php echo base_url('diskusiForum'); ?>")) {
              resetNotification();
            }
          }

          function resetNotification() {
            // Sembunyikan notifikasi chat baru
            document.getElementById('notificationBadge').style.display = 'none';
          }
        </script>


        <li class="nav-item">
          <a href="<?php echo base_url('progressMagang'); ?>" class="nav-link <?php if ($page == 'progress') echo " active";  ?>">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Progress
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('laporanMagang'); ?>" class="nav-link <?php if ($page == 'laporan') echo " active";  ?>">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>
        <?php if ($keterangan_laporan == 'Anda Sudah Upload Laporan') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('selesaiMagang'); ?>" class="nav-link <?php if ($page == 'selesai') echo " active";  ?>">
              <i class="nav-icon fas fa-file-pdf"></i>
              <p>
                Dokumen Akhir
              </p>
            </a>
          </li>
        <?php } ?>

        <li class="nav-item">
          <a href="<?php echo base_url('dashboard/logout'); ?>" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<script>
  // Fungsi untuk mereset notifikasi dan chat_baru menjadi 0
  function resetNotification() {
    var badge = document.getElementById('notificationBadge');
    badge.style.display = 'none';
  }
</script>