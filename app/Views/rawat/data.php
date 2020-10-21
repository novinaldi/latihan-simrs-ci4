<?= $this->extend('temp/main') ?>

<?= $this->section('judul') ?>
<i class="fa fa-hospital"></i> Data Rawat Inap
<?= $this->endSection() ?>




<?= $this->section('isi') ?>


<div class="col-lg-12">
    <div class="card m-b-30">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-warning"
                onclick="window.location='<?= site_url('rawatinap/input') ?>'">
                <i class="fa fa-fast-backward"></i> Kembali
            </button>
        </div>
        <div class="card-body">

            <table id="datarawat" class="table table-striped table-sm display nowrap" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Kode Rawat</th>
                        <th>Tgl.Rawat</th>
                        <th>Nama Pasien</th>
                        <th>Penyakit</th>
                        <th>Kamar</th>
                        <th style="width: 8%;">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 0;
                    foreach ($tampildata->getResult() as $row) {
                        $nomor++; ?>
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $row->rawatkode; ?></td>
                        <td><?= $row->rawattgl; ?></td>
                        <td><?= $row->pasiennama; ?></td>
                        <td><?= $row->penyakitnm; ?></td>
                        <td><?= $row->kamarnm; ?></td>
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                onclick="hapus('<?= $row->rawatkode ?>','<?= $row->kamarkode ?>')">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    var table = $('#datarawat').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,

    });
});

function hapus(kode, kodekamar) {
    Swal.fire({
        title: 'Hapus Data Rawat Inap',
        html: `Yakin menghapus kode rawat <strong>${kode}</strong> ini ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "post",
                url: "<?= site_url('rawatinap/hapus') ?>",
                data: {
                    kode: kode,
                    kodekamar: kodekamar
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        }).then((result) => {
                            if (result.value) {
                                window.location.reload();
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    })
}
</script>

<?= $this->endSection() ?>