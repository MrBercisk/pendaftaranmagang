<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <p>Selamat Datang, <?= $nama_peserta ?></p>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="<?php echo base_url('file_peserta/' . $foto); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">

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
</nav>