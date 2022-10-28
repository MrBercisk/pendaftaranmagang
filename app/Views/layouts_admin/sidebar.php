<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
      <img src="/assets/adminlte3/dist/img/logo.jpg"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">E-Magang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/assets/adminlte3/dist/img/user1-128x128.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $nama; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dashboard -->
          <li class="nav-item">
            <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php if ($page == 'dashboard') echo " active";  ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- Informasi -->
          <li class="nav-item">
            <a href="<?php echo base_url('informasi'); ?>" class="nav-link <?php if ($page == 'informasi') echo " active";  ?>">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                Informasi
              </p>
            </a>
          </li>
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
            <?php foreach ($results as $menu): ?>
              <?php 
                $idBidang = $menu['id'];
              ?>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url('datakategori/index/'.$idBidang); ?>" class="nav-link <?php if ($uri->getTotalSegments() == 3): ?>
                      <?php if ($idBidang == $uri->getSegment(3)) echo "active";  ?>
                  <?php endif ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p><?php echo $menu['nama_bidang'];?></p>
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
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>