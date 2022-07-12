<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Nominal</h1>
<div class="card shadow card-body">
    <button type="button" class="btn btn-primary mb-4" id="btn_tambah">Tambah Nominal</button>
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

<div class="modal fade" id="ModalNominal" tabindex="-1" role="dialog" aria-labelledby="example1ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example1ModalLabel"><span id="OrderIDModalNominal"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="formType" id="formType" hidden required>
                <input type="text" name="kode_harga" id="kode_harga" hidden required>
                <div class="inp mb-2">
                    <span>Game - Paket</span>
                    <select class="custom-select" name="kode_paket" id="kode_paket" required>
                        <?php 
                        foreach($inPaket as $a){
                        ?>
                        <option value="<?= $a->kode_paket; ?>"><?= $a->nama_game.' - '.$a->nama_paket; ?></option>
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
                    <span>Nominal / Item</span>
                    <input type="text" class="form-control w-100" name="nominal" id="nominal" required>
                </div>
                <div class="inp mb-2">
                    <span>Harga Awal (Sebelum Diskon)</span>
                    <input type="number" class="form-control w-100" name="harga_promo" id="harga_promo" required>
                    <span class="text-danger">* Kosongkan jika tidak diskon</span>
                </div>
                <div class="inp mb-2">
                    <span>Harga Jual (Sesudah Diskon)</span>
                    <input type="number" class="form-control w-100" name="harga_basic" id="harga_basic" required>
                </div>
                <div class="inp mb-2">
                    <span>Ukuran</span>
                    <select class="custom-select" name="ukuran" id="ukuran">
                        <option value="6" selected>6 (1 Baris 2 item)</option>
                        <option value="3">3 (1 Baris 4 item)</option>
                        <option value="4">4 (1 Baris 3 item)</option>
                        <option value="12">12 (1 Baris 1 item)</option>
                    </select>
                    <span class="text-danger">* Ukuran hanya berpengaruh pada perangkat mobile</span>
                </div>
                <div class="inp mb-2">
                    <span>Template</span>
                    <select class="custom-select" name="template" id="template">
                        <option value="curency-text" selected>Matauang - Nominal/Item</option>
                        <option value="text-curency">Nominal/Item - Matauang</option>
                        <option value="text">Nominal/Item</option>
                        <option value="divider">-- Pembatas antar nominal --</option>
                    </select>
                </div>
                <div class="inp mb-2">
                    <span>Matauang</span>
                    <select class="custom-select" name="c_matauang" id="c_matauang">
                        <option value="" selected>Default (Sama dengan Game)</option>
                        <?php foreach($c_matauang as $a){ ?>
                        <option value="<?= $a['nama_files']; ?>"><?= $a['catatan']; ?></option>
                        <?php } ?>
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
        $('#OrderIDModalNominal').html('Tambah nominal baru');
        $('#formType').val('insert');
        $('#kode_harga').val('insert');
        $('#urutan').val('');
        $('#nominal').val('');
        $('#harga_promo').val('');
        $('#harga_basic').val('');
        $("#ukuran").prop('selectedIndex', 0);
        $("#kode_paket").prop('selectedIndex', 0);
        $("#template").prop('selectedIndex', 0);
        $("#c_matauang").prop('selectedIndex', 0);

        $("#ModalNominal").modal();
    });

    $("#SaveProcessButton").click(function() {

        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/nominalprocess'); ?>",
            dataType: "JSON",
            data: {
                formtype: $("#formType").val(),
                kode_harga: $("#kode_harga").val(),
                urutan: $("#urutan").val(),
                nominal: $("#nominal").val(),
                harga_promo: $("#harga_promo").val(),
                harga_basic: $("#harga_basic").val(),
                ukuran: $("#ukuran").val(),
                kode_paket: $("#kode_paket").val(),
                template: $("#template").val(),
                c_matauang: $("#c_matauang").val(),
            },
            success: function(data) {
                confirm(data.message);
                if (data.message == 'Berhasil') {
                    $("#ModalNominal").modal('hide');
                    showTable();
                } else if (data.message == 'Berhasil tambah data') {
                    old_urutan = parseInt($("#urutan").val());
                    new_urutan = old_urutan + 1;
                    $("#urutan").val(new_urutan);
                    showTable();
                }
            },
            error: function(data) {
                confirm(data.message);
            }
        });

    });
});

function modalEdit(id = false) {
    if (id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('admin/data/getdetailnominal')?>?id=' + id,
            async: true,
            dataType: 'json',
            success: function(data) {
                $('#OrderIDModalNominal').html('Edit ' + data.kode_harga);
                $('#formType').val('update');

                // $('#inUrutan').val(data.urutan);
                // $('#status').val(data.status).change();

                $('#kode_harga').val(data.kode_harga);
                $('#urutan').val(data.urutan);
                $('#nominal').val(data.nominal);
                $('#harga_promo').val(data.harga_promo);
                $('#harga_basic').val(data.harga_basic);
                $("#ukuran").val(data.ukuran).change();;
                $("#kode_paket").val(data.kode_paket).change();;
                $("#template").val(data.template).change();;
                $("#c_matauang").val(data.c_matauang).change();;

                $("#ModalNominal").modal();
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
                url: '<?php echo base_url('admin/nominalprocess')?>?del_id=' + id,
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
                    '<td><button class="btn btn-success w-100" onclick="modalEdit(' + "'" + data[i]
                    .kode_harga + "')" +
                    '">Edit</button><button class="btn btn-danger w-100" onclick="hapusData(' + "'" +
                    data[i].kode_harga + "'" + ')">Hapus</button></td>' +
                    '</tr>';
            }
            // $('#DataNominal').html(html);
            // $('#table-nominal').DataTable();
            $('#table-nominal').DataTable().destroy();
            $('#table-nominal').find('#DataNominal').html('');
            $('#table-nominal').find('#DataNominal').append(html);
            $('#table-nominal').DataTable().draw();
        }

    });
}
</script>
<?= $this->endSection(); ?>