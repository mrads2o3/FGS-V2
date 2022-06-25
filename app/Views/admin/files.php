<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">File Management</h1>
<?php 
if(session()->getFlashdata('message') !== NULL){
    $message = session()->getFlashdata('message');
    $type_alert = session()->getFlashdata('alert');
?>
<div class="alert alert-<?= $type_alert; ?>" role="alert">
    <?= $message; ?>
</div>
<?php 
}
?>
<div class="card shadow card-body">
    <h1 class="h3 mb-4 text-center text-gray-800">Upload New Files</h1>
    <form action="<?= base_url('/admin/uploadfiles'); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">File Type</label>
            <div class="col-sm-10">
                <select class="custom-select" id="inputGroupSelect01" name="type" required>
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
                <input type="text" class="form-control" id="inputPassword" name="note" placeholder="Please add note..."
                    required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Select File</label>
            <div class="col-sm-10">
                <input type="file" class="" id="imgFiles" name="files" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="submit">Upload Files</button>
    </form>
</div>

<div class="card shadow card-body mt-4">
    <h1 class="h3 mb-4 text-center text-gray-800">All Files</h1>
    <form action="">
        <button type="button" class="btn btn-success" onclick="refresh()">Bersihkan Data</button>
    </form>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="table_files" width="100%" cellspacing="0">
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

function hapusData(kode = null) {

    if (kode != null) {
        if (confirm('Apakah anda yakin untuk menghapus file dengan kode ' + kode + ' ?')) {
            data = {
                kode: kode,
            }
            $.ajax({
                type: "POST",
                url: "<?= base_url('/admin/deletefiles'); ?>",
                dataType: "JSON",
                data: data,
                success: function(data) {
                    confirm('(Code:' + data.status + ') ' + data.msg);
                    showTable();
                },
                error: function(data) {
                    confirm('(Code 404) Cant delete, because file used in other data');
                }
            });
        }
    } else {
        alert('Maaf terjadi kesalahan!');
    }
}

function refresh() {
    showTable();
}

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
                    '" onclick="hapusData(' + data[i].id + ')"> Hapus </button></td>' +
                    '</tr>';
            }
            $('#DataTableFiles').html(html);
            $('#table_files').DataTable();
        }
    });
}
</script>
<?= $this->endSection(); ?>