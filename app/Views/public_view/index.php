<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <marquee class="col mb-0 text-white last-tx_box mt-2">Transaksi terakhir yang berhasil : Tes Tes</marquee>
</div>

<div class="row">
    <div class="col-lg-8 col-xs-8 mx-auto d-block my-3">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="<?= base_url('/img/core/contoh-banner.jpg'); ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="<?= base_url('/img/core/contoh-banner.jpg'); ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="<?= base_url('/img/core/contoh-banner.jpg'); ?>" class="d-block w-100" alt="...">
                </div>
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
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div> -->
        </div>
    </div>
</div>

<script src="<?= base_url('/js/public-index.js'); ?>"></script>

<?= $this->endSection(); ?>