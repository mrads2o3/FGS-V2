<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="<?= base_url('/css/toastr.css'); ?>">
<script src="<?= base_url('/js/toastr.js'); ?>"></script>

<?php 
    function replaceText($string, $digit){
        $split = str_split($string);
        $jumString = strlen($string);

        $replace_with = '*';
        $replace_start = $jumString - $digit;

        if($replace_start < 0){
            return $string;
        }

        $str_fmt = '';
        for($i=0;$i<$jumString;$i++){
            if($i < $replace_start){
                $str_fmt .= $split[$i];
            }else{
                $str_fmt .= $replace_with;
            }
        }

        return $str_fmt;
    }
    
    $lasttx_text = "";
    $count = 0;
    foreach($last_tx as $a){
        $lasttx_text .= "ORDER ID : ".replaceText($a['order_id'], 3).", Paket : ".$a['paket'].", Nominal : ".$a['nominal'].", Selesai pada ".$a['updated_at'];
        if($count <= 10){
            $lasttx_text .= " | ";
        }else{
            break;
        }
        $count++;
    }
?>

<div class="row">
    <marquee class="col mb-0 text-white last-tx_box mt-2"><?= $lasttx_text; ?></marquee>
</div>

<div class="row">
    <div class="col-lg-8 col-xs-8 mx-auto d-block my-3">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php $count=0; foreach($banner as $a){?>
                <div class="carousel-item <?php if($count==0){echo 'active';}?>" data-bs-interval="5000">
                    <img src="<?= base_url('/assets/uploaded/image/banner/'.$a['nama_files']); ?>" class="d-block w-100"
                        alt="...">
                </div>
                <?php $count++;} ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <form action="/order_id/" method="post">
            <div class="input-group mt-3">
                <input type="text" class="form-control text-center" name="search-order_id" placeholder="CARI ORDER ID"
                    aria-label="Masukan Order ID" aria-describedby="button-addon" required>
                <button class="btn btn-outline-info" type="submit" id="button-addon">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>


<div class="row">
    <?= $this->include('public_view/gamelist'); ?>
</div>

<!-- Modal Paket -->
<div class="modal fade" id="modalPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-black m-auto" id="list_paket">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "5000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
toastr.info('Welcome To Fastgaming Store!');

var exampleModal = document.getElementById('modalPaket')
exampleModal.addEventListener('show.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var game_id = button.getAttribute('data-bs-whatever')
    var paket_id = '0';
    var nama_game = button.getAttribute('data-bs-whatever2')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = exampleModal.querySelector('.modal-title')
    //   var modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = 'Paket - ' + nama_game;
    //   modalBodyInput.value = recipient

    x = document.getElementById('list_paket');

    //change to loading 1st
    x.innerHTML =
        '<center><img src="assets/core/image/loading.gif" alt="" style="width:auto;height:100px;"></center>';

    var request = new XMLHttpRequest();
    request.open('GET', '<?= base_url('api/getpaket?game_id='); ?>' + game_id, true);
    request.onload = function() {
        // Begin accessing JSON data here
        var result = JSON.parse(this.response);
        if (request.status >= 200 && request.status < 400) {

            let text = "";
            result.data.forEach(a => {
                text += '<a href="<?= base_url('paket'); ?>/' + game_id + '/' + a.kode_paket +
                    '" class="col-lg-3 col-4 my-1 mb-2 text-none p-1" style="text-decoration:none;"><div class="row"><div class="col-lg-10 col-12 m-auto d-block"><img src="/assets/uploaded/image/icon/' +
                    a.ikon_paket +
                    '" class="img-fluid img-logo"></div><div class="col-lg-10 col-12 text-center m-auto mt-2 d-block"><span class="text-black fw-bold">' +
                    a.nama_paket + '</span></div></div>';
            });

            //then change to result from api
            x.innerHTML = text;

        } else {
            x.innerHTML = 'Load paket error... silakan hubungi admin';
        }
    }
    request.send();

    var req = new XMLHttpRequest();
    req.open('POST', '<?= base_url('api/recordAct'); ?>');
    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    req.send('game_id=' + game_id + '&paket_id=' + paket_id);
})
</script>
<?= $this->endSection(); ?>