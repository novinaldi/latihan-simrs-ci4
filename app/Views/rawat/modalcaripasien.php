<!-- Modal -->
<div class="modal fade" id="modalcaripasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl animated slideInLeft" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Data Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                                <button type="button" class="btn btn-outline-info btn-sm"
                                    onclick="pilih('<?= $row->pasienno ?>','<?= $row->pasiennama ?>','<?= $row->pasienalamat ?>','<?= $row->pasientelp ?>')">
                                    Pilih
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    var table = $('#datapasien').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,

    });
});

function pilih(no, nama, alamat, telp) {
    $('#nopasien').val(no);
    $('#namapasien').val(nama);
    $('#alamat').val(alamat);
    $('#telp').val(telp);

    $('#modalcaripasien').modal('hide');
}
</script>