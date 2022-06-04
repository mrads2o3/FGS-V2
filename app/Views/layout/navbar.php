<nav class="navbar navbar-dark bg-sec-fastgaming fixed-top sticky-top pt-1 pb-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=base_url();?>">
            <h3>
                <img src="<?= base_url('img/core/fg.png'); ?>" alt="" width="auto" height="40" class="d-inline-block">
                <!--Fast Gaming Store-->
            </h3>
        </a>

        <!-- 3 Strip -->
        <div class="d-flex">
            <button class="navbar-toggler bg-3rd-fastgaming" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

            <!-- Offcanvas header -->
            <!-- <div class="offcanvas-header bg-dark"> -->
            <div class="container">
                <button type="button" class="btn-close btn-close-white m-2" style="background-color:white;float:right;"
                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                <div class="my-2">
                    <?php if(!logged_in()){ ?>

                    <div class="mb-2">
                        Anda belum login, silahkan
                    </div>
                    <div class="text-center">
                        <a href="<?= base_url('/login'); ?>" class="btn bg-fastgaming text-white">Login</a>
                        atau
                        <a href="<?= base_url('/register'); ?>" class="btn bg-sec-fastgaming text-white">Daftar</a>
                    </div>

                    <?php }else{ ?>
                    <div class="row">
                        <div class="col my-4">
                            <?php $roles = user()->getRoles()[0]['name'] ?>
                            Hallo, <b><?= user()->username.' ('.$roles.')'; ?></b>
                        </div>
                    </div>
                    <?php
                        } ?>
                </div>
            </div>

            <!-- </div> -->

            <!-- Offcanvas body -->
            <div class="offcanvas-body bg-light p-0 ">

                <!-- Accordion -->
                <div class="accordion" id="accordionExample">
                    <?php 
                        if(logged_in()){
                            if($roles == 'admin'){
                    ?>
                    <!-- Menu jika sudah login  -->
                    <div class="accordion-menu">
                        <h2 class="accordion-header" id="headingOne">
                            <a href="<?= base_url('/admin'); ?>">
                                <button class="accordion-menu-button collapsed px-3" type="button">
                                    <i class="fas fa-user-cog mx-3"></i> Panel Admin
                                </button>
                            </a>
                        </h2>
                    </div>
                    <?php } ?>
                    <div class="accordion-menu">
                        <h2 class="accordion-header" id="headingOne">
                            <a href="<?= base_url('/member/transaction_history'); ?>">
                                <button class="accordion-menu-button collapsed px-3" type="button">
                                    <i class="fas fa-history mx-3"></i> History Transaksi
                                </button>
                            </a>
                        </h2>
                    </div>

                    <div class="accordion-menu">
                        <h2 class="accordion-header" id="headingOne">
                            <a href="<?= base_url('/logout'); ?>">
                                <button class="accordion-menu-button collapsed px-3" type="button">
                                    <i class="fas fa-sign-out-alt mx-3"></i> Logout
                                </button>
                            </a>
                        </h2>
                    </div>
                    <!-- End menu -->
                    <?php 
                        }
                    ?>
                    <!-- Kalkulator magic wheel -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed px-1" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fas fa-calculator mx-3"></i> Kalkulator Magic Wheel
                            </button>
                        </h2>

                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <img src="<?= base_url('/img/core/valir-legend.jpg'); ?>" class="mb-2"
                                    style="width:100%;"></img>

                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="mwheel" max="200">
                                    <label for="floatingInput">Magic point saat ini</label>
                                </div>
                                <!-- Hasil text kalkulator magic wheel -->
                                <label>
                                    Kurang
                                </label>
                                <div class="text_accordion magic_point mb-2">: x Magic point</div>

                                <label>
                                    Membutuhkan
                                </label>
                                <div class="text_accordion diamonds_magic mb-2">: x Diamond</div>

                                <label>
                                    Jika Diskon 20%
                                </label>
                                <div class="text_accordion diamonds_magic_disc">: x Diamond</div>

                            </div>
                        </div>
                    </div>

                    <!-- Kalkulator skin zodiac -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed px-1" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="fas fa-calculator mx-3"></i> Kalkulator Skin Zodiac
                            </button>
                        </h2>

                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <img src="<?= base_url('/img/core/zodiacfull.jpg'); ?>" class="mb-2"
                                    style="width:100%;"></img>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="starpoint" max="200">
                                    <label for="floatingInput">Star point saat ini</label>
                                </div>

                                <!-- Text hasil -->
                                <label>Kurang</label>
                                <div class="text_accordion star_point">: x Star point</div>

                                <label>Membutuhkan</label>
                                <div class="text_accordion diamonds_star">: x Diamond</div>

                                <label>Jika Diskon 30%</label>
                                <div class="text_accordion diamonds_star_disc">: x Diamond</div>

                            </div>
                        </div>
                    </div>

                    <!-- Kalkulator WR -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed px-1" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="fas fa-calculator mx-3"></i> Kalkulator Win Rate
                            </button>
                        </h2>

                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <!-- Kalkulator WR dengan presentase WR -->
                                <div class="collapse multi-collapse show" id="multiCollapseExample1">
                                    <div class="form-wr">
                                        <div class=" mb-3">
                                            <label for="floatingInput" id="textfloatingInput">Jumlah
                                                pertandingan</label>
                                            <input type="number" class="form-control" id="jumlah_p" max="">
                                        </div>
                                        <div class=" mb-3" id="form_current_wr">
                                            <label for="floatingInput" id="textfloatingInput">Win rate saat ini.
                                                Contoh:80</label>
                                            <input type="number" class="form-control" id="current_wr" max="100">
                                        </div>
                                        <div class="mb-3" id="form_new_wr">
                                            <label for="floatingInput" id="textfloatingInput">Win rate yang
                                                diinginkan. Contoh:80</label>
                                            <input type="number" class="form-control" id="new_wr" max="100">
                                        </div>
                                        <center><a class="btn btn-outline-danger text-center" style="color:black;"
                                                data-bs-toggle="collapse" href=".multi-collapse" aria-expanded="false"
                                                aria-controls="multiCollapseExample1">Calculator WR Dengan
                                                Lose</a>
                                        </center>

                                    </div>
                                    <button class="btn btn-primary w-100 mt-3" id="calculate" onclick="calculate()"
                                        type="button">Hitung</button>
                                    <div class="text_accordion text-hitungwr text-center mt-3"></div>

                                </div>

                                <!-- Kalkulator WR dengan Lose Streak -->
                                <div class="collapse multi-collapse" id="multiCollapseExample2">
                                    <div class=" mb-3" id="form_jumlah_p_2">
                                        <label for="floatingInput" id="textfloatingInput">Jumlah
                                            pertandingan</label>
                                        <input type="number" class="form-control" id="jumlah_p_2" max="">
                                    </div>

                                    <div class=" mb-3" id="form_current_wr_2">
                                        <label for="floatingInput" id="textfloatingInput">Win rate saat ini.
                                            Contoh:80</label>
                                        <input type="number" class="form-control" id="current_wr_2" max="100">
                                    </div>

                                    <div class=" mb-3" id="form_current_ls">
                                        <label for="floatingInput" id="textfloatingInput">Lose Streak Yang
                                            Diinginkan</label>
                                        <input type="number" class="form-control" id="current_ls" max="100">
                                    </div>

                                    <center><a class="btn btn-outline-danger text-center" style="color:black;"
                                            data-bs-toggle="collapse" href=".multi-collapse" aria-expanded="false"
                                            aria-controls="multiCollapseExample1">Calculator WR Dengan
                                            Presentase</a></center>

                                    <button class="btn btn-primary w-100 mt-3" id="calculate" onclick="calculatels()"
                                        type="button">Hitung</button>
                                    <div class="text_accordion text-hitungwr-ls text-center mt-3"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Search Nick ML 
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                Validate id & server MLBB
                            </button>
                        </h2>

                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="form-wr">
                                    <form id="form_validate" method="post">
                                        <div class="input-group mb-3">
                                            <input type="text" name="id" class="form-control" placeholder="ID"
                                                aria-label="ID">
                                            <span class="input-group-text">(</span>
                                            <input type="text" name="server" class="form-control" placeholder="Server"
                                                aria-label="Server">
                                            <span class="input-group-text">)</span>
                                        </div>
                                        <button type="button" id="cari" class="btn btn-outline-primary w-100">
                                            Cari
                                        </button>
                                    </form>
                                    <div class="test-cari-ml mt-4" id="test-cari-ml" style="color:black;"></div>
                                </div>
                            </div>
                        </div>
                    </div>-->

                    <!-- Search Nick FF 
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                Validate id FF
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="form-wr">
                                    <form id="form_validate_ff" method="post">
                                        <div class="input-group mb-3">
                                            <input type="text" name="id" class="form-control" placeholder="ID"
                                                aria-label="ID">
                                        </div>
                                        <button type="button" id="cari_ff" class="btn btn-outline-primary w-100"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Cari
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>-->

                </div>
            </div>
        </div>
    </div>
</nav>