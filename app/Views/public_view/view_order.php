<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php 
if($data == 'Invalid Order ID'){
    $order_id = 'Invalid Order ID';
}else{
    $order_id = $data['order_id'];
}
?>

<div class="card col-sm-8 col-lg-6 col-12 mx-auto my-4">
    <div class="card-header bg-sec-fastgaming text-white">
        Order ID : <?= strtoupper($order_id); ?>
    </div>

    <?php 
if($data == 'Invalid Order ID'){
?>
    <div class="card-body text-center">
        <b class="text-red"> INVALID ORDER ID </b>
        <form action="/order_id/" method="post">
            <div class="input-group mt-3">
                <input type="text" class="form-control" name="search-order_id" placeholder="CARI ORDER ID"
                    aria-label="Masukan Order ID" aria-describedby="button-addon">
            </div>
            <button class="btn bg-sec-fastgaming text-white mt-3 w-100" type="submit">Cari Ulang</button>
        </form>
        <a href="<?= base_url(); ?>">
            <button class="btn bg-fastgaming text-white mt-3 w-100" type="button">Kembali</button>
        </a>
    </div>
    <?php
}else{
?>
    <div class="card-body">
        <?php 
        if($data['owner'] == ''){
        ?>
        <div class="col-12 text-center">
            <h5>Untuk melakukan pengecekan status order,</h5>
            <h5>Silahkan simpan order ID :</h5>
            <div class="col-lg-5 col-sm-7 col-8 mx-auto">
                <div class="input-group input-group-lg mb-3">
                    <input type="text" class="form-control text-center text-red" placeholder="Recipient's username"
                        aria-label="Recipient's username" aria-describedby="copyBtn" id="copyText"
                        value="<?= $order_id; ?>" readonly>
                    <button class="btn bg-sec-fastgaming text-white" type="button" id="copyBtn" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Copy">
                        <i class="far fa-clipboard"></i>
                    </button>
                </div>
            </div>
            <h6>Anda bisa mendaftar <a href="<?= base_url('register'); ?>">disini</a> atau login <a
                    href="<?= base_url('login'); ?>"> disini </a> tanpa harus menyimpan order id.</h6>
        </div>
        <?php 
        } 
        ?>
        <hr>
        <div class="col-12 text-center">
            <b><?= $data['paket']; ?></b>
            <hr>
        </div>
        <div class="row">
            <div class="col-5">
                User ID <p style="float:right;">:</p>
            </div>
            <div class="col-7">
                <?= $data['userid']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                Username <p style="float:right;">:</p>
            </div>
            <div class="col-7">
                <?= $data['username']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                Nominal <p style="float:right;">:</p>
            </div>
            <div class="col-7">
                <?= $data['nominal']; ?>
            </div>
        </div>
        <?php if($data['note'] != ''){ ?>
        <div class="row">
            <div class="col-5">
                Note <p style="float:right;">:</p>
            </div>
            <div class="col-7">
                <?= $data['note']; ?>
            </div>
        </div>
        <?php }
        if($data['promocode'] != ''){
        ?>
        <div class="row">
            <div class="col-5">
                Promocode <p style="float:right;">:</p>
            </div>
            <div class="col-7">
                <?= $data['promocode']; ?>
            </div>
        </div>
        <?php 
        }
        ?>
        <div class="row">
            <div class="col-5">
                Pay Method<p style="float:right;">:</p>
            </div>
            <div class="col-7">
                <?= strtoupper($midtrans->payment_type); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                Total Harga <p style="float:right;">:</p>
            </div>
            <div class="col-7">
                <?= 'Rp '.str_replace(',', '.', number_format($data['total_harga'])); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                Status <p style="float:right;">:</p>
            </div>
            <div class="col-7">
                <p class="badge bg-secondary"><?= ucfirst($data['status']); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                Waktu Order <p style="float:right;">:</p>
            </div>
            <div class="col-7">
                <?= $data['created_at']; ?>
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <!-- <h5>Jika pesanan yang ditampilkan diatas adalah <b class="text-red">BENAR</b> milik anda. Silahkan melakukan
            pembayaran dengan menekan tombol dibawah ini.</h5>
        <button type="button" class="btn bg-sec-fastgaming w-100 mx-auto mt-2 text-white">BAYAR</button>
        <small class="text-red">Kesalahan input data bukan merupakan tanggungjawab kami, silahkan periksa data dengan
            seksama.</small> -->
        <?php 
        // if($midtrans->transaction_status == 'pending'){
               if($midtrans->payment_type == 'bank_transfer'){
                   if(isset($midtrans->permata_va_number)){
                    $bank = 'PERMATA';
                    $va_number = $midtrans->permata_va_number;
                   }else{
                    $bank = strtoupper($midtrans->va_numbers[0]->bank);
                    $va_number = $midtrans->va_numbers[0]->va_number;
                   }
                echo '
                <h5><b>Bayar ke</b><br>
                    Bank : <b class="text-danger">'.$bank.'</b><br>
                    VA Number : <b class="text-danger">'.$va_number.'</b><br>
                    Jumlah yang harus dibayar : <b class="text-danger">Rp '.str_replace(',', '.', number_format($midtrans->gross_amount)).'</b>
                </h5>
                ';
               }else if($midtrans->payment_type == 'echannel'){
                echo '
                <h5><b>Bayar ke</b><br>
                    Company Code : <b class="text-danger">'.$midtrans->biller_code.'</b><br>
                    Payment Code : <b class="text-danger">'.$midtrans->bill_key.'</b><br>
                    Jumlah yang harus dibayar : <b class="text-danger"> Rp '.str_replace(',', '.', number_format($midtrans->gross_amount)).'</b>
                </h5>
                ';
               }
               echo '<h6>(Cek secara berkala untuk dapat melihat update status transaksi)</h6>';
        // }else if($midtrans->transaction_status == 'settlement'){
        //     echo '
        //     <h5>Pesanan <b class="text-success">telah dibayar</b>, admin segera memproses pesanan anda.</h5>
        //     ';
        // }else if($midtrans->transaction_status == 'expire'){
        //     echo '
        //     <h5>Pesanan telah <b class="text-danger">expired</b>, harap memesan ulang dan jangan melanjutkan transaksi ini.</h5>
        //     ';
        // }else{
        //     echo '
        //     <h5>Pesanan <b class="text-danger">Error</b>, harap memesan ulang dan jangan melanjutkan transaksi ini.</h5>
        //     ';
        // }
        ?>
    </div>
    <?php 
}
?>

</div>

<?php 
if($data['owner'] == ''){
?>
<script>
const copyBtn = document.getElementById('copyBtn')
const copyText = document.getElementById('copyText')
copyBtn.onclick = () => {
    copyText.select(); // Selects the text inside the input
    document.execCommand('copy'); // Simply copies the selected text to clipboard 
    Swal.fire({ //displays a pop up with sweetalert
        icon: 'success',
        title: 'Order ID berhasil di Copy!',
        showConfirmButton: true,
        timer: 0
    });
}
</script>
<?php 
} 
?>

<?= $this->endSection(); ?>