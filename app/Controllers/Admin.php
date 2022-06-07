<?php

namespace App\Controllers;
use App\Models\DaftarPaketModel;
use App\Models\DaftarGameModel;
use App\Models\UserAccessModel;
use App\Models\PromoCodeModel;
use App\Models\DaftarHargaModel;
use App\Models\DaftarPembayaranModel;
use App\Models\DaftarPesananModel;

class Admin extends BaseController
{   
    public function __construct()
    {
        $this->sendTo = new UserAccessModel();
        $this->promo = new PromoCodeModel();
        $this->paketApiModel = new DaftarPaketModel();
        $this->gameApiModel = new DaftarGameModel();
        $this->harga = new DaftarHargaModel();
        $this->pembayaran = new DaftarPembayaranModel();
        $this->pesanan = new DaftarPesananModel();    
    }

    public function index()
    {
        return redirect()->to(base_url('/admin/dashboard'));
    }

    public function dashboard()
    {   
        $year = date('Y');
        $month = 1;
        $var = '[';
        while($month <= 12){
           $date[0] = strtotime($year.'-'.$month);
           $date[1] = strtotime($year.'-'.($month+1));
           if(!$date[1]){
               $date[1] = strtotime(($year+1).'-1');
           }             
           $var = $var . $this->pesanan->getPesananByRangeTime($date[0], $date[1]);
           if($month <= 11){
            $var = $var . ',';
           }else if($month == 12){
            $var = $var . ']';
           }
           $month++;
        }
        
        $data = [
            'dashboard' => 'active',
            'pesanan_dibayar' => '',
            'semua_pesanan' => '',
            'pesanan_daily' => $this->pesanan->where('order_id >'.strtotime("today"))->where('order_id <'.strtotime("today +1 day"))->findAll(),
            'pesanan_alltime' => $this->pesanan->getPesananAlltime(),
            'dashboard_chart' => $var
        ];
        
        return view('admin/index', $data);
    }

    public function pesanan_dibayar()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => '',
            'pesanan_dibayar' => 'active',
            'semua_pesanan' => '',
            'data_pesanan_dibayar' => $this->pesanan->where('status', 'settlement')->orderby('pay_at', 'ASC')->findAll(),
        ];
        return view('admin/pesanan_dibayar', $data);
    }

    public function pesanan_proses()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => 'active',
            'pesanan_dibayar' => '',
            'semua_pesanan' => '',
            'data_pesanan_dibayar' => $this->pesanan->where('status', 'process')->orderby('updated_at', 'DESC')->findAll(),
        ];
        return view('admin/pesanan_proses', $data);
    }

    public function semua_pesanan()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => '',
            'pesanan_dibayar' => '',
            'semua_pesanan' => 'active',
            'data_pesanan' => $this->pesanan->orderby('order_id', 'DESC')->findAll(),
        ];
        return view('admin/semua_pesanan', $data);
    }

    public function data($kode = false)
    {
        if($kode != false){
            if($kode == 'getpesanandibayar'){
                $data = $this->pesanan->where('status', 'settlement')->orderby('pay_at', 'ASC')->findAll();
            }else if($kode == "getsemuapesanan"){
                $data = $this->pesanan->orderby('updated_at', 'DESC')->findAll();
            }else if($kode == "getpesanandiproses"){
                $data = $this->pesanan->where(['status' => 'process'])->orderby('updated_at', 'DESC')->findAll();
            }
            return json_encode($data);
        }
    }
}
?>