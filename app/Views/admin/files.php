<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">File Management</h1>
<div class="card shadow card-body">
    <h1 class="h3 mb-4 text-center text-gray-800">Upload New Files</h1>
    <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">File Type</label>
        <div class="col-sm-10">
            <select class="custom-select" id="inputGroupSelect01">
                <option value="matauang" selected>Matauang</option>
                <option value="banner_home">Banner Home</option>
                <option value="banner_game">Banner Game</option>
                <option value="cari_id">Cari ID</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Note</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword" placeholder="Please add note...">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Select File</label>
        <div class="col-sm-10">
            <input type="file" class="" id="imgFiles">
        </div>
    </div>
    <button class="btn btn-primary">Upload Files</button>
</div>

<div class="card shadow card-body mt-4">
    <h1 class="h3 mb-4 text-center text-gray-800">All Files</h1>
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="table-files" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipe File</th>
                    <th>Preview</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="DataTableFiles">
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
        url: '<?php echo base_url('admin/data/getallfiles')?>',
        async: true,
        dataType: 'json',
        success: function(data) {
            var html = '';
            var i;
            for (i = 0; i < data.length; i++) {

                nama_files = data[i].nama_files;

                if (data[i].tipe_files == 'matauang') {
                    lok = 'currency/' + nama_files;
                } else if (data[i].tipe_files == 'banner_home' || data[i].tipe_files == 'banner_game') {
                    lok = 'banner/' + nama_files;
                } else if (data[i].tipe_files == 'ikon' || data[i].tipe_files == 'cari_id') {
                    lok = 'icon/' + nama_files;
                } else if (data[i].tipe_files == 'pembayaran') {
                    lok = 'pembayaran/' + nama_files;
                }
                img = '<?= base_url(); ?>/assets/uploaded/image/' + lok;

                html += '<tr>' +
                    '<td>' + data[i].id + '</td>' +
                    '<td>' + data[i].tipe_files + '</td>' +
                    '<td><img src="' + img + '" style="width:auto;height:60px;"></td>' +
                    '<td>' + data[i].catatan + '</td>' +
                    '<td> <button type="button" class="btn btn-danger w-100" value="' + data[i].id +
                    '"> Hapus </button></td>' +
                    '</tr>';
            }
            $('#DataTableFiles').html(html);
            $('#table-files').DataTable();
        }

    });
}

$('.DelFiles101001').click(function() {
    // var id = $(this).attr('value');
    confirm('Hapus file dengan id ?');
});
</script>
<?= $this->endSection(); ?>