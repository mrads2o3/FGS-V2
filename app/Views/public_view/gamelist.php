<div class="bg-3rd-fastgaming my-2 py-2">
    <!-- <button onclick="contoh()">ini button</button> -->
    <div class="demo text-white" id="demo">

    </div>
    <div class="row text-center text-white mb-2 mt-2">
        <div class="col-4">
            <hr>
        </div>
        <div class="col-4">
            <h4>ALL GAME</h4>
        </div>
        <div class="col-4">
            <hr>
        </div>
    </div>
    <div class="row text-white m-auto">
        <?php foreach($games as $a) : ?>
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button> -->
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
</div>