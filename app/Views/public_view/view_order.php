<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php
// dd($midtrans); 
if($data == 'Invalid Order ID'){
    $order_id = 'Invalid Order ID';
}else if($data == 'Private order'){
    $order_id = 'Private order';
}else{
    $order_id = $data['order_id'];
}
?>

<div class="card col-sm-8 col-lg-8 col-12 mx-auto my-4">
    <div class="card-header bg-sec-fastgaming text-white">
        Order ID : <b><?= strtoupper($order_id); ?></b>
    </div>

    <?php 
if($order_id == 'Invalid Order ID'){
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
</div>
<?php
}else if($order_id == 'Private order'){
    ?>
<div class="card-body text-center">
    <b class="text-red"> PRIVATE ORDER! </b><br>
    <small>Pesanan ini adalah pesanan <b class="text-red">PRIVATE</b> milik salah satu akun, jika ingin melihatnya
        silahkan login dengan akun tersebut.</small>
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
    if($data['status'] == 'pending'){
        $badge_color = 'bg-secondary';
    }else if($data['status'] == 'settlement'){
        $badge_color = 'bg-success';
    }else if($data['status'] == 'cancel'){
        $badge_color = 'bg-warning';
    }else if($data['status'] == 'failure'){
        $badge_color = 'bg-danger';
    }else if($data['status'] == 'expire'){
        $badge_color = 'bg-dark';
    }else if($data['status'] == 'process'){
        $badge_color = 'bg-info';
    }else if($data['status'] == 'finish'){
        $badge_color = 'bg-primary';
    }
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
                    aria-label="Recipient's username" aria-describedby="copyBtn" id="copyText" value="<?= $order_id; ?>"
                    readonly>
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
            <?php 

                ?>
            <p class="badge <?= $badge_color; ?>"><?= ucfirst($data['status']); ?></p>
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
    <?php 
        if($data['status'] == 'pending'){
        ?>
    <div class="row">
        <div class="col-5">
            Waktu Expired <p style="float:right;">:</p>
        </div>
        <div class="col-7">
            <!-- <?= date('Y-m-d H:i:s', strtotime('+1 days', strtotime($data['created_at']))); ?> -->
            <div id="countdown"></div>
        </div>
    </div>


    <script>
    // Mengatur waktu akhir perhitungan mundur
    var countDownDate = new Date(
        "<?= date('Y-m-d H:i:s', strtotime('+1 days', strtotime($data['created_at']))); ?>").getTime();

    // Memperbarui hitungan mundur setiap 1 detik
    var x = setInterval(function() {

        // Untuk mendapatkan tanggal dan waktu hari ini
        var now = new Date().getTime();

        // Temukan jarak antara sekarang dan tanggal hitung mundur
        var distance = countDownDate - now;

        // Perhitungan waktu untuk hari, jam, menit dan detik
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Keluarkan hasil dalam elemen dengan id = "demo"
        document.getElementById("countdown").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // Jika hitungan mundur selesai, tulis beberapa teks 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
    }, 1000);
    </script>
    <?php } ?>
</div>
<div class="card-footer text-center">
    <?php 
        if($snap){
            echo '<div class="text-danger text-center">PASTIKAN DATA YANG TERTERA ADALAH BENAR.</div>';
            echo '<button class="btn bg-sec-fastgaming text-white w-100" id="pay" type="button" value="BAYAR">BAYAR</button>';
        }else if($midtrans=='expired'){
            echo '<h5>Pesanan telah <b class="text-danger">expired</b>, harap memesan ulang dan jangan melanjutkan transaksi ini.</h5>
            ';
        }else if($midtrans->transaction_status == $data['status']){
            if($data['status'] == 'pending'){
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
            }else if($data['status'] == 'settlement'){
                echo '
                <h5>Selamat!! pesanan anda <b class="text-success">telah dibayar</b>, admin segera memproses pesanan anda.</h5>
                ';
            }else if($data['status'] == 'expire'){
                echo '
                <h5>Pesanan telah <b class="text-danger">expired</b>, harap memesan ulang dan jangan melanjutkan transaksi ini.</h5>
                ';
            }else if($data['status'] == 'failure'){
                echo '
                <h5>Pesanan telah <b class="text-danger">gagal</b>, harap memesan ulang dan jangan melanjutkan transaksi ini.</h5>
                ';
            }else{
                echo '
                <h5>Pesanan <b class="text-danger">Error</b>, harap memesan ulang dan jangan melanjutkan transaksi ini.</h5>
                ';
            }
        }else if($data['status'] == 'process'){
            echo '
            <h5>Pesanan di <b class="text-info">proses</b> oleh admin pada tanggal <b class="text-red">'.$data['process_time'].'</b> paling lambat pengerjaan 1x24 Jam (Sesuai antrian).</h5>
            ';
        }else if($data['status'] == 'finish'){
            echo '
            <h5>Pesanan telah <b class="text-primary">sukses</b>, silahkan kembali lagi dan terimakasih ^^</h5>
            ';
        }else if($data['status'] == 'cancel'){
            echo '
            <h5>Pesanan telah <b class="text-warning">di batalkan</b>, harap menghubungi admin untuk info lebih lanjut.</h5>
            ';
        }else{
            echo '
            <h5>Pesanan <b class="text-danger">Error</b>, harap memesan ulang dan jangan melanjutkan transaksi ini.</h5>
            ';
        }
        ?>
</div>
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
    if($snap){
    ?>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-d6P8m8frZJGFVDPz"></script>
<script>
$(document).ready(function() {
    document.getElementById("pay").onclick = function() {
        SnapMidtrans('<?= $midtrans; ?>')
    };

    function SnapMidtrans(snapToken) {
        // SnapToken acquired from previous step
        snap.pay(snapToken, {
            // Optional
            onSuccess: function(result) {
                /* You may add your own js here, this is just example */
                location.reload();
            },
            // Optional
            onPending: function(result) {
                /* You may add your own js here, this is just example */
                location.reload();
            },
            // Optional
            onError: function(result) {
                /* You may add your own js here, this is just example */
                location.reload();
            }
        });
    };
});
</script>
<?php
    }
} 
?>

<?= $this->endSection(); ?>