<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="row text-white mb-2">
    <h3 class="bg-3rd-fastgaming text-center text-white my-4 p-4"><?= strtoupper($paket[0]['nama_paket']); ?></h3>
</div>

<div class="row text-white">
    <div class="col-lg-5 col-12">
        <div class="card bg-3rd-fastgaming mb-5" style="border-radius:0px 110px 0px 0px;">
            <div class="card-body bg-sec-fastgaming p-0" style="border-radius: 0px 110px 0px 110px;">
                <img src="<?= base_url('/assets/uploaded/image/banner/'.$paket[0]['banner_paket']); ?>"
                    style="border-radius:0px 110px 0px 0px" alt="" width="100%" height="100%">
                <div class="m-4">
                    <h5 class="text-center">DESKRIPSI PAKET</h5>
                    <hr>
                    <p><?= $paket[0]['deskripsi_paket']; ?></p>
                </div>
                <img src="<?= base_url('/img/core/logo.png'); ?>" alt="" width="40px" height="auto" float="left">
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-12 text-black">
        <div class="card card-body px-2 pt-4 pb-2 mb-5" style="border-radius: 30px 0px 0px 0px;">
            <h4>
                <div class="number text-white" style="margin-right: 5px;">1</div> <b>Data Akun</b>
            </h4>

            <?php 
            $id_id = '';
            if($paket[0]['game-id'] == 'enabled'){
                
                if($paket[0]['game-id_placeholder']){
                    $ph_id = $paket[0]['game-id_placeholder'];
                }else{
                    $ph_id = "User ID";
                }

                $type_id = $paket[0]['game-id_type'];

            ?>

            <div class="input-group mb-3">
                <input type="<?= $type_id; ?>" class="form-control" placeholder="<?= $ph_id; ?>" aria-label="User ID"
                    aria-describedby="basic-addon1" id='user_id'>
                <?php 
                $id_id = $id_id.'-user_id';
                if($paket[0]['game-server'] == 'enabled'){
                    $id_id = $id_id.'-server';
                    echo '<span class="input-group-text" id="basic-addon1">(</span>';
                    if($paket[0]['game-server_placeholder']){
                        $ph_server = $paket[0]['game-server_placeholder'];
                    }else{
                        $ph_server = 'Server';
                    }

                    if($paket[0]['game-server_type']){
                        $type_server = $paket[0]['game-server_type'];
                    }else{
                        $type_server = 'text';
                    }

                    if($type_server == 'select'){
                        if($paket[0]['game-server_select-value']){
                        echo '<select class="form-select" id="server">';
                                echo '<option selected>Choose...</option>';

                            $ssv = explode(';', $paket[0]['game-server_select-value']);
                            foreach($ssv as $a){
                                echo '<option value="'.$a.'">'.$a.'</option>';
                            }
                            
                        echo '</select>';
                        }else{
                            echo '<label class="input-group-text" for="inputGroupSelect01">Belum diisi valuenya</label>';
                        }

                        echo '<span class="input-group-text" id="basic-addon1">)</span>';
                    }else{
                ?>
                <input type="<?= $type_server; ?>" class="form-control" placeholder="<?= $ph_server; ?>"
                    aria-label="Server" aria-describedby="basic-addon1" id="server">
                <span class="input-group-text" id="basic-addon1">)</span>
                <?php 
                    }
                }
                ?>
            </div>

            <?php
            }

            if($paket[0]['game-nickname'] == 'manual'){
                $id_id = $id_id.'-nickname';
                if($paket[0]['game-nickname_placeholder']){
                    $ph_uname = $paket[0]['game-nickname_placeholder'];
                }else{
                    $ph_uname = 'Username';
                }
            ?>
            <!-- Username -->
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="<?= $ph_uname; ?>" aria-label="Username"
                    id="nickname" aria-describedby="basic-addon1">
            </div>
            <?php 
            }

            if($paket[0]['petunjuk'] == 'enabled'){
            ?>
            <!-- Petunjuk -->
            <div class="input-group mb-3">
                <button class="btn bg-sec-fastgaming text-white" data-bs-toggle="modal" data-bs-target="#petunjuk"
                    type="button">
                    <i class="fas fa-question-circle" aria-hidden="true"></i>
                    <b>Petunjuk</b>
                </button>
            </div>

            <!-- Modal petunjuk -->
            <div class="modal fade" id="petunjuk" tabindex="-1" aria-labelledby="petunjukLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Petunjuk - <?= $games[0]['nama_game']; ?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="<?= base_url('/assets/uploaded/image/icon/'.$games[0]['cari_id']); ?>"
                                width="100%" height="auto" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End modal -->

            <?php 
            }
            
            if($paket[0]['note']== 'enabled'){
                $id_id = $id_id.'-note';
                if($paket[0]['note_placeholder']){
                    $ph_note = $paket[0]['note_placeholder'];
                }else{
                    $ph_note = 'Contoh : Tolong kirim jam 3';
                }
            ?>
            <!-- Catatan -->
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Catatan : </label>
                <input type="text" class="form-control" placeholder="<?= $ph_note; ?>" aria-label="Username"
                    aria-describedby="basic-addon1" id="note">
            </div>
            <?php 
            }
            ?>

        </div>
        <div class="card card-body px-2 pt-4 pb-2 mb-5" style="border-radius: 30px 0px 0px 0px;">
            <h4>
                <div class="number text-white" style="margin-right: 5px;">2</div> <b>Nominal</b>
            </h4>
            <div class="row mx-1">
                <?php 
                foreach($harga as $a){
                    if($a['template'] == "divider"){
                        echo "<div class='col-".$a['ukuran']." col-lg-".$a['ukuran']." my-2'><h5>".$a['nominal']."</h5></div>";
                    }else{   
                ?>
                <div class="col-<?=$a['ukuran']?> col-lg-6 mb-2 p-1">
                    <input class="btn-check" type="radio" name="nominal"
                        id="harga-<?= $a['nominal'].'-'.$a['harga_basic']; ?>" value="<?= $a['kode_harga']; ?>"
                        required="">
                    <label class="btn btn-outline-primary w-100"
                        for="harga-<?= $a['nominal'].'-'.$a['harga_basic']; ?>">
                        <div class="d-flex">
                            <?php
                                    if($a['c_matauang']){
                                        $img = "/assets/uploaded/image/currency/".$a['c_matauang'];
                                    }else{
                                        $img = "/assets/uploaded/image/currency/".$games[0]['ikon_matauang'];
                                    }
                                    if($a['template'] == 'curency-text'){
                            ?>
                            <div style="padding-top:0px;"><img src="<?= $img; ?>" style="height:20px;width:20px;"></div>
                            <div class="ml-auto txt-black mx-2" id="harga-nominal"><?= $a['nominal']; ?>
                            </div>
                            <?php
                                    }else if($a['template'] == 'text-curency'){
                            ?>
                            <div class="ml-auto txt-black mx-2" id="harga-nominal"><?= $a['nominal']; ?>
                            </div>
                            <div style="padding-top:0px;"><img src="<?= $img; ?>" style="height:20px;width:20px;"></div>
                            <?php    
                                    }else if($a['template'] == 'text'){
                            ?>
                            <div class="ml-auto txt-black mx-2" id="harga-nominal"><?= $a['nominal']; ?>
                            </div>
                            <?php
                                    }
                            ?>
                        </div>
                    </label>
                </div>
                <?php 
                    }
                } 
                ?>
            </div>
        </div>
        <div class="card card-body px-2 pt-4 pb-2 mb-5" style="border-radius: 30px 0px 0px 0px;">
            <h4>
                <div class="number text-white" style="margin-right: 5px;">3</div> <b>Pembayaran</b>
            </h4>
            <div class="row mx-1">
                <?php 
                foreach($pembayaran as $a){
                ?>
                <div class="col-12 col-md-6 mb-2 px-1">
                    <input class="btn-check" type="radio" name="pembayaran" id="bayar-pakai-<?= $a['id']; ?>"
                        value="<?= $a['id']; ?>" disabled="true" required>
                    <label class="btn btn-outline-primary w-100" for="bayar-pakai-<?= $a['id']; ?>">
                        <div class="d-flex">
                            <div class="p-0"><img src="/assets/uploaded/image/pembayaran/<?= $a['ikon_pembayaran']; ?>"
                                    style="height: 40px;width:80px;"></div>
                            <div class="ml-auto p-0 txt-black d-block m-auto" id="text-bayar-<?= $a['id']; ?>">Rp. 0,-
                            </div>
                        </div>
                    </label>
                </div>
                <?php
                }
                ?>
            </div>
            <hr>
            <div class="text-danger text-center">
                <b>
                    Pastikan data yang diinput adalah benar.
                </b>
            </div>
            <hr>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Promocode" aria-label="Promocode" id="promo"
                    aria-describedby="basic-addon1">
                <button class="btn bg-sec-fastgaming text-white w-50" data-bs-toggle="modal"
                    data-bs-target="#modalPesan" data-bs-whatever="<?= $paket[0]['kode_paket'] ?>" id="beli"
                    value="beli"><i class="fas fa-cart-arrow-down mx-1"></i>BELI</button>
            </div>
            <div class="textDetailKode" id="textDetailKode">

            </div>
        </div>
    </div>
</div>

<!-- ModalPesan -->
<div class="modal fade" id="modalPesan" tabindex="-1" aria-labelledby="modalPesanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPesanLabel">Konfirmasi Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="mbody-pesan">
                ...
            </div>
        </div>
    </div>
</div>
<!-- EndModal -->

<script>
const radioButtons = document.querySelectorAll('input[name="nominal"]');
for (const radioButton of radioButtons) {
    radioButton.addEventListener('change', changePrice);
}

function changePrice(e) {

    if (this.checked) {
        const radioButtons2 = document.querySelectorAll('input[name="pembayaran"]');
        for (const radioButton2 of radioButtons2) {
            <?php 
            foreach($pembayaran as $a){
            ?>
            h_awal = this.id.split("-");
            fee = <?=$a['fee'];?>;

            if (fee > 1) {
                harga = parseInt(h_awal[2]) + fee;
            } else {
                harga = parseInt(h_awal[2]) + (parseInt(h_awal[2]) * fee);
            }

            selector = document.querySelector('#text-bayar-<?= $a['id']; ?>');
            document.querySelector("#bayar-pakai-<?=$a['id']?>").disabled = false;
            selector.innerText = harga.toLocaleString('id', {
                style: 'currency',
                currency: 'IDR'
            });
            <?php 
            } 
            ?>
        }
    }
}
<?php 
$id_id = explode("-", $id_id); 
echo 'document.getElementById("beli").onclick = function() {';
   
    foreach ($id_id as $a){
        if(!empty($a)){
            echo 'var '.$a.' = document.getElementById("'.$a.'").value;';
        }
    }
?>

$(document).ready(function() {
    var nominal = $("input[name='nominal']:checked").val();

    var pembayaran = $("input[name='pembayaran']:checked").val();

});

var promocode = document.getElementById("promo").value;
<?php
echo '}';
?>


// ------------ Pesanan ----------------
var exampleModal = document.getElementById('modalPesan')
exampleModal.addEventListener('show.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes

    var paket_id = button.getAttribute('data-bs-whatever');
    var nominal = $("input[name='nominal']:checked").val();
    var pembayaran = $("input[name='pembayaran']:checked").val();
    var promocode = document.getElementById("promo").value;

    x = document.getElementById('mbody-pesan');

    //change to loading 1st
    x.innerHTML =
        '<center><img src="<?= base_url('/assets/core/image/loading.gif'); ?>" alt="" style="width:auto;height:100px;"></center>';

    // POST
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            x.innerHTML = this.responseText;
        }
    }
    data = '';
    <?php 
    foreach($id_id as $a){
        if($a !== ''){
    ?>
    data = data + '<?= $a.'='; ?>' + <?= $a.'.value'; ?> + '&';
    <?php
        }
    }
    ?>
    data = data + 'nominal=' + nominal + '&pembayaran=' + pembayaran + '&paket_id=' + paket_id + '&promocode=' +
        promocode;
    req.open('POST', 'http://localhost:8080/api/verifyorder');
    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    req.send(data);
});
</script>

<script src="<?= base_url('/js/detail_paket.js'); ?>"></script>

<?= $this->endSection(); ?>