<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Promo</h1>
<div class="card shadow card-body">
    <button type="button" class="btn btn-primary mb-4" id="btn_tambah">Tambah Promo</button>
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
                    <td>Expired</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody id="DataPromo">

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="ModalPromo" tabindex="-1" role="dialog" aria-labelledby="example1ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example1ModalLabel"><span id="OrderIDModalPromo"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="formType" id="formType" hidden required>
                <input type="text" name="id_promo" id="id_promo" hidden required>

                <div class="inp mb-2">
                    <span>Kode Promo</span>
                    <input type="text" class="form-control w-100" name="code" id="code" required>
                </div>

                <div class="inp mb-2">
                    <span>Untuk Paket</span>
                    <select class="custom-select" name="paket" id="paket">
                        <option value="99999">-- Semua Paket --</option>
                        <?php foreach($inPaket as $a){ ?>
                        <option value="<?= $a->kode_paket; ?>"><?= $a->nama_paket; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="inp mb-2">
                    <span>Diskon</span>
                    <input type="number" class="form-control w-100" name="disc" id="disc" required>
                </div>

                <div class="inp mb-2">
                    <span>Maksimal Diskon</span>
                    <input type="number" class="form-control w-100" name="max" id="max" required>
                </div>

                <div class="inp mb-2">
                    <span>Minimal Beli</span>
                    <input type="number" class="form-control w-100" name="min" id="min" required>
                </div>

                <div class="inp mb-2">
                    <span>Tgl. Kadaluarsa</span>
                    <input type="datetime-local" class="form-control w-100" name="expired" id="expired" required>
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
        $('#OrderIDModalPromo').html('Tambah promo baru');
        $('#formType').val('insert');
        $('#id_promo').val('insert');
        $('#code').val('');
        $('#disc').val('');
        $('#max').val('');
        $('#min').val('');
        $('#expired').val('');
        $("#paket").prop('selectedIndex', 0);

        $("#ModalPromo").modal();
    });

    $("#SaveProcessButton").click(function() {

        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/promoprocess'); ?>",
            dataType: "JSON",
            data: {
                formtype: $("#formType").val(),
                id_promo: $("#id_promo").val(),
                code: $("#code").val(),
                disc: $("#disc").val(),
                max: $("#max").val(),
                min: $("#min").val(),
                expired: $("#expired").val(),
                paket: $("#paket").val(),
            },
            success: function(data) {
                confirm(data.message);
                if (data.message == 'Berhasil') {
                    $("#ModalPromo").modal('hide');
                    showTable();
                }
            },
            error: function(data) {
                confirm('Error!');
            }
        });

    });

});

function modalEdit(id = false) {
    if (id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('admin/data/getdetailpromo')?>?id=' + id,
            async: true,
            dataType: 'json',
            success: function(data) {
                $('#OrderIDModalPromo').html('Edit ' + data.code);
                $('#formType').val('update');

                // $('#inUrutan').val(data.urutan);
                // $('#status').val(data.status).change();
                $('#id_promo').val(data.id);
                $('#code').val(data.code);
                $('#disc').val(data.disc);
                $('#max').val(data.max);
                $('#min').val(data.min);
                $('#expired').val(data.expired);
                $('#paket').val(data.paket).change();

                $("#ModalPromo").modal();
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
                url: '<?php echo base_url('admin/promoprocess')?>?del_id=' + id,
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
                    disc = data[i].disc + ' IDR';
                }

                if (data[i].nama_paket == "Default Promocode") {
                    nama_paket = "Semua Paket";
                } else {
                    nama_paket = data[i].nama_paket;
                }

                html += '<tr>' +
                    '<td>' + no + '</td>' +
                    '<td> <b class="text-danger">' + data[i].code + '</b></td>' +
                    '<td>' + disc + '</td>' +
                    '<td>' + data[i].min + ' IDR</td>' +
                    '<td>' + data[i].max + ' IDR</td>' +
                    '<td>' + nama_paket + '</td>' +
                    '<td>' + data[i].expired + '</td>' +
                    '<td><button class="btn btn-success w-100" onclick="modalEdit(' + "'" + data[i].id +
                    "'" + ')">Edit</button><button class="btn btn-danger w-100" onclick="hapusData(' + "'" +
                    data[i]
                    .id + "'" + ')">Hapus</button></td>' +
                    '</tr>';
                no++;
            }
            // $('#DataPromo').html(html);
            // $('#table-promo').DataTable();
            $('#table-promo').DataTable().destroy();
            $('#table-promo').find('#DataPromo').html('');
            $('#table-promo').find('#DataPromo').append(html);
            $('#table-promo').DataTable().draw();
        }

    });
}
</script>
<?= $this->endSection(); ?>