<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php d($data); ?>
<div class="card col-sm-8 col-lg-6 col-12 mx-auto mt-4">
    <div class="card-header bg-sec-fastgaming text-white">
        Transaction History : <?= user()->username; ?>
    </div>
    <div class="card-body">
        <div class="accordion" id="accordionExample">
            <?php foreach($data as $a){ ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="<?= $a['order_id']; ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse<?= $a['order_id']; ?>" aria-expanded="false"
                        aria-controls="collapse<?= $a['order_id']; ?>">
                        #<?= $a['order_id']; ?> <b class="badge bg-secondary mx-auto"><?= ucfirst($a['status']); ?></b>
                    </button>
                </h2>
                <div id="collapse<?= $a['order_id']; ?>" class="accordion-collapse collapse"
                    aria-labelledby="<?= $a['order_id']; ?>" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <b><?= $data[0]['created_at']; ?></b>
                        <hr>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>