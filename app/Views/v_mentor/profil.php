<?= $this->extend('layouts_mentor/template_mentor') ?>



<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Aplikasi E-Magang</h3>
                            <p><?= $judul; ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
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
                                        
                                            <form>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                                                    <input type="nama" name="nama" value="<?php echo $nama ?>" class="form-control" id="exampleFormControlInput1" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                                    <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="exampleFormControlInput1" readonly>
                                                </div>
                                            </form>
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
                                            <form method="POST" action="<?= base_url('mentor/updatePassword') ?>">
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
                                                <button type="submit" class="btn btn-primary">Update Password</button>
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