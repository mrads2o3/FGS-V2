<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Games</h1>
<div class="card shadow card-body">
    <button type="button" class="btn btn-primary mb-4">Tambah Game Baru</button>
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="table-games" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Kode Game</td>
                    <td>Nama Game</td>
                    <td>Mata Uang</td>
                    <td>Ikon Game</td>
                    <td>Cari ID</td>
                    <td>Status</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody id="DataKategori">

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
        url: '<?php echo base_url('admin/data/getallgames')?>',
        async: true,
        dataType: 'json',
        success: function(data) {
            var html = '';
            var i;
            for (i = 0; i < data.length; i++) {

                html += '<tr>' +
                    '<td>' + data[i].urutan + '</td>' +
                    '<td>' + data[i].kode_game + '</td>' +
                    '<td>' + data[i].nama_game + '</td>' +
                    '<td><img src="<?= base_url(); ?>/assets/uploaded/image/currency/' + data[i]
                    .ikon_matauang +
                    '" style="width:20px"></img></td>' +
                    '<td><img src="<?= base_url(); ?>/assets/uploaded/image/icon/' + data[i].ikon_game +
                    '" style="width:40px"></img></td>' +
                    '<td><img src="<?= base_url(); ?>/assets/uploaded/image/icon/' + data[i].cari_id +
                    '" style="width:40px"></img></td>' +
                    '<td>' + data[i].status + '</td>' +
                    '<td><i class="fas fa-edit"></i><i class="fas fa-trash"></i></td>' +
                    '</tr>';
            }
            $('#DataKategori').html(html);
            $('#table-games').DataTable();
        }

    });
}
</script>
<?= $this->endSection(); ?>