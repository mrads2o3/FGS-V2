<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card col-sm-8 col-lg-8 col-12 mx-auto mt-4">
    <div class="card-header bg-sec-fastgaming text-white">
        Transaction History : <?= user()->username; ?>
    </div>
    <div class="card-body">
        <table id="table-history_user" class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                foreach($data as $a){
                    ?>
                <tr>
                    <td>
                        <a href="<?= base_url('/order_id/'.$a['order_id']); ?>">
                            <button class="btn bg-sec-fastgaming text-white" type="button"><i
                                    class="fas fa-search"></i></button>
                        </a>
                    </td>
                    <td>
                        <?= '<b>'.$a['order_id'].'</b><br><small>'.$a['paket'].' - '.$a['nominal'].'</small>'; ?>
                    </td>
                    <td>
                        <?php 
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
                        <p class="badge <?= $badge_color; ?>"><?= ucfirst($a['status']); ?></p>
                    </td>
                </tr>
                <?php
                } 
                    ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#table-history_user').DataTable();
});
</script>
<?= $this->endSection(); ?>