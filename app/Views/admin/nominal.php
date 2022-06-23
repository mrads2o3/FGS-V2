<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Nominal</h1>
<div class="card shadow card-body">
    <button type="button" class="btn btn-primary mb-4">Tambah Nominal</button>
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="table-nominal" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <td>Kode Harga</td>
                    <td>Urutan</td>
                    <td>Paket</td>
                    <td>Nominal</td>
                    <td>Harga</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody id="DataNominal">

            </tbody>
        </table>
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
        url: '<?php echo base_url('admin/data/getallnominal')?>',
        async: true,
        dataType: 'json',
        success: function(data) {
            var html = '';
            var i;
            for (i = 0; i < data.length; i++) {

                if (data[i].harga_promo > 0) {
                    harga_basic = '<s>' + data[i].harga_promo + '</s> ' + data[i].harga_basic;
                } else {
                    harga_basic = data[i].harga_basic;
                }

                html += '<tr>' +
                    '<td>' + data[i].kode_harga + '</td>' +
                    '<td>' + data[i].urutan + '</td>' +
                    '<td>' + data[i].nama_paket + '</td>' +
                    '<td>' + data[i].nominal + '</td>' +
                    '<td>' + harga_basic + '</td>' +
                    '<td><i class="fas fa-edit"></i><i class="fas fa-trash"></i></td>' +
                    '</tr>';
            }
            $('#DataNominal').html(html);
            $('#table-nominal').DataTable();
        }

    });
}
</script>
<?= $this->endSection(); ?>