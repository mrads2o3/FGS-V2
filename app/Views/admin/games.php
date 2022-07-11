<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Games</h1>
<div class="card shadow card-body">
    <button type="button" class="btn btn-primary mb-4" id="btn_tambah">Tambah Game
        Baru</button>
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
            <tbody id="DataGames">

            </tbody>
        </table>
    </div>
</div>

<!-- Modal Games-->
<div class="modal fade" id="ModalGames" tabindex="-1" role="dialog" aria-labelledby="example1ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example1ModalLabel"><span id="OrderIDModalGames"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url(); ?>"></form>
            <div class="modal-body">
                <input type="text" name="formType" id="formType" hidden required>
                <div class="inp mb-2">
                    <span>Urutan</span>
                    <input type="number" class="form-control w-100" name="urutan" id="inUrutan" required>
                </div>
                <div class="inp mb-2">
                    <span>Kode Game</span>
                    <input type="text" class="form-control w-100" name="kode_game" id="inKode_game" required>
                    <input type="text" class="form-control w-100" name="old_kode_game" id="old_inKode_game" required
                        hidden>
                </div>
                <div class="inp mb-2">
                    <span>Nama Game</span>
                    <input type="text" class="form-control w-100" name="nama_game" id="inNama_game" required>
                </div>
                <div class="inp mb-2">
                    <span>Matauang</span>
                    <select class="custom-select" name="ikon_matauang" id="ikon_matauang" required>
                        <?php foreach($matauang as $a){?>
                        <option value="<?= $a['nama_files']; ?>"><?= $a['catatan']; ?>
                        </option>
                        <?php }?>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Ikon Game</span>
                    <select class="custom-select" name="ikon_game" id="ikon_game" required>
                        <?php foreach($ikon_game as $a){?>
                        <option value="<?= $a['nama_files']; ?>"><?= $a['catatan']; ?>
                        </option>
                        <?php }?>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Cari ID</span>
                    <select class="custom-select" name="cari_id" id="cari_id" required>
                        <?php foreach($cari_id as $a){?>
                        <option value="<?= $a['nama_files']; ?>"><?= $a['catatan']; ?>
                        </option>
                        <?php }?>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Status</span>
                    <select class="custom-select" name="status" id="status" required>
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="SaveProcessButton">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('datatables'); ?>
<script>
$(document).ready(function() {
    showTable();

    $("#btn_tambah").click(function() {
        $('#OrderIDModalGames').html('Tambah game baru');
        $('#formType').val('insert');
        $('#inUrutan').val('');
        $('#inKode_game').val('');
        $('#old_inKode_game').val('');
        $('#inNama_game').val('');
        $('#ikon_matauang').prop('selectedIndex', 0);
        $('#ikon_game').prop('selectedIndex', 0);
        $('#cari_id').prop('selectedIndex', 0);
        $('#status').prop('selectedIndex', 0);

        $("#ModalGames").modal();
    });

    $("#SaveProcessButton").click(function() {

        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/gameprocess'); ?>",
            dataType: "JSON",
            data: {
                formtype: $("#formType").val(),
                urutan: $("#inUrutan").val(),
                kode_game: $("#inKode_game").val(),
                old_kode_game: $("#old_inKode_game").val(),
                nama_game: $("#inNama_game").val(),
                ikon_matauang: $("#ikon_matauang").val(),
                ikon_game: $("#ikon_game").val(),
                cari_id: $("#cari_id").val(),
                status: $("#status").val(),
            },
            success: function(data) {
                confirm(data.message);
                if (data.message == 'Berhasil') {
                    $("#ModalGames").modal('hide');
                    showTable();
                }
            },
        });

    });



});

function modalEdit(id = false) {
    if (id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('admin/data/getdetailgames')?>?id=' + id,
            async: true,
            dataType: 'json',
            success: function(data) {
                $('#OrderIDModalGames').html('Edit ' + data.nama_game);
                $('#formType').val('update');
                $('#inUrutan').val(data.urutan);
                $('#inKode_game').val(data.kode_game);
                $('#old_inKode_game').val(data.kode_game);
                $('#inNama_game').val(data.nama_game);
                $('#ikon_matauang').val(data.ikon_matauang).change();
                $('#ikon_game').val(data.ikon_game).change();
                $('#cari_id').val(data.cari_id).change();
                $('#status').val(data.status).change();
                $("#ModalGames").modal();
            }

        });
    } else {
        confirm('Someting wrong i can feel it!');
    }
}

function hapusData(id = false) {
    if (id) {
        if (confirm('Apakah anda yakin ingin menghapus ' + id + ' ?')) {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url('admin/gameprocess')?>?del_id=' + id,
                async: true,
                dataType: 'json',
                success: function(data) {
                    confirm(data.message);
                    if (data.message == 'Data berhasil dihapus!') {
                        showTable();
                    }
                }

            });
        }
    } else {
        confirm('Something wrong i can feel it!');
    }
}

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
                    '<td><button type="button" class="btn btn-success w-100" onclick="modalEdit(' + "'" +
                    data[i].kode_game + "'" +
                    ')">Edit</button><button type="button" class="btn btn-danger w-100" onclick="hapusData(' +
                    "'" + data[i].kode_game + "'" + ')">Hapus</button></td>' +
                    '</tr>';
            }
            // $('#DataKategori').html(html);
            // $('#table-games').DataTable();
            $('#table-games').DataTable().destroy();
            $('#table-games').find('#DataGames').html('');
            $('#table-games').find('#DataGames').append(html);
            $('#table-games').DataTable().draw();
        }

    });
}
</script>
<?= $this->endSection(); ?>