<?= $this->extend('temp/main') ?>

<?= $this->section('judul') ?>
<i class="fa fa-tasks"></i> Data Penyakit
<?= $this->endSection() ?>


<?= $this->section('isi') ?>

<div class="col-lg-12">
    <div class="card m-b-30">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary btntambah">
                <i class="fa fa-plus"></i> Tambah Penyakit
            </button>
        </div>
        <div class="card-body">
            <table id="datapenyakit" class="table table-striped table-sm display nowrap" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th>Nama Penyakit</th>
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
                        <td><?= $row->penyakitnm; ?></td>
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                onclick="hapus('<?= $row->penyakitid ?>')">
                                <i class="fa fa-trash-alt"></i>
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
    var table = $('#datapenyakit').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,

    });

    $('.btntambah').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: "<?= site_url('/penyakit/tambah') ?>",
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
        title: 'Hapus data Penyakit',
        text: "Yakin dihapus ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            window.location = "<?= site_url('/penyakit/hapus/') ?>" + no;
        }
    })
}
</script>
<?= $this->endSection() ?>