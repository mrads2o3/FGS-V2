<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Paket</h1>
<div class="card shadow card-body">
    <button type="button" class="btn btn-primary mb-4">Tambah Paket Baru</button>
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="table-paket" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <td>Kode Paket</td>
                    <td>Urutan</td>
                    <td>Nama Paket</td>
                    <td>Game</td>
                    <td>Status</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody id="DataPaket">

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
        url: '<?php echo base_url('admin/data/getallpaket')?>',
        async: true,
        dataType: 'json',
        success: function(data) {
            var html = '';
            var i;
            for (i = 0; i < data.length; i++) {

                html += '<tr>' +
                    '<td>' + data[i].kode_paket + '</td>' +
                    '<td>' + data[i].urutan + '</td>' +
                    '<td>' + data[i].nama_paket + '</td>' +
                    '<td>' + data[i].nama_game + '</td>' +
                    '<td>' + data[i].status + '</td>' +
                    '<td><i class="fas fa-edit"></i><i class="fas fa-trash"></i></td>' +
                    '</tr>';
            }
            $('#DataPaket').html(html);
            $('#table-paket').DataTable();
        }

    });
}
</script>
<?= $this->endSection(); ?>