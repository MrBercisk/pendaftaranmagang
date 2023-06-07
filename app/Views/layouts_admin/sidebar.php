<aside class="main-sidebar sidebar-light-info elevation-4 collapsed">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
    <img src="<?= base_url('/assets/logo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SI AMANG</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar collapsed" id="sidebar">
    <!-- Sidebar user (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Menu -->
        <li class="nav-header">Menu</li>
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php if ($page == 'dashboard') echo " active";  ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <!-- Master Data -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Master Data
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- Data Bidang -->
            <li class="nav-item">
              <a href="<?php echo base_url('databidang'); ?>" class="nav-link <?php if ($page == 'databidang') echo " active";  ?>">
                <i class="nav-icon fas fa-university"></i>
                <p>
                  Data Bidang
                </p>
              </a>
            </li>
            <!-- Data Kategori -->
            <li class="nav-item has-treeview <?php if ($page == 'datakategori') echo "menu-open";  ?>">
              <a href="#" class="nav-link <?php if ($page == 'datakategori') echo "active";  ?>">
                <i class="nav-icon fas fa-school"></i>
                <p>
                  Data Kategori
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <?php
              //Creating URI instances
              $uri = service('uri');
              //Koneksi ke database tanpa menggunkan Models
              $db = \Config\Database::connect();
              //Menampilkan semua data Bidang untuk menu pada sidebar
              $query   = $db->query('SELECT * FROM tbl_bidang');
              $results = $query->getResultArray();
              ?>
              <?php foreach ($results as $menu) : ?>
                <?php
                $idBidang = $menu['id'];
                ?>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('datakategori/index/' . $idBidang); ?>" class="nav-link <?php if ($uri->getTotalSegments() == 3) : ?>
                      <?php if ($idBidang == $uri->getSegment(3)) echo "active";  ?>
                  <?php endif ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p><?php echo $menu['nama_bidang']; ?></p>
                    </a>
                  </li>
                </ul>
              <?php endforeach ?>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('kampus'); ?>" class="nav-link <?php if ($page == 'kampus') echo " active";  ?>">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                  Daftar Kampus
                </p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Master Data -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
              Data Pengguna
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- Data Mentor -->
            <li class="nav-item">
              <a href="<?php echo base_url('dataMentor'); ?>" class="nav-link <?php if ($page == 'datamentor') echo " active";  ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Data Mentor
                </p>
              </a>
            </li>
            <!-- Data Pendaftaran -->
            <li class="nav-item">
              <a href="<?php echo base_url('datapendaftaran'); ?>" class="nav-link <?php if ($page == 'datapendaftaran') echo " active";  ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Data Pendaftar
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">Kegiatan Magang</li>
        <li class="nav-item">
          <a href="<?php echo base_url('jadwalpeserta'); ?>" class="nav-link <?php if ($page == 'jadwalpeserta') echo " active";  ?>">
            <i class="nav-icon fas fa-calendar"></i>
            <p>
              Jadwal Peserta
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('dataProgress'); ?>" class="nav-link <?php if ($page == 'dataprogress') echo " active";  ?>">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Progress Mahasiswa
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('dataLaporan'); ?>" class="nav-link <?php if ($page == 'datalaporan') echo " active";  ?>">
            <i class="nav-icon fas fa-clipboard"></i>
            <p>
              Laporan Mahasiswa
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('datanilai'); ?>" class="nav-link <?php if ($page == 'datanilai') echo " active";  ?>">
            <i class="nav-icon fas fa-trophy"></i>
            <p>
              Nilai Mahasiswa
            </p>
          </a>
        </li>
        <!-- Informasi -->
        <li class="nav-header">Informasi</li>
        <li class="nav-item">
          <a href="<?php echo base_url('informasi'); ?>" class="nav-link <?php if ($page == 'informasi') echo " active";  ?>">
            <i class="nav-icon fas fa-info-circle"></i>
            <p>
              Kelola Informasi
            </p>
          </a>
        </li>
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