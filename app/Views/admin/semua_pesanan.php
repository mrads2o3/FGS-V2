<?= $this->extend('admin/template'); ?>

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Semua Pesanan</h1>
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel semua pesanan</h6>
    </div>
    <div class="card-body text-gray-800">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="table-pesanan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Paket</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_pesanan as $a){ 
                            if($a['status'] == 'pending'){
                                $badge_color = 'bg-secondary';
                            }else if($a['status'] == 'settlement'){
                                $badge_color = 'bg-success';
                            }else if($a['status'] == 'cancel'){
                                $badge_color = 'bg-warning';
                            }else if($a['status'] == 'failure'){
                                $badge_color = 'bg-danger';
                            }else if($a['status'] == 'expire'){
                                $badge_color = 'bg-dark';
                            }else if($a['status'] == 'process'){
                                $badge_color = 'bg-info';
                            }else if($a['status'] == 'finish'){
                                $badge_color = 'bg-primary';
                            }
                        ?>
                    <tr>
                        <td><a href="#"><i class="fas fa-search"></i></a></td>
                        <td><?= $a['order_id']; ?></td>
                        <td><?= $a['paket']; ?></td>
                        <td><?= $a['nominal']; ?></td>
                        <td>
                            <p class="badge text-white <?= $badge_color; ?>"><?= ucfirst($a['status']); ?></p>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('datatables'); ?>
<script>
$(document).ready(function() {
    $('#table-pesanan').DataTable();
});
</script>
<?= $this->endSection(); ?>