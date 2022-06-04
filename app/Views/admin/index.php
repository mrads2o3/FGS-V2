<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pesanan (Daily)</small>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($pesanan_daily); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-3x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pemasukan (Daily)</small>
                        </div>
                        <?php 
                        $pemasukan_daily = 0;
                        foreach($pesanan_daily as $a){
                            if($a['status'] == 'finish'){
                                $pemasukan_daily = $pemasukan_daily + $a['total_harga'];
                            }
                        }
                        ?>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= 'Rp '.str_replace(',', '.', number_format($pemasukan_daily)); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-3x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pesanan (Alltime)</small>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($pesanan_alltime); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-3x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pemasukan (Alltime)</small>
                        </div>
                        <?php 
                        $pemasukan_alltime = 0;
                        foreach($pesanan_alltime as $a){
                            if($a['status'] == 'finish'){
                                $pemasukan_alltime = $pemasukan_alltime + $a['total_harga'];
                            }
                        }
                        ?>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= 'Rp '.str_replace(',', '.', number_format($pemasukan_alltime)); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-3x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Area Chart -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Chart Pemasukan</h6>
    </div>
    <div class="card-body">
        <h2 class="text-center text-gray-800">Tahun : <?= date('Y'); ?></h2>
        <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
        </div>
    </div>
</div>
<script src="<?= base_url('/vendor/chart.js/Chart.min.js'); ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('/js/chart-area.js'); ?>"></script>

<script>
chartArea("myAreaChart", <?= $dashboard_chart; ?>);
</script>

<?= $this->endSection(); ?>