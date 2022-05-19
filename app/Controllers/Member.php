<?php

namespace App\Controllers;
use App\Models\DaftarPesananModel;

class Member extends BaseController
{
    protected $pesanan;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->auth = service('authentication');
        $this->pesanan = new DaftarPesananModel();
    }

    public function index()
    {
        echo 'ini halaman khusus <b> member </b> ya gaes';
    }

    public function historytx()
    {
        if(logged_in()){
            
            $pesanan = $this->pesanan->getHistoryTx();
            $data = array(
                'data' => $pesanan
            );
            
            return view('member/history', $data);
        }else{
            return redirect()->to(base_url());
        }
    }
}
?>