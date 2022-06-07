<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800">Pesanan Dibayar</h1>
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel antrian pesanan</h6>
    </div>
    <div class="card-body text-gray-800">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="TableAntrian" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Paket</th>
                        <th>Nominal</th>
                        <th>Tgl Bayar</th>
                    </tr>
                </thead>
                <tbody id="DataTableAntrian">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal detail -->
<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail order : <span id="OrderIDModalDetail"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="ModalUpdate-body container-fluid p-3">
                <div id="DetailPaket" class="text-center"></div>
                <hr>
                <div class="row mb-1">
                    <div class="col-4">Nominal</div>
                    <div class="col-8">: <b id="DetailNominal"></b></div>
                </div>
                <div class="row mb-1">
                    <div class="col-4">User ID</div>
                    <div class="col-8">: <b id="DetailUserID" class="text-danger"></b></div>
                </div>
                <div class="row mb-1">
                    <div class="col-4">Username</div>
                    <div class="col-8">: <b id="DetailUsername" class="text-danger"></b></div>
                </div>
                <div class="row mb-1">
                    <div class="col-4">Promocode</div>
                    <div class="col-8">: <b id="DetailPromocode"></b></div>
                </div>
                <div class="row mb-1">
                    <div class="col-4">Note</div>
                    <div class="col-8">: <b id="DetailNote"></b></div>
                </div>
                <div class="row mb-1">
                    <div class="col-4">Harga</div>
                    <div class="col-8">: <b id="DetailHarga"></b></div>
                </div>
                <div class="row mb-1">
                    <div class="col-4">Pay At</div>
                    <div class="col-8">: <b id="DetailPayAt"></b></div>
                </div>

            </div>
            <div class="modal-footer detail-footer">
                <button type="button" class="btn btn-danger" id="CancelButton">Cancel</button>
                <button type="button" class="btn btn-primary" id="ProcessButton" data-toggle="modal"
                    data-target="#ModalProcess">Process (PO)</button>
                <button type="button" class="btn btn-success" id="FinishButton">Finish</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Process-->
<div class="modal fade" id="ModalProcess" tabindex="-1" role="dialog" aria-labelledby="example1ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example1ModalLabel">Proses Order <span id="OrderIDModalProcess"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Tanggal Diproses</span>
                <input type="datetime-local" class="input-group-text w-100" name="DatetimeProcess" id="DatetimeProcess">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="SaveProcessButton">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('datatables'); ?>
<script>
$(document).ready(function() {

    showTable();

});

//fungsi tampilkan barang
function showTable() {
    $.ajax({
        type: 'GET',
        url: '<?php echo base_url('admin/data/getpesanandibayar')?>',
        async: true,
        dataType: 'json',
        success: function(data) {
            var html = '';
            var i;
            for (i = 0; i < data.length; i++) {
                html += '<tr>' +
                    '<td><a href="#" data-toggle="modal" data-target="#ModalUpdate" class="TombolUpdate" data="' +
                    data[i].order_id + '">Detail</a></td>' +
                    '<td>' + data[i].order_id + '</td>' +
                    '<td>' + data[i].paket + '</td>' +
                    '<td>' + data[i].total_harga + '</td>' +
                    '<td>' + data[i].pay_at + '</td>' +
                    '</tr>';
            }
            $('#DataTableAntrian').html(html);
            $('#TableAntrian').DataTable();
        }

    });
}

// Fungsi ambil detail transaksi
$('#DataTableAntrian').on('click', '.TombolUpdate', function() {
    var order_id = $(this).attr('data');
    $('#OrderIDModalDetail').html(order_id);
    $('#OrderIDModalProcess').html(order_id);
    $('#FinishButton').val(order_id);
    $('#CancelButton').val(order_id);
    $('#SaveProcessButton').val(order_id);
    $('#DetailPaket').html('Loading...');
    $('#DetailNominal').html('Loading...');
    $('#DetailUserID').html('Loading...');
    $('#DetailUsername').html('Loading...');
    $('#DetailPromocode').html('Loading...');
    $('#DetailNote').html('Loading...');
    $('#DetailHarga').html('Loading...');
    $('#DetailPayAt').html('Loading...');
    $.ajax({
        type: "GET",
        url: "<?= base_url('api/detailorder'); ?>/" + order_id,
        dataType: "JSON",
        success: function(data) {
            // console.log(data);
            $('#DetailPaket').html(data.data.paket);
            $('#DetailNominal').html(data.data.nominal);
            $('#DetailUserID').html(data.data.userid);
            $('#DetailUsername').html(data.data.username);
            $('#DetailPromocode').html(data.data.promocode);
            $('#DetailNote').html(data.data.note);
            $('#DetailHarga').html(data.data.total_harga);
            $('#DetailPayAt').html(data.data.pay_at);
        }
    });
});

// Function finish
$('#FinishButton').on('click', function() {
    var order_id = $(this).attr('value');
    if (confirm('Are you sure want to change status order ' + order_id + ' to "Finish"?')) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('api/updatestatus'); ?>",
            dataType: "JSON",
            data: {
                order_id: order_id,
                status: 'finish'
            },
            success: function(data) {
                if (data.status == 200) {
                    alert("Order ID " + data.order_id + " Telah berhasil diubah.");
                } else if (data.status == 400) {
                    alert("Order ID " + data.order_id + " Gagal diubah.");
                }

                $('#ModalUpdate').modal('hide');
                showTable();
            }
        });
    }
});

// Function save
$('#SaveProcessButton').on('click', function() {
    var order_id = $(this).attr('value');
    var date_time = $('[name="DatetimeProcess"]').val();

    if (date_time == '') {
        alert("Isi Tanggal!");
    } else if (confirm('Are you sure want to change status order ' + order_id +
            ' to "Process" and time process is "' +
            date_time + '"?')) {

        $.ajax({
            type: "POST",
            url: "<?= base_url('api/updatestatus'); ?>",
            dataType: "JSON",
            data: {
                order_id: order_id,
                status: 'process',
                datetime: date_time
            },
            success: function(data) {
                if (data.status == 200) {
                    alert("Order ID " + data.order_id + " Telah berhasil diubah.");
                } else if (data.status == 400) {
                    alert("Order ID " + data.order_id + " Gagal diubah.");
                }
                $('#ModalProcess').modal('hide');
                $('#ModalUpdate').modal('hide');
                showTable();
            }
        });
    }
});

// Function cancel
$('#CancelButton').on('click', function() {
    var order_id = $(this).attr('value');
    if (confirm('Are you sure want to change status order ' + order_id + ' to "Cancel"?')) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('api/updatestatus'); ?>",
            dataType: "JSON",
            data: {
                order_id: order_id,
                status: 'cancel'
            },
            success: function(data) {
                if (data.status == 200) {
                    alert("Order ID " + data.order_id + " Telah berhasil diubah.");
                } else if (data.status == 400) {
                    alert("Order ID " + data.order_id + " Gagal diubah.");
                }

                $('#ModalUpdate').modal('hide');
                showTable();
            }
        });
    }
});
</script>
<?= $this->endSection(); ?>