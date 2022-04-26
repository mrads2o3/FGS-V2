<div class="bg-3rd-fastgaming my-2 py-2">
    <div class="demo text-white" id="demo">

    </div>

    <!-- Untuk kamu -->
    <?php 
    if(count($uaccess)){?>
    <div class="row text-center text-white mb-2 mt-2">
        <div class="col-4">
            <hr>
        </div>
        <div class="col-4">
            <h4>UNTUKMU</h4>
        </div>
        <div class="col-4">
            <hr>
        </div>
    </div>
    <div class="row text-white m-auto mb-4">
        <?php $count=0; 
        foreach($uaccess as $b){
            foreach($games as $a){
                if($a['slug'] ==  $b['game_id']){
        ?>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalPaket" data-bs-whatever="<?= $a['slug']; ?>"
            data-bs-whatever2="<?= $a['nama_game']; ?>" class="col-lg-2 col-sm-3 col-4 my-1 mb-2 text-none p-1"
            style="text-decoration:none;">
            <div class="row">
                <div class="col-lg-10 col-12 m-auto d-block">
                    <img src="<?= base_url('/assets/uploaded/image/icon/'.$a['ikon_game']); ?>"
                        class="img-fluid img-logo">
                </div>
                <div class="col-lg-10 col-12 text-center m-auto mt-2 d-block">
                    <span class="text-white nowrap fw-bold">
                        <?= $a['nama_game']; ?></span>
                </div>
            </div>
        </a>
        <?php
                }
            }
            if($count == 5){
                break;
            }else{
                $count++;
            }
        } ?>
    </div>
    <?php 
    } ?>

    <!-- End untuk kamu -->
    <!-- Populer -->
    <?php 
    $arrAs = array();
    $gid='';
    foreach($paccess as $a){
        if($gid != $a['game_id']){
            $gid= $a['game_id'];
            $arrAs += array($a['game_id']=>intval($a['times'])); 
        }else{
            $arrAs[$a['game_id']] += $a['times'];
        }
    }
    arsort($arrAs);

    if(count($arrAs)){
    ?>
    <div class="row text-center text-white mb-2 mt-2">
        <div class="col-4">
            <hr>
        </div>
        <div class="col-4">
            <h4>POPULER</h4>
        </div>
        <div class="col-4">
            <hr>
        </div>
    </div>
    <div class="row text-white m-auto mb-4">
        <?php $count=0; 
        foreach($arrAs as $b=>$b_val){
            foreach($games as $a){
                if($a['slug'] ==  $b){
        ?>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalPaket" data-bs-whatever="<?= $a['slug']; ?>"
            data-bs-whatever2="<?= $a['nama_game']; ?>" class="col-lg-2 col-sm-3 col-4 my-1 mb-2 text-none p-1"
            style="text-decoration:none;">
            <div class="row">
                <div class="col-lg-10 col-12 m-auto d-block">
                    <img src="<?= base_url('/assets/uploaded/image/icon/'.$a['ikon_game']); ?>"
                        class="img-fluid img-logo">
                </div>
                <div class="col-lg-10 col-12 text-center m-auto mt-2 d-block">
                    <span class="text-white nowrap fw-bold">
                        <?= $a['nama_game']; ?></span>
                </div>
            </div>
        </a>
        <?php
                }
            }
            if($count == 5){
                break;
            }else{
                $count++;
            }
        } ?>
        <?php 
    } ?>
    </div>
    <!-- End Populer -->
    <!-- Baru -->
    <div class="row text-center text-white mb-2 mt-2">
        <div class="col-4">
            <hr>
        </div>
        <div class="col-4">
            <h4>BARU</h4>
        </div>
        <div class="col-4">
            <hr>
        </div>
    </div>

    <div class="row text-white m-auto mb-4">
        <?php 
        $count = 1;
        foreach($newgames as $a) : ?>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalPaket" data-bs-whatever="<?= $a['slug']; ?>"
            data-bs-whatever2="<?= $a['nama_game']; ?>" class="col-lg-2 col-sm-3 col-4 my-1 mb-2 text-none p-1"
            style="text-decoration:none;">
            <div class="row">
                <div class="col-lg-10 col-12 m-auto d-block">
                    <img src="<?= base_url('/assets/uploaded/image/icon/'.$a['ikon_game']); ?>"
                        class="img-fluid img-logo">
                </div>
                <div class="col-lg-10 col-12 text-center m-auto mt-2 d-block">
                    <span class="text-white nowrap fw-bold">
                        <?= $a['nama_game']; ?></span>
                </div>
            </div>
        </a>
        <?php 
        if($count == 6){
            break;
        }else{
            $count++;
        }
        endforeach; ?>
    </div>
    <!-- End baru -->
    <!-- Semua -->
    <div class="row text-center text-white mb-2 mt-2">
        <div class="col-4">
            <hr>
        </div>
        <div class="col-4">
            <h4>SEMUA</h4>
        </div>
        <div class="col-4">
            <hr>
        </div>
    </div>
    <div class="row text-white m-auto">
        <?php foreach($games as $a) : ?>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modalPaket" data-bs-whatever="<?= $a['slug']; ?>"
            data-bs-whatever2="<?= $a['nama_game']; ?>" class="col-lg-2 col-sm-3 col-4 my-1 mb-2 text-none p-1"
            style="text-decoration:none;">
            <div class="row">
                <div class="col-lg-10 col-12 m-auto d-block">
                    <img src="<?= base_url('/assets/uploaded/image/icon/'.$a['ikon_game']); ?>"
                        class="img-fluid img-logo">
                </div>
                <div class="col-lg-10 col-12 text-center m-auto mt-2 d-block">
                    <span class="text-white nowrap fw-bold">
                        <?= $a['nama_game']; ?></span>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <!-- End semua -->
</div>