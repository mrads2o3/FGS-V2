<?php

namespace App\Controllers;

class Payment extends BaseController
{
    public function index()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-P6N3tvTTqzL2Ou8wb_sroUQO';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => time(),
                'gross_amount' => 110000,
            )
        );
        
        $data = [
            'status' => '\Midtrans\Transaction::approve(1635996087)',
            'snapToken' => \Midtrans\Snap::getSnapToken($params)
        ];

        return view('payment/pay', $data);
    }
}
?>