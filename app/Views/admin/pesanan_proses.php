<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800">Pesanan Diproses</h1>
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel pesanan diproses</h6>
    </div>

    <div class="card-body text-gray-800">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="table-pesanan-proses" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Urutan</th>
                        <th>Order ID</th>
                        <th>Paket</th>
                        <th>Tgl. Mulai Proses</th>
                    </tr>
                </thead>
                <tbody id="DataTablePesananProses">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal detail -->
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail order : <span id="OrderIDModalDetail"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="ModalDetail-body container-fluid p-3">
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
                    <div class="col-4">Status</div>
                    <div class="col-8">: <b id="DetailStatus"></b></div>
                </div>

            </div>
            <div class="modal-footer detail-footer">
                <button type="button" class="btn btn-danger" id="CancelCustomizeButton">Cancel</button>
                <button type="button" class="btn btn-primary" id="CustomizeButton" data-toggle="modal"
                    data-target="#ModalCustomize">Sesuaikan PO</button>
                <button type="button" class="btn btn-success" id="FinishCustomizeButton">Finish</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Customize-->
<div class="modal fade" id="ModalCustomize" tabindex="-1" role="dialog" aria-labelledby="example1ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example1ModalLabel">Sesuaikan Order <span id="OrderIDModalCustomize"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Tanggal Diproses</span>
                <input type="datetime-local" class="input-group-text w-100" name="DatetimeCustomize"
                    id="DatetimeCustomize">
                <input type="checkbox" name="CBCustomize" id="CBCustomize"> Untuk semua <b class="text-black"
                    id="TextCBCustomize"></b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="SaveCustomizeButton">Save changes</button>
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

function showTable() {
    $.ajax({
        type: 'GET',
        url: '<?php echo base_url('admin/data/getpesanandiproses')?>',
        async: true,
        dataType: 'json',
        success: function(data) {
            var html = '';
            var i;
            for (i = 0; i < data.length; i++) {

                html += '<tr>' +
                    '<td><a href="#" data-toggle="modal" data-target="#ModalDetail" class="TombolDetail" data="' +
                    data[i].order_id + '">Detail </a></td>' +
                    '<td>' + data[i].no + '</td>' +
                    '<td>' + data[i].order_id + '</td>' +
                    '<td>' + data[i].paket + '</td>' +
                    '<td>' + data[i].process_time + '</td>' +
                    '</tr>';
            }
            // $('#DataTablePesananProses').html(html);
            // $('#table-pesanan-proses').DataTable();
            $('#table-pesanan-proses').DataTable().destroy();
            $('#table-pesanan-proses').find('#DataTablePesananProses').html('');
            $('#table-pesanan-proses').find('#DataTablePesananProses').append(html);
            $('#table-pesanan-proses').DataTable().draw();
        }

    });
}

function SaveCustomize(type, order_id, datetime, checkbox) {
    if (type == 'adjust') {
        data = {
            type: type,
            order_id: order_id,
            datetime: datetime,
            checkbox: checkbox
        }
    } else if (type == 'cancel' || type == 'finish') {
        data = {
            type: type,
            order_id: order_id
        }
    }

    $.ajax({
        type: "POST",
        url: "<?= base_url('api/cutomizeprocessorder'); ?>",
        dataType: "JSON",
        data: data,
        success: function(data) {
            if (data.var) {
                alert('Berhasil merubah data!');
            } else {
                alert('Gagal merubah data!');
            }

            $('#ModalCustomize').modal('hide');
            $('#ModalDetail').modal('hide');
            showTable();
        }
    });
}

$('#SaveCustomizeButton').click(function() {
    var order_id = $(this).attr('value');
    var datetime = document.getElementById('DatetimeCustomize').value;
    var checkbox_paket = document.getElementById('TextCBCustomize').innerHTML;
    var checkbox = document.getElementById('CBCustomize').checked;
    var type = 'adjust';

    if (order_id && datetime && type) {
        if (checkbox) {
            if (confirm('Are you sure want to change all "Tanggal mulai proses" where packet "' +
                    checkbox_paket + '" to "' +
                    datetime +
                    '"?')) {
                SaveCustomize(type, order_id, datetime, checkbox);
            }
        } else {
            if (confirm('Are you sure want to change "Tanggal mulai proses" order "' + order_id + '" to "' +
                    datetime +
                    '"?')) {
                SaveCustomize(type, order_id, datetime, checkbox);
            }
        }
    } else {
        confirm('Semua field wajib di isi!');
    }
});

$('#CancelCustomizeButton').click(function() {
    var order_id = $(this).attr('value');
    var type = 'cancel';
    if (confirm('Are you sure want to change "status" order id ' + order_id + ' to "cancel"?')) {
        if (order_id && type) {
            SaveCustomize(type, order_id, false, false);
        } else {
            confirm('Something went wrong!');
        }
    }
});

$('#FinishCustomizeButton').click(function() {
    var order_id = $(this).attr('value');
    var type = 'finish';
    if (confirm('Are you sure want to change "status" order id ' + order_id + ' to "finish"?')) {
        if (order_id && type) {
            SaveCustomize(type, order_id, false, false);
        } else {
            confirm('Something went wrong!');
        }
    }
});

$('#DataTablePesananProses').on('click', '.TombolDetail', function() {
    var order_id = $(this).attr('data');
    $('#OrderIDModalDetail').html(order_id);
    $('#SaveCustomizeButton').val(order_id);
    $('#CancelCustomizeButton').val(order_id);
    $('#FinishCustomizeButton').val(order_id);
    $('#OrderIDModalCustomize').html(order_id);
    $('#DetailPaket').html('Loading...');
    $('#DetailNominal').html('Loading...');
    $('#DetailUserID').html('Loading...');
    $('#DetailUsername').html('Loading...');
    $('#DetailPromocode').html('Loading...');
    $('#DetailNote').html('Loading...');
    $('#DetailHarga').html('Loading...');
    $('#DetailStatus').html('Loading...');

    $.ajax({
        type: "GET",
        url: "<?= base_url('api/detailorder'); ?>/" + order_id,
        dataType: "JSON",
        success: function(data) {

            $('#DetailPaket').html(data.data.paket);
            $('#TextCBCustomize').html(data.data.paket);
            $('#DetailNominal').html(data.data.nominal);
            $('#DetailUserID').html(data.data.userid);
            $('#DetailUsername').html(data.data.username);
            $('#DetailPromocode').html(data.data.promocode);
            $('#DetailNote').html(data.data.note);
            $('#DetailHarga').html(data.data.total_harga);
            $('#DetailStatus').html(data.data.status);
        }
    });
});
</script>
<?= $this->endSection(); ?>