<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Paket</h1>
<div class="card shadow card-body">
    <button type="button" class="btn btn-primary mb-4" id="btn_tambah">Tambah Paket Baru</button>
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

<!-- Modal Paket-->
<div class="modal fade" id="ModalPaket" tabindex="-1" role="dialog" aria-labelledby="example1ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example1ModalLabel"><span id="OrderIDModalPaket"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="formType" id="formType" hidden required>
                <input type="text" name="id_paket" id="id_paket" hidden required>
                <div class="inp mb-2">
                    <span>Game</span>
                    <select class="custom-select" name="slug_game" id="slug_game" required>
                        <?php 
                        foreach($game as $a){
                        ?>
                        <option value="<?= $a['slug']; ?>"><?= $a['nama_game']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Urutan</span>
                    <input type="number" class="form-control w-100" name="urutan" id="urutan" required>
                </div>
                <div class="inp mb-2">
                    <span>Nama Paket</span>
                    <input type="text" class="form-control w-100" name="nama_paket" id="nama_paket" required>
                </div>
                <div class="inp mb-2">
                    <span>Deskripsi Paket</span>
                    <textarea class="form-control" name="deskripsi_paket" id="deskripsi_paket" rows="5"></textarea>
                </div>
                <div class="inp mb-2">
                    <span>Banner Paket</span>
                    <select class="custom-select" name="banner_paket" id="banner_paket" required>
                        <?php 
                        foreach($banner_paket as $a){
                        ?>
                        <option value="<?= $a['nama_files']; ?>"><?= $a['catatan']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Ikon Paket</span>
                    <select class="custom-select" name="ikon_paket" id="ikon_paket" required>
                        <?php 
                        foreach($ikon_paket as $a){
                        ?>
                        <option value="<?= $a['nama_files']; ?>"><?= $a['catatan']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <hr>
                <h5 class="text-center">ID / Username</h5>
                <div class="inp mb-2">
                    <select class="custom-select" name="game-id" id="game-id" required>
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Type</span>
                    <select class="custom-select" name="game-id_type" id="game-id_type" required>
                        <option value="text">text</option>
                        <option value="number">number</option>
                        <option value="email">email</option>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Placeholder</span>
                    <input type="text" class="form-control w-100" name="game-id_placeholder" id="game-id_placeholder"
                        required>
                </div>

                <hr>
                <h5 class="text-center">Server</h5>
                <div class="inp mb-2">
                    <select class="custom-select" name="game-server" id="game-server" required>
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Type</span>
                    <select class="custom-select" name="game-server_type" id="game-server_type" required>
                        <option value="text">text</option>
                        <option value="number">number</option>
                        <option value="password">password</option>
                        <option value="select">Select</option>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Server Select Value</span>
                    <input type="text" class="form-control w-100" name="game-server_select-value"
                        id="game-server_select-value" placeholder="Contoh : ASIA;Amerika;Eropa" required>
                </div>
                <div class="inp mb-2">
                    <span>Placeholder</span>
                    <input type="text" class="form-control w-100" name="game-server_placeholder"
                        id="game-server_placeholder" required>
                </div>
                <hr>

                <h5 class="text-center">Nickname</h5>
                <div class="inp mb-2">
                    <select class="custom-select" name="game-nickname" id="game-nickname" required>
                        <option value="manual">Manual</option>
                        <option value="auto">Auto</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Placeholder</span>
                    <input type="text" class="form-control w-100" name="game-nickname_placeholder"
                        id="game-nickname_placeholder" required>
                </div>
                <hr>

                <h5 class="text-center">Note</h5>
                <div class="inp mb-2">
                    <select class="custom-select" name="game-note" id="game-note" required>
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Placeholder</span>
                    <input type="text" class="form-control w-100" name="game-note_placeholder"
                        id="game-note_placeholder" required>
                </div>
                <hr>

                <div class="inp mb-2">
                    <span>Custom Subtitle 1</span>
                    <input type="text" class="form-control w-100" name="sub1" id="sub1" required>
                </div>
                <div class="inp mb-2">
                    <span>Custom Subtitle 2</span>
                    <input type="text" class="form-control w-100" name="sub2" id="sub2" required>
                </div>
                <div class="inp mb-2">
                    <span>Custom Subtitle 3</span>
                    <input type="text" class="form-control w-100" name="sub3" id="sub3" required>
                </div>
                <div class="inp mb-2">
                    <span>Petunjuk</span>
                    <select class="custom-select" name="petunjuk" id="petunjuk" required>
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Status Paket</span>
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
        $('#OrderIDModalPaket').html('Tambah paket baru');
        $('#formType').val('insert');
        $('#id_paket').val('insert');
        $("#slug_game").prop('selectedIndex', 0);
        $("#urutan").val('');
        $("#nama_paket").val('');
        $("#deskripsi_paket").val('');
        $("#banner_paket").prop('selectedIndex', 0);
        $("#ikon_paket").prop('selectedIndex', 0);
        $("#game-id").prop('selectedIndex', 0);
        $("#game-id_type").prop('selectedIndex', 0);
        $("#game-id_placeholder").val('');
        $("#game-server").prop('selectedIndex', 0);
        $("#game-server_type").prop('selectedIndex', 0);
        $("#game-server_select-value").val('');
        $("#game-server_placeholder").val('');
        $("#game-note").prop('selectedIndex', 0);
        $("#game-note_placeholder").val('');
        $("#game-nickname").prop('selectedIndex', 0);
        $("#game-nickname_placeholder").val('');
        $("#sub1").val('');
        $("#sub2").val('');
        $("#sub3").val('');
        $("#petunjuk").prop('selectedIndex', 0);
        $("#status").prop('selectedIndex', 0);

        $("#ModalPaket").modal();
    });

    $("#SaveProcessButton").click(function() {

        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/paketprocess'); ?>",
            dataType: "JSON",
            data: {
                formtype: $("#formType").val(),
                id_paket: $("#id_paket").val(),
                slug_game: $("#slug_game").val(),
                urutan: $("#urutan").val(),
                nama_paket: $("#nama_paket").val(),
                deskripsi_paket: $("#deskripsi_paket").val(),
                banner_paket: $("#banner_paket").val(),
                ikon_paket: $("#ikon_paket").val(),
                game_id: $("#game-id").val(),
                game_idType: $("#game-id_type").val(),
                game_idPlaceholder: $("#game-id_placeholder").val(),
                game_server: $("#game-server").val(),
                game_serverType: $("#game-server_type").val(),
                game_serverSelectValue: $("#game-server_select-value").val(),
                game_serverPlaceholder: $("#game-server_placeholder").val(),
                game_note: $("#game-note").val(),
                game_notePlaceholder: $("#game-note_placeholder").val(),
                game_nickname: $("#game-nickname").val(),
                game_nicknamePlaceholder: $("#game-nickname_placeholder").val(),
                sub1: $("#sub1").val(),
                sub2: $("#sub2").val(),
                sub3: $("#sub3").val(),
                petunjuk: $("#petunjuk").val(),
                status: $("#status").val(),
            },
            success: function(data) {
                confirm(data.message);
                if (data.message == 'Berhasil') {
                    $("#ModalPaket").modal('hide');
                    showTable();
                }
            },
            error: function(data) {
                confirm(data.message);
            }
        });

    });
});

function br2nl(str, replaceMode) {

    var replaceStr = (replaceMode) ? "\n" : '';
    // Includes <br>, <BR>, <br />, </br>
    return str.replace(/<\s*\/?br\s*[\/]?>/gi, replaceStr);
}

function modalEdit(id = false) {
    if (id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('admin/data/getdetailpaket')?>?id=' + id,
            async: true,
            dataType: 'json',
            success: function(data) {
                $('#OrderIDModalPaket').html('Edit ' + data.nama_paket);
                $('#formType').val('update');

                // $('#inUrutan').val(data.urutan);
                // $('#status').val(data.status).change();

                $('#id_paket').val(data.kode_paket);
                $("#slug_game").val(data.slug_game).change();
                $("#urutan").val(data.urutan);
                $("#nama_paket").val(data.nama_paket);
                $("#deskripsi_paket").val(br2nl(data.deskripsi_paket, '\n'));
                $("#banner_paket").val(data.banner_paket).change();
                $("#ikon_paket").val(data.ikon_paket).change();
                $("#game-id").val(data['game-id']).change();
                $("#game-id_type").val(data['game-id_type']).change();
                $("#game-id_placeholder").val(data['game-id_placeholder']);
                $("#game-server").val(data['game-server']).change();
                $("#game-server_type").val(data['game-server_type']).change();
                $("#game-server_select-value").val(data['game-server_select-value']);
                $("#game-server_placeholder").val(data['game-server_placeholder']);
                $("#game-note").val(data.note).change();
                $("#game-note_placeholder").val(data.note_placeholder);
                $("#game-nickname").val(data['game-nickname']).change();
                $("#game-nickname_placeholder").val(data['game-nickname_placeholder']);
                $("#sub1").val(data.sub1);
                $("#sub2").val(data.sub2);
                $("#sub3").val(data.sub3);
                $("#petunjuk").val(data.petunjuk).change();
                $("#status").val(data.status).change();


                $("#ModalPaket").modal();
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
                url: '<?php echo base_url('admin/paketprocess')?>?del_id=' + id,
                async: true,
                dataType: 'json',
                success: function(data) {
                    confirm(data.message);
                    if (data.message == 'Data berhasil dihapus!') {
                        showTable();
                    }
                },
                error: function(data) {
                    confirm('Data gagal dihapus!');
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
                    '<td><button class="btn btn-success w-100" onclick="modalEdit(' + "'" + data[i]
                    .kode_paket + "'" +
                    ')">Edit</button><button class="btn btn-danger w-100" onclick="hapusData(' + "'" +
                    data[i].kode_paket + "')" + '">Hapus</button></td>' +
                    '</tr>';
            }
            // $('#DataPaket').html(html);
            // $('#table-paket').DataTable();
            $('#table-paket').DataTable().destroy();
            $('#table-paket').find('#DataPaket').html('');
            $('#table-paket').find('#DataPaket').append(html);
            $('#table-paket').DataTable().draw();
        }

    });
}
</script>
<?= $this->endSection(); ?>