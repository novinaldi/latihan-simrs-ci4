function tampildataproduk() {
    table = $('#dataproduk').DataTable({
        responsive: true,
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": './ambildataproduk',
            "type": "POST"
        },


        "columnDefs": [
            {
                "targets": [1],
                "orderable": false,
                "width": 5
            },
            {
                "targets": [0],
                "orderable": false,
                "width": 5
            },
            {
                "targets": [5],
                "className": 'text-right'
            },
            {
                "targets": [6],
                "className": 'text-right'
            },
            {
                "targets": [8],
                "className": 'text-right'
            }
        ],

    });
}
$(document).ready(function (e) {
    tampildataproduk();

    $('#check-all').click(function (e) {
        if ($(this).is(":checked")) {
            $(".check-item").prop("checked", true);
        } else {
            $(".check-item").prop("checked", false);
        }
    });
});

// Hapus Produk
function hapusproduk(id, nama) {
    Swal.fire({
        title: 'Hapus',
        text: `Yakin Menghapus Produk ${nama} ?, Produk yang terhapus tidak permanen !`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus !',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "post",
                url: "./hapusproduk",
                data: {
                    id: id
                },
                dataType: "json",
                success: function (response) {
                    if (response.sukses) {
                        tampildataproduk();
                        $.toast({
                            heading: 'Berhasil',
                            text: response.sukses,
                            icon: 'success',
                            loader: true,
                        });
                    }
                }
            });
        }
    })
}

//Hapus multiple
$(document).on('submit', '.formdelete', function (e) {
    let pilih = $('.check-item:checked');

    if (pilih.length === 0) {
        Swal.fire('Perhatian', 'Tidak Ada item Produk yang di pilih untuk dihapus !', 'warning');
    } else {
        Swal.fire({
            title: 'Hapus Produk',
            text: `Yakin Menghapus ${pilih.length} Produk yang dipilih ?, Produk yang terhapus tidak permanen !`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus !',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    // dataType: "json",
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        })
    }

    return false;
});

// Form edit
function formedit(id) {
    window.location.href = ('edit/') + id;
}

// Add Harga
function tambahharga(id) {
    window.location.href = ('addharga/') + id;
}

// Menampilkan Detail Produk
function showDetail(kode) {
    $.ajax({
        type: "post",
        url: "./showdetail",
        data: {
            kode: kode
        },
        cache: false,
        success: function (response) {
            $('.viewshowdetail').html(response).show();
            $('#modalshowdetail').modal('show');
        }
    });
}