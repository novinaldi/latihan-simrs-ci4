<?= $this->extend('temp/main') ?>

<?= $this->section('judul') ?>
<i class="fa fa-procedures"></i> Input Rawat Inap
<?= $this->endSection() ?>




<?= $this->section('isi') ?>
<div class="col-lg-12">
    <div class="card m-b-30">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary"
                onclick="window.location='<?= site_url('rawatinap/data') ?>'">
                <i class="fa fa-tasks"></i> Lihat Transaksi Rawat Inap
            </button>
        </div>
        <div class="card-body">
            <?= form_open('rawatinap/simpan', ['class' => 'formsimpan']) ?>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Kode Rawat Inap</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="kode" id="kode"
                        value="<?= $koderawat; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tgl.Rawat Inap</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control form-control-sm" name="tgl" id="tgl">
                    <div class="invalid-feedback errortgl">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Pasien</label>
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-sm" placeholder="No.Pasien" name="nopasien"
                            id="nopasien" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary caripasien" type="button">Cari</button>
                        </div>
                    </div>
                    <div class="invalid-feedback errornopasien">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nama Pasien</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="namapasien" readonly id="namapasien">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" name="alamat" readonly id="alamat">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Telp.</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="telp" readonly id="telp">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Penyakit</label>
                <div class="col-sm-4">
                    <select name="penyakit" id="penyakit" class="form-control form-control-sm">
                        <option value="">-Pilih-</option>
                        <?php foreach ($datapenyakit->getResult() as $p) : ?>
                        <option value="<?= $p->penyakitid; ?>"><?= $p->penyakitnm; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback errorpenyakit">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Kamar</label>
                <div class="col-sm-4">
                    <select name="kamar" id="kamar" class="form-control form-control-sm">
                        <option value="">-Pilih-</option>
                        <?php foreach ($datakamar->getResult() as $k) : ?>
                        <option value="<?= $k->kamarkode; ?>"><?= $k->kamarnm; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback errorkamar">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success btnsimpan">
                        Simpan Data
                    </button>
                    <button type="reset" class="btn btn-info">
                        Reset
                    </button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<div class="viewmodalcari" style="display: none;"></div>
<script>
$(document).ready(function() {
    $('.caripasien').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('rawatinap/caripasien') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodalcari').html(response.data).show();
                $('#modalcaripasien').modal('show');
            }
        });
    });

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
                $('.btnsimpan').html('Simpan Data');
                $('.btnsimpan').prop('disabled', false);
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.tgl) {
                        $('#tgl').addClass('is-invalid');
                        $('.errortgl').html(response.error.tgl)
                    } else {
                        $('#tgl').removeClass('is-invalid');
                        $('.errortgl').html('');
                    }

                    if (response.error.nopasien) {
                        $('#nopasien').addClass('is-invalid');
                        $('.errornopasien').html(response.error.nopasien)
                    } else {
                        $('#nopasien').removeClass('is-invalid');
                        $('.errornopasien').html('');
                    }

                    if (response.error.penyakit) {
                        $('#penyakit').addClass('is-invalid');
                        $('.errorpenyakit').html(response.error.penyakit)
                    } else {
                        $('#penyakit').removeClass('is-invalid');
                        $('.errorpenyakit').html('');
                    }

                    if (response.error.kamar) {
                        $('#kamar').addClass('is-invalid');
                        $('.errorkamar').html(response.error.kamar)
                    } else {
                        $('#kamar').removeClass('is-invalid');
                        $('.errorkamar').html('');
                    }
                }

                if (response.errorkamar) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: response.errorkamar
                    })
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
<?= $this->endSection() ?>