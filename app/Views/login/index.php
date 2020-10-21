<?= $this->extend('temp/main') ?>

<?= $this->section('judul') ?>
<i class="fa fa-lock"></i> Login
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<div class="col-lg-4">
</div>
<div class="col-lg-4">
    <div class="card m-b-30">
        <div class="card-header">
            Silahkan Login
        </div>
        <div class="card-body">
            <?= form_open('login/validasiuser', ['class' => 'formlogin']) ?>
            <div class="form-group">
                <label for="">ID User</label>
                <input type="text" name="uid" id="uid" class="form-control form-control-sm" autofocus>
                <div class="invalid-feedback erroruid">
                </div>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="pass" id="pass" class="form-control form-control-sm">
                <div class="invalid-feedback errorpass">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success btnsimpan">
                    Login
                </button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<div class="col-lg-4">
</div>
<script>
$(document).ready(function() {
    $('.formlogin').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function(e) {
                $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                $('.btnsimpan').prop('disabled', true);
            },
            complete: function(e) {
                $('.btnsimpan').html('Login');
                $('.btnsimpan').prop('disabled', false);
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.uid) {
                        $('#uid').addClass('is-invalid');
                        $('.erroruid').html(response.error.uid)
                    } else {
                        $('#uid').removeClass('is-invalid');
                        $('.erroruid').html('');
                    }

                    if (response.error.pass) {
                        $('#pass').addClass('is-invalid');
                        $('.errorpass').html(response.error.pass)
                    } else {
                        $('#pass').removeClass('is-invalid');
                        $('.errorpass').html('');
                    }


                }


                if (response.sukses) {
                    window.location.href = ("<?= site_url('home/index') ?>");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    });
});
</script>
<?= $this->endSection() ?>