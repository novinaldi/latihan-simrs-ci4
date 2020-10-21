<!-- Modal -->
<?php $r = $row->getRow(); ?>
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog animated slideInRight" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pasien/update', ['class' => 'formsimpan']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">No.Pasien</label>
                    <input type="text" name="no" readonly class="form-control form-control-sm"
                        value="<?= $r->pasienno ?>">
                </div>
                <div class="form-group">
                    <label for="">NIK Pasien</label>
                    <input type="text" class="form-control form-control-sm" name="nik" id="nik" maxlength="16"
                        value="<?= $r->pasiennoktp ?>">
                    <div class="invalid-feedback errornik">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Nama Lengkap Pasien</label>
                    <input type="text" class="form-control form-control-sm" name="nama" id="nama"
                        value="<?= $r->pasiennama ?>">
                    <div class="invalid-feedback errornama">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Jenkel</label>
                    <select class="form-control form-control-sm" name="jenkel" id="jenkel">
                        <option value="L" <?php if ($r->pasienjk == 'L') echo 'selected'; ?>>Laki-Laki</option>
                        <option value="P" <?php if ($r->pasienjk == 'P') echo 'selected'; ?>>Perempuan</option>
                    </select>
                    <div class="invalid-feedback errorjenkel">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control form-control-sm" name="alamat" id="alamat"
                        value="<?= $r->pasienalamat ?>">
                    <div class="invalid-feedback erroralamat">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Telp./HP</label>
                    <input type="text" class="form-control form-control-sm" name="telp" id="telp"
                        value="<?= $r->pasientelp ?>">
                    <div class="invalid-feedback errortelp">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btnsimpan">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.formsimpan').submit(function(e) {
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
                    if (response.error.nik) {
                        $('#nik').addClass('is-invalid');
                        $('.errornik').html(response.error.nik)
                    } else {
                        $('#nik').removeClass('is-invalid');
                        $('.errornik').html('');
                    }

                    if (response.error.nama) {
                        $('#nama').addClass('is-invalid');
                        $('.errornama').html(response.error.nama)
                    } else {
                        $('#nama').removeClass('is-invalid');
                        $('.errornama').html('');
                    }

                    if (response.error.jenkel) {
                        $('#jenkel').addClass('is-invalid');
                        $('.errorjenkel').html(response.error.jenkel)
                    } else {
                        $('#jenkel').removeClass('is-invalid');
                        $('.errorjenkel').html('');
                    }


                    if (response.error.alamat) {
                        $('#alamat').addClass('is-invalid');
                        $('.erroralamat').html(response.error.alamat)
                    } else {
                        $('#alamat').removeClass('is-invalid');
                        $('.erroralamat').html('');
                    }

                    if (response.error.telp) {
                        $('#telp').addClass('is-invalid');
                        $('.errortelp').html(response.error.telp)
                    } else {
                        $('#telp').removeClass('is-invalid');
                        $('.errortelp').html('');
                    }
                }


                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses
                    }).then((result) => {
                        if (result.value) {
                            window.location.reload();
                        }
                    })
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