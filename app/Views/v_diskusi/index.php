<?= $this->extend('layouts_magang/template_magang') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header bg-white" style="height: 50px; max-height: 100px;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <p class="text-muted">SI AMANG (Sistem Informasi Aplikasi Magang)</p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <!-- small box -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <!-- css style untuk tampilan chat -->
                                        <style>
                                            .chat-message {
                                                margin-bottom: 25px;
                                            }

                                            .chat-message-body {
                                                margin-top: 25px;
                                            }

                                            .chat-history {
                                                max-height: 300px;
                                                overflow-y: scroll;
                                            }

                                            .chat-form {
                                                position: fixed;
                                                bottom: 0;
                                                width: 100%;
                                                background-color: #f5f5f5;
                                                padding: 10px;
                                            }

                                            .chat-form textarea {
                                                border: none;
                                                border-radius: 20px;
                                                padding: 10px 20px;
                                                width: calc(100% - 80px);
                                                height: 40px;
                                                resize: none;
                                                outline: none;
                                            }

                                            .chat-form button {
                                                background-color: #007bff;
                                                border: none;
                                                border-radius: 50%;
                                                width: 40px;
                                                height: 40px;
                                                color: #fff;
                                                margin-left: 10px;
                                                outline: none;
                                            }
                                        </style>
                                        <!-- end style -->
                                        <div class="container py-5">
                                            <div class="row justify-content-center">
                                                <div class="col-md">
                                                    <div class="card">
                                                        <div class="alert alert-info" role="alert">
                                                            <strong>Petunjuk Penggunaan:</strong> Ini adalah menu chat bagi peserta magang.
                                                            Anda dapat melakukan diskusi dengan peserta lain sesuai kategori dan mentor terkait kegiatan magang.
                                                        </div>
                                                        <div class="card-body w-auto">
                                                            <div class="chat-history" style="background-color: #f8f9fa; padding: 35px;">
                                                                <?php foreach ($chat as $row) : ?>
                                                                    <?php if ($row->pengirim == session()->get('id')) : ?>
                                                                        <div class="chat-message d-flex justify-content-end" style="margin-bottom: 10px;">
                                                                            <div class="card bg-cream" style="max-width: 600px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                                                                <div class="row g-0">
                                                                                    <div class="col-md">
                                                                                        <div class="card-body" style="background-color: #ffffcc;">
                                                                                            <div class="bubble">
                                                                                                <h5 class="card-title chat-message-sender" style="color: #007bff; font-weight: bold; margin-bottom: 5px; font-size: 14px;"><?= $row->pengirim_nama ?></h5>
                                                                                                <p class="card-text chat-message-body" style="margin-bottom: 10px;"><?= $row->pesan ?></p>
                                                                                                <p class="card-text chat-message-time" style="font-size: 12px; color: #999;"><i class="far fa-clock"></i> <?= $row->waktu_kirim ?> <span class="badge "><i class="fas fa-check-double text-success fa-lg"></i></span></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php else : ?>
                                                                        <div class="chat-message d-flex" style="margin-bottom: 10px;">
                                                                            <div class="card bg-cream" style="max-width: 600px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                                                                                <div class="row g-0">
                                                                                    <div class="col-md">
                                                                                        <div class="card-body" style="background-color: #e5ffcc;">
                                                                                            <div class="bubble">
                                                                                                <h5 class="card-title chat-message-sender" style="color: #007bff; font-weight: bold; margin-bottom: 5px; font-size: 14px;"><?= $row->pengirim_nama ?></h5>
                                                                                                <p class="card-text chat-message-body" style="margin-bottom: 10px;"><?= $row->pesan ?></p>
                                                                                                <p class="card-text chat-message-time" style="font-size: 12px; color: #999;"><i class="far fa-clock"></i> <?= $row->waktu_kirim ?> <span class="badge "><i class="fas fa-check-double text-success fa-lg"></i></span></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </div>

                                                            <form method="post" action="<?= base_url('DiskusiForum/sendChat') ?>">
                                                                <div class="input-group m-3">
                                                                    <input class="form-control" name="pesan" id="pesan" rows="3" placeholder="Tulis pesan..." required></input>
                                                                    <div class="input-group-append">
                                                                        <button type="submit" class="btn btn-primary"><i class="fab fa-telegram-plane"></i></button>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="pengirim" value="<?= session()->get('user_id') ?>">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

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