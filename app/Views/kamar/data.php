<?= $this->extend('temp/main') ?>

<?= $this->section('judul') ?>
<i class="fa fa-hospital"></i> Manajemen Data Kamar
<?= $this->endSection() ?>


<?= $this->section('isi') ?>

<div class="col-lg-12">
    <div class="card m-b-30">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary btntambah">
                <i class="fa fa-plus-square"></i> Tambah Data Kamar
            </button>
        </div>
        <div class="card-body">
            <table id="datakamar" class="table table-striped table-sm display nowrap" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Kode Kamar</th>
                        <th>Nama Kamar</th>
                        <th>Status</th>
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
                        <td><?= $row->kamarkode; ?></td>
                        <td><?= $row->kamarnm; ?></td>
                        <td>
                            <?php if ($row->kamarstt == 0) {
                                ?>
                            <span class="badge badge-success">Kosong</span>
                            <?php
                                } else {
                                ?>
                            <span class="badge badge-danger">Terisi</span>
                            <?php
                                } ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                onclick="hapus('<?= $row->kamarkode ?>')">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-outline-info btn-sm"
                                onclick="edit('<?= $row->kamarkode ?>')">
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
    var table = $('#datakamar').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,

    });

    $('.btntambah').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: "<?= site_url('/kamar/tambah') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modaltambah').on('shown.bs.modal', function(e) {
                    $('#kode').focus();
                });
                $('#modaltambah').modal('show');
            }
        });
    });
});

function hapus(no) {
    Swal.fire({
        title: 'Hapus Kamar',
        text: "Yakin dihapus ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            window.location = "<?= site_url('/kamar/hapus/') ?>" + no;
        }
    })
}

function edit(no) {
    $.ajax({
        type: "post",
        url: "<?= site_url('/kamar/formedit') ?>",
        data: {
            no: no
        },
        dataType: "json",
        success: function(response) {
            $('.viewmodal').html(response.data).show();
            $('#modaledit').on('shown.bs.modal', function(e) {
                $('#nama').focus();
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