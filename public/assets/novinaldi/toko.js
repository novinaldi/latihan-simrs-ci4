$(document).ready(function () {
    $('.btnupdatetoko').click(function (e) {
        $.ajax({
            url: "./formupdate",
            success: function (response) {
                $('.viewmodal').html(response).show();
                $('#modalupdate').modal('show');
            }
        });
    });

    $('.formtokox').submit(function (e) {
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function () {
                $('.btnsimpan').attr('disabled', 'disabled');
                $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i> Sedang di Proses');
            },
            success: function (response) {
                window.location.reload();
            },
            complete: function () {
                $('.btnsimpan').removeAttr('disabled');
                $('.btnsimpan').html('Simpan');
            }
        });
        return false;
    });
});