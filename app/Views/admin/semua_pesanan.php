<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Semua Pesanan</h1>
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel semua pesanan</h6>
    </div>

    <div class="card-body text-gray-800">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="table-pesanan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Paket</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="DataTableSemuaPesanan">
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
        url: '<?php echo base_url('admin/data/getsemuapesanan')?>',
        async: true,
        dataType: 'json',
        success: function(data) {
            var html = '';
            var i;
            for (i = 0; i < data.length; i++) {

                if (data[i].status == 'pending') {
                    badge_color = 'bg-secondary';
                } else if (data[i].status == 'settlement') {
                    badge_color = 'bg-success';
                } else if (data[i].status == 'cancel') {
                    badge_color = 'bg-warning';
                } else if (data[i].status == 'failure') {
                    badge_color = 'bg-danger';
                } else if (data[i].status == 'expire') {
                    badge_color = 'bg-dark';
                } else if (data[i].status == 'process') {
                    badge_color = 'bg-info';
                } else if (data[i].status == 'finish') {
                    badge_color = 'bg-primary';
                }

                html += '<tr>' +
                    '<td><a href="#" data-toggle="modal" data-target="#ModalDetail" class="TombolDetail" data="' +
                    data[i].order_id + '">Detail</a></td>' +
                    '<td>' + data[i].order_id + '</td>' +
                    '<td>' + data[i].paket + '</td>' +
                    '<td>' + data[i].nominal + '</td>' +
                    '<td> <p class="badge ' + badge_color + ' text-white">' + data[i].status + '</p></td>' +
                    '</tr>';
            }
            // $('#DataTableSemuaPesanan').html(html);
            // $('#table-pesanan').DataTable();
            $('#table-pesanan').DataTable().destroy();
            $('#table-pesanan').find('#DataTableSemuaPesanan').html('');
            $('#table-pesanan').find('#DataTableSemuaPesanan').append(html);
            $('#table-pesanan').DataTable().draw();
        }

    });
}

$('#DataTableSemuaPesanan').on('click', '.TombolDetail', function() {
    var order_id = $(this).attr('data');
    $('#OrderIDModalDetail').html(order_id);
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