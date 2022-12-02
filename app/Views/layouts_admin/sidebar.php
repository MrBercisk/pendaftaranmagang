<aside class="main-sidebar sidebar-light-info elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('magang'); ?>" class="brand-link">
    <img src="http://localhost/diskominfosan/public/assets/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">E-Magang</span>
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
          <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php if ($page == 'dashboard') echo " active";  ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Master Data
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- Data bidang -->
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
            <!-- Data Mentor -->
            <li class="nav-item has-treeview <?php if ($page == 'datamentor') echo "menu-open";  ?>">
              <a href="#" class="nav-link <?php if ($page == 'datamentor') echo "active";  ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Data Mentor
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
                    <a href="<?php echo base_url('datamentor/index/' . $idBidang); ?>" class="nav-link <?php if ($uri->getTotalSegments() == 3) : ?>
                      <?php if ($idBidang == $uri->getSegment(3)) echo "active";  ?>
                  <?php endif ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p><?php echo $menu['nama_bidang']; ?></p>
                    </a>
                  </li>
                </ul>
              <?php endforeach ?>
            </li>
            <!-- Data Pendaftaran -->
            <li class="nav-item">
              <a href="<?php echo base_url('datapendaftaran'); ?>" class="nav-link <?php if ($page == 'datapendaftaran') echo " active";  ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Data Pendaftaran
                </p>
              </a>
            </li>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a href="<?php echo base_url('profil'); ?>" class="nav-link <?php if ($page == 'profil') echo " active";  ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Profil
            </p>
          </a>
        </li> -->
        <!-- Informasi -->
        <li class="nav-item">
          <a href="<?php echo base_url('informasi'); ?>" class="nav-link <?php if ($page == 'informasi') echo " active";  ?>">
            <i class="nav-icon fas fa-info-circle"></i>
            <p>
              Informasi
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