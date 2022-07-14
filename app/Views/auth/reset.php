<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>
<title>Reset Password - FastGamingStore</title>
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
                                    <h1 class="h4 text-white mb-4">RESET YOUR PASSWORD</h1>
                                </div>

                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <form action="<?= route_to('reset-password') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control form-control-user <?php if(session('errors.token')) : ?>is-invalid<?php endif ?>"
                                            name="token" aria-describedby="token" placeholder="<?=lang('Auth.token')?>"
                                            value="<?= old('token', $token ?? '') ?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.token') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control form-control-user <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                            name="email" aria-describedby="emailHelp"
                                            placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.email') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-user <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>"
                                            name="password" aria-describedby="emailHelp" placeholder="Password Baru">
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-user <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                                            name="pass_confirm" aria-describedby="emailHelp"
                                            placeholder="Ulangi Password Baru">
                                        <div class="invalid-feedback">
                                            <?= session('errors.pass_confirm') ?>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary btn-block mb-4"><?=lang('Auth.resetPassword')?></button>

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