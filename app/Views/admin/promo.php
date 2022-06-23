<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Promo</h1>
<div class="card shadow card-body">
    <button type="button" class="btn btn-primary mb-4">Tambah Promo</button>
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="table-promo" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Kode Promo</td>
                    <td>Diskon</td>
                    <td>Minimal Beli</td>
                    <td>Maksimal Diskon</td>
                    <td>Paket</td>
                    <td>Limit</td>
                    <td>Expired</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody id="DataPromo">

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
        url: '<?php echo base_url('admin/data/getallpromo')?>',
        async: true,
        dataType: 'json',
        success: function(data) {
            var html = '';
            var i;
            var no = 1;
            for (i = 0; i < data.length; i++) {

                if (data[i].disc < 1) {
                    disc = (data[i].disc * 100) + '%';
                } else {
                    disc = data[i].disc;
                }

                if (data[i].nama_paket == "99") {
                    nama_paket = "All Paket";
                } else {
                    nama_paket = data[i].nama_paket;
                }

                html += '<tr>' +
                    '<td>' + no + '</td>' +
                    '<td>' + data[i].code + '</td>' +
                    '<td>' + disc + '</td>' +
                    '<td>' + data[i].min + ' IDR</td>' +
                    '<td>' + data[i].max + ' IDR</td>' +
                    '<td>' + nama_paket + '</td>' +
                    '<td></td>' +
                    '<td>' + data[i].expired + '</td>' +
                    '<td><i class="fas fa-edit"></i><i class="fas fa-trash"></i></td>' +
                    '</tr>';
                no++;
            }
            $('#DataPromo').html(html);
            $('#table-promo').DataTable();
        }

    });
}
</script>
<?= $this->endSection(); ?>