<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>
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
                                    <h1 class="h4 text-white mb-4">LOGIN</h1>
                                </div>

                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <form action="<?= route_to('login') ?>" method="post" class="user">
                                    <?= csrf_field() ?>

                                    <?php if ($config->validFields === ['email']): ?>
                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control form-control-user <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
                                            name="login" aria-describedby="emailHelp"
                                            placeholder="<?=lang('Auth.email')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control form-control-user <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
                                            name="login" aria-describedby="emailHelp"
                                            placeholder="<?=lang('Auth.emailOrUsername')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-user <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>"
                                            name="password" placeholder="<?=lang('Auth.password')?>">
                                    </div>

                                    <?php if ($config->allowRemembering): ?>
                                    <div class="form-check">
                                        <label class="form-check-label text-white mb-3">
                                            <input type="checkbox" name="remember" class="form-check-input"
                                                <?php if(old('remember')) : ?> checked <?php endif ?>>
                                            <?=lang('Auth.rememberMe')?>
                                        </label>
                                    </div>
                                    <?php endif; ?>

                                    <button type="submit"
                                        class="btn btn-primary btn-user btn-block"><?=lang('Auth.loginAction')?></button>

                                </form>

                                <?php if ($config->allowRegistration) : ?>
                                <p class="text-center mt-2"><a class="small text-white"
                                        href="<?= route_to('register') ?>"><?=lang('Auth.needAnAccount')?></a></p>
                                <?php endif; ?>
                                <?php if ($config->activeResetter): ?>
                                <p class="text-center"><a class="small text-white"
                                        href="<?= route_to('forgot') ?>"><?=lang('Auth.forgotYourPassword')?></a></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<?= $this->endSection(); ?>