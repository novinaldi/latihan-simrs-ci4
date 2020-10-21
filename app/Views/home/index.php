<?= $this->extend('temp/main') ?>

<?= $this->section('judul') ?>
<i class="fa fa-tachometer-alt"></i> Beranda
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<?php
$session = \Config\Services::session();

if ($session->get('login') == TRUE) {
?>
<div class="col-lg-12">
    <div class="card m-b-30 text-white card-success">
        <div class="card-body">
            <blockquote class="card-bodyquote">
                <p>Selamat Datang <?= $session->get('iduser'); ?></p>

            </blockquote>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="col-lg-12">
    <div class="card m-b-30 text-white card-primary">
        <div class="card-body">
            <blockquote class="card-bodyquote">
                <p>Silahkan Login Terlebih dahulu</p>
                <footer>
                    <button type="button" class="btn btn-success"
                        onclick="window.location='<?= site_url('/login/index') ?>'">
                        <i class="fa fa-lock"></i> Login
                    </button>
                </footer>
            </blockquote>
        </div>
    </div>
</div>
<?php } ?>
<?= $this->endSection() ?>