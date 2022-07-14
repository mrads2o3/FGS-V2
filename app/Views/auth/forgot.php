<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>
<title>Forgot Password - FastGamingStore</title>
<div class="container">

    <!-- Icon Row -->
    <div class="row justify-content-center">
        <div class="col-md text-center mt-4">
            <img src="<?= base_url(); ?>/img/core/fg.png" alt="" width="auto" height="60" class="d-inline-block">
        </div>
    </div>

    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-4 bg-fastgaming-transparent">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-5 pt-5 pb-2">
                                <div class="text-center">
                                    <h1 class="h4 text-white mb-4">FORGOT PASSWORD</h1>
                                </div>

                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <form action="<?= route_to('forgot') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control form-control-user <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                            name="email" aria-describedby="emailHelp"
                                            placeholder="<?=lang('Auth.email')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.email') ?>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary btn-block mb-4"><?=lang('Auth.sendInstructions')?></button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>