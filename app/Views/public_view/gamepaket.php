<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="<?= base_url('/js/validation_recaptcha.js'); ?>" async defer></script>
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
        <form action="/processorder" method="post" id="form-input" onsubmit="return submitUserForm();">
            <div class="card card-body px-2 pt-4 pb-2 mb-5" style="border-radius: 30px 30px 0px 0px;">
                <h4 class="text-center">
                    <b>PROMO CODE</b>
                </h4>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Promocode" id="promo" name="promocode">
                    <label for="floatingInput">Promo Code</label>
                </div>

                <div class="textDetailKode p-0 m-0" id="textDetailKode">
                </div>
            </div>

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
                    <input type="<?= $type_id; ?>" class="form-control" placeholder="<?= $ph_id; ?>"
                        aria-label="User ID" aria-describedby="basic-addon1" id='user_id' name="user_id">
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
                        echo '<select class="form-select" id="server" name="server">';
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
                        aria-label="Server" aria-describedby="basic-addon1" id="server" name="server">
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
                        id="nickname" name="nickname" aria-describedby="basic-addon1">
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
            <div class="card card-body px-2 pt-4 pb-2 mb-4" style="border-radius: 30px 0px 0px 0px;">
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
                        <?php if($a['harga_promo'] != 0){ ?>
                        <span class="position-absolute translate-middle badge rounded-pill bg-danger"
                            style="margin-left:35px;">
                            Promo!
                        </span>
                        <?php } ?>
                        <input class="btn-check" type="radio" name="nominal" id="harga-<?= $a['nominal'];?>"
                            value="<?= $a['kode_harga']; ?>" required="">

                        <label class="btn btn-outline-primary w-100 h-100 mx-auto" for="harga-<?= $a['nominal'];?>">
                            <div class="d-flex">
                                <?php
                                    if($a['c_matauang']){
                                        $img = "/assets/uploaded/image/currency/".$a['c_matauang'];
                                    }else{
                                        $img = "/assets/uploaded/image/currency/".$games[0]['ikon_matauang'];
                                    }
                                    if($a['template'] == 'curency-text'){
                            ?>
                                <div style="padding-top:0px;" class="my-auto"><img src="<?= $img; ?>"
                                        style="height:30px;width:30px;">
                                </div>
                                <div class="ml-auto txt-black mx-auto" id="harga-nominal">
                                    <b>
                                        <?= $a['nominal']; ?>
                                    </b>
                                    <br>
                                    <small>
                                        <i>
                                            <?php 
                                                if($a['harga_promo'] != 0){
                                                    echo '<s>Rp. '.number_format($a['harga_promo'],0,',','.').'</s> Rp.'.number_format($a['harga_basic'], 0, ',', '.');
                                                }else{
                                                    echo 'Rp. '.number_format($a['harga_basic'], 0, ',', '.');
                                                } 
                                            ?>
                                        </i>
                                    </small>
                                </div>
                                <?php
                                    }else if($a['template'] == 'text-curency'){
                            ?>
                                <div class="ml-auto txt-black w-100" id="harga-nominal">
                                    <b>
                                        <?= $a['nominal']; ?>
                                    </b>
                                    <br>
                                    <small>
                                        <i>
                                            <?php 
                                                if($a['harga_promo'] != 0){
                                                    echo '<s>Rp. '.number_format($a['harga_promo'],0,',','.').'</s> Rp.'.number_format($a['harga_basic'], 0, ',', '.');
                                                }else{
                                                    echo 'Rp. '.number_format($a['harga_basic'], 0, ',', '.');
                                                } 
                                            ?>
                                        </i>
                                    </small>
                                </div>
                                <div style="padding-top:0px;" class="my-auto"><img src="<?= $img; ?>"
                                        style="height:30px;width:30px;">
                                </div>
                                <?php    
                                    }else if($a['template'] == 'text'){
                            ?>
                                <div class="ml-auto txt-black w-100" id="harga-nominal">
                                    <b>
                                        <?= $a['nominal']; ?>
                                    </b>
                                    <br>
                                    <small>
                                        <i>
                                            <?php 
                                                if($a['harga_promo'] != 0){
                                                    echo '<s>Rp. '.number_format($a['harga_promo'],0,',','.').'</s> Rp.'.number_format($a['harga_basic'], 0, ',', '.');
                                                }else{
                                                    echo 'Rp. '.number_format($a['harga_basic'], 0, ',', '.');
                                                } 
                                            ?>
                                        </i>
                                    </small>
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
            <div class="card card-body px-2 pt-4 pb-2 mb-5" style="border-radius: 0px 0px 30px 30px;">
                <h4 class="text-center">
                    <b>E-Mail</b>
                </h4>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" placeholder="E-Mail" id="email" name="email">
                    <label for="floatingInput">E-Mail</label>
                </div>

                <?php $id_id = $id_id.'-email';?>

                <div class="row mx-1">

                    <center>
                        <div class="g-recaptcha" id="recaptcha" data-sitekey="6LeUpqkfAAAAAFVeVGcUssiZPy8TbFPTdWqU1gWq"
                            data-callback="verifyCaptcha">
                        </div>
                        <div id="g-recaptcha-error"></div>
                        <?php //$id_id = "-recaptcha" ?>
                    </center>

                    <b class="text-red text-center mt-2">PASTIKAN DATA YANG DI INPUT ADALAH BENAR!</b>

                    <button class="btn bg-sec-fastgaming text-white w-100 mb-3" type="button" data-bs-toggle="modal"
                        data-bs-target="#modalPesan" data-bs-whatever="<?= $paket[0]['kode_paket'] ?>" id="beli"
                        value="beli"><i class="fas fa-cart-arrow-down mx-1"></i>BELI</button>
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

        </form>
    </div>
</div>
<script>
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
    var email = document.getElementById("email").value;
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
    ?> data = data + '<?= $a.'='; ?>' + <?= $a.'.value'; ?> + '&';
    <?php
        }
    }
    ?> data = data + 'nominal=' + nominal + '&paket_id=' + paket_id + '&email=' + email + '&promocode=' +
        promocode;
    req.open('POST', '<?= base_url('/api/verifyorder'); ?>');
    req.setRequestHeader('Content-type',
        'application/x-www-form-urlencoded');
    req.send(data);
});

document.getElementById("promo").onchange = function() {
    var x = document.getElementById("promo");
    x.value = x.value.toUpperCase();

    // Instantiate an new XHR Object
    const xhr = new XMLHttpRequest();

    // Open an obejct (GET/POST, PATH,
    // ASYN-TRUE/FALSE)

    xhr.open("GET", "<?= base_url('api/promocode?kode='); ?>" + x.value, true);

    // When response is ready
    xhr.onload = function() {
        if (this.status >= 200 && this.status < 400) {
            let list = document.getElementById("textDetailKode");
            if (x.value !== '') {
                list.innerHTML = 'Loading...';
            } else {
                list.innerHTML = '';
            }

            // Changing string data into JSON Object
            obj = JSON.parse(this.responseText);

            //Check
            if (obj.status == 0) {
                list.innerHTML =
                    '<div class="alert alert-danger" role="alert"><i class="fa fa-times" aria-hidden="true"></i> Kode promo <b>' +
                    x.value + '</b> Tidak valid!</div>';
            } else {
                splitText = window.location.href.split('/');
                sliceText = splitText.slice(-1);

                if (obj.data.paket == 99999 || obj.data.paket == sliceText) {
                    const timeNow = new Date();
                    // alert(timeNow);
                    const expired = new Date(obj.data.expired);
                    // alert(expired);
                    if (timeNow < expired) {
                        if (obj.data.disc <= 1) {
                            diskon = (obj.data.disc * 100) + '%';
                            text = '<i class="fa fa-check" aria-hidden="true"></i> Diskon Sebesar ' + diskon +
                                '<br> <i class="fa fa-check" aria-hidden="true"></i> Minimal beli ' + obj.data
                                .min + ' IDR' +
                                '<br> <i class="fa fa-check" aria-hidden="true"></i> Maksimal ' + obj.data.max +
                                ' IDR';
                        } else {
                            diskon = obj.data.disc + ' IDR';
                            text = '<i class="fa fa-check" aria-hidden="true"></i> Diskon Sebesar ' + diskon +
                                '<br> <i class="fa fa-check" aria-hidden="true"></i> Minimal beli ' + obj.data
                                .min + ' IDR';
                        }

                        list.innerHTML =
                            '<div class="alert alert-success" role="alert"><i class="fa fa-check" aria-hidden="true"></i> Kode promo : <b>' +
                            x.value + '</b> Valid. <br>' + text + '</div>';
                    } else {
                        list.innerHTML =
                            '<div class="alert alert-danger" role="alert"><i class="fa fa-times" aria-hidden="true"></i> Kode promo <b>' +
                            x.value + '</b> Sudah <b>Expired!</b></div>';
                    }
                } else if (obj.data.paket != sliceText) {
                    list.innerHTML =
                        '<div class="alert alert-danger" role="alert"><i class="fa fa-times" aria-hidden="true"></i> Kode promo <b>' +
                        x.value + '</b> Tidak tersedia untuk paket ini!</div>';
                } else {

                }
            }
        } else {
            list.innerHTML = 'Gagal Mengambil Data';
        }
    }
    xhr.send();
};
</script>

<?= $this->endSection(); ?>