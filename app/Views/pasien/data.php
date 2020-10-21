<?= $this->extend('temp/main') ?>

<?= $this->section('judul') ?>
<i class="fa fa-users"></i> Manajemen Data User
<?= $this->endSection() ?>


<?= $this->section('isi') ?>

<div class="col-lg-12">
    <div class="card m-b-30">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary btntambah">
                <i class="fa fa-plus"></i> Tambah Pasien
            </button>
        </div>
        <div class="card-body">
            <table id="datapasien" class="table table-striped table-sm display nowrap" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>No.Pasien</th>
                        <th>NIK</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>Jenkel</th>
                        <th>Telp</th>
                        <th style="width: 8%;">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 0;
                    foreach ($tampildata->getResult() as $row) :
                        $nomor++;
                    ?>
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $row->pasienno; ?></td>
                        <td><?= $row->pasiennoktp; ?></td>
                        <td><?= $row->pasiennama; ?></td>
                        <td><?= $row->pasienalamat; ?></td>
                        <td><?= $row->pasienjk; ?></td>
                        <td><?= $row->pasientelp; ?></td>
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                onclick="hapus('<?= $row->pasienno ?>')">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-outline-info btn-sm"
                                onclick="edit('<?= $row->pasienno ?>')">
                                <i class="fa fa-tags"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
$(document).ready(function() {
    var table = $('#datapasien').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,

    });

    $('.btntambah').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: "<?= site_url('/pasien/tambah') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modaltambah').on('shown.bs.modal', function(e) {
                    $('#nik').focus();
                });
                $('#modaltambah').modal('show');
            }
        });
    });
});

function hapus(no) {
    Swal.fire({
        title: 'Hapus Pasien',
        text: "Yakin dihapus ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            window.location = "<?= site_url('/pasien/hapus/') ?>" + no;
        }
    })
}

function edit(no) {
    $.ajax({
        type: "post",
        url: "<?= site_url('/pasien/formedit') ?>",
        data: {
            no: no
        },
        dataType: "json",
        success: function(response) {
            $('.viewmodal').html(response.data).show();
            $('#modaledit').on('shown.bs.modal', function(e) {
                $('#nik').focus();
            });
            $('#modaledit').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}
</script>
<?= $this->endSection() ?>