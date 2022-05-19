<?php

namespace App\Controllers;

use App\Models\DaftarGameModel;
use App\Models\DaftarPaketModel;
use App\Models\UserAccessModel;
use App\Models\SemuaFilesModel;
use App\Models\DaftarHargaModel;
use App\Models\DaftarPembayaranModel;
use App\Models\DaftarPesananModel;
use App\Models\PromoCodeModel;

class Home extends BaseController
{
    protected $games;
    protected $paket;
    protected $uaccess;
    protected $files;
    protected $pembayaran;
    protected $pesanan;
    protected $promo;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->games = new DaftarGameModel();
        $this->paket = new DaftarPaketModel();
        $this->uaccess = new UserAccessModel();
        $this->auth = service('authentication');
        $this->files = new SemuaFilesModel();
        $this->harga = new DaftarHargaModel();
        $this->pembayaran = new DaftarPembayaranModel();
        $this->pesanan = new DaftarPesananModel();
        $this->promo = new PromoCodeModel();
    }

    public function index()
    {        
        $user_id = $this->getUserID();
        $data = [
            'games' => $this->games->getGames(),
            'uaccess' => $this->uaccess->getAccess($user_id),
            'paccess' => $this->uaccess->getAccess(),
            'user_id' => $user_id,
            'newgames' => $this->games->where(['status'=>'enabled'])->orderBy('created_at', 'DESC')->findAll(),
            'banner' => $this->files->getFiles('banner_home'),
        ];
        return view('public_view/index', $data);
    }

    public function games_paket($slug_game, $paket_id){

        $data = [
            'paket' => $this->paket->getPaket($slug_game, $paket_id),
            'harga'=> $this->harga->getHarga($paket_id),
            'games' => $this->games->getGames($slug_game),
            // 'pembayaran' => $this->pembayaran->getPembayaran(),
            'slug_game' => $slug_game
        ];
        
        // $countdata = count($data['paket']);
        // if($countdata){
            
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Maaf paket tidak tersedia silahkan hubungi admin!');

        // }else if($countdata){
        //     $location = base_url('/games/'.$slug_game.'/'.$data['paket']['0']['kode_paket']);
        //     header("location:".$location);
        //     exit();
        // }

        return view('public_view/gamepaket', $data);
    }

    public function pOrder()
    {
        if(isset($_POST)){
            // Cek input atau post
            foreach($_POST as $a=>$b){
                if($a != 'promocode' && $a != 'email'){
                    if($b=='' || empty($b) || $b== NULL || $b == 'undefined'){
                        return '
                        <div class="alert alert-danger text-center" role="alert">
                            <b>Semua Field Wajib Diisi</b>
                        </div>';
                    }
                }
            }
            // End Cek
            
            $harga = $this->harga->getHarga(false, $_POST['nominal']);
            $paketData = $this->paket->getPaket(false, $harga[0]['kode_paket']);
            $gameData = $this->games->getGames($paketData[0]['slug_game']);
            
            // Penentuan Nickname
            if($paketData[0]['game-nickname'] == 'manual'){
                $nickname = $_POST['nickname'];
            }else if($paketData[0]['game-nickname'] == 'auto'){
                if($paketData[0]['slug_game'] == 'mobile_legends'){
                    
                    function curl($link, $headers = NULL, $post = NULL, $cookies = NULL){
                        $ch = curl_init();
                        //headers
                        if($headers != NULL){
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        }
                        //post
                        if($post != NULL){
                          curl_setopt($ch, CURLOPT_POST, 1);
                          curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                        }
                        //cookie
                        if($cookies != NULL){
                            $cookie_path = "./cookie/$cookies.txt";
                            curl_setopt($ch, CURLOPT_COOKIEJAR, "$cookie_path");
                            curl_setopt($ch, CURLOPT_COOKIEFILE, "$cookie_path");
                        }
                        //basic
                        curl_setopt($ch, CURLOPT_URL, $link);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                        $response = curl_exec($ch);
                        curl_close($ch);
                        if($cookies != NULL){
                            unset($cookie_path);
                        }
                        return $response;
                    }

                    $target_id = $_POST['user_id'];
                    $target_zone = $_POST['server'];
                    $link = "https://api.duniagames.co.id/api/transaction/v1/top-up/inquiry/store";
                    $headers[] = "accept: application/json, text/plain, */*";
                    $headers[] = "accept-language: id";
                    $headers[] = "ciam-type: FR";
                    $headers[] = "content-type: application/json";
                    $headers[] = "origin: https://duniagames.co.id";
                    $headers[] = "referer: https://duniagames.co.id/";
                    $headers[] = "sec-ch-ua-mobile: ?0";
                    $headers[] = "sec-fetch-dest: empty";
                    $headers[] = "sec-fetch-mode: cors";
                    $headers[] = "sec-fetch-site: same-site";
                    $headers[] = "user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36";

                    $query = '{"productId":1,"itemId":5,"catalogId":60,"paymentId":744,"gameId":"'.$target_id.'","zoneId":"'.$target_zone.'","product_ref":"CMS","product_ref_denom":"REG"}';
                    $result = curl($link, $headers, $query);
                    $res = json_decode($result,true);

                    if($res['status']['code'] != 0){
                        return '
                        <div class="alert alert-danger text-center" role="alert">
                            <b>Akun tidak ditemukan!</b>
                        </div>';
                    }else{
                        $nickname = $res['data']['userNameGame'];
                    }
                }else{
                    $nickname = NULL;
                }
            }else if($paketData[0]['game-nickname'] == 'disabled'){
                $nickname = NULL;
            }

            // Penentuan Harga
            $harga = $this->harga->getHarga(false, $_POST['nominal']);

            if($_POST['promocode'] !== ''){
                $promo = $this->promo->getPromo($_POST['promocode']);
                $pcode = $_POST['promocode'];
                if(!empty($promo)){
                    if($promo[0]['paket'] == '53' || $promo[0]['paket'] == $_POST['paket_id']){ // 53 adalah paket default
                        if($harga[0]['harga_basic'] > $promo[0]['min']){
                            if($promo[0]['disc'] > 1){
                                $disc = $promo[0]['disc'];
                            }else{
                                $disc = $harga[0]['harga_basic']*$promo[0]['disc'];
                                if($disc > $promo[0]['max']){
                                    $disc = $promo[0]['max'];
                                }
                            }
                        }else{
                            $disc = 0;
                        }
                    }else{
                        $disc = 0;
                    }
                }else{
                    $disc = 0;
                }
                
            }else{
                $promo = false;
                $pcode = '';
                $disc = 0;
            }

            if($harga){
                
                $hargaBasic = $harga[0]['harga_basic'];
                $hargaFinal = $hargaBasic - $disc;
                
            }else{
                return '
                <div class="alert alert-danger text-center" role="alert">
                    <b>Harga Error!</b>
                </div>';
            }

            if(isset($_POST['server'])){
                $user_id = $_POST['user_id'].' ('.$_POST['server'].')';
            }else{
                $user_id = $_POST['user_id'];
            }

            if(isset($_POST['note'])){
                $note = $_POST['note'];
            }else{
                $note = '';
            }

            if(logged_in()){
                $owner = user()->id;
            }else{
                $owner = '';
            }
            
            $order_id = $_POST['order_id'];

            $pesanan = $this->pesanan->insert([
                'order_id' => $order_id,
                'owner' => $owner,
                'paket' => $gameData[0]['nama_game'].' - '.$paketData[0]['nama_paket'], 
                'nominal' => $harga[0]['nominal'],
                'userid' => $user_id, 
                'username'=> $nickname,
                'promocode' => $pcode,
                'note' => $note, 
                'total_harga' => $hargaFinal, 
                'status' => 'belum bayar'
            ]);
            
            return redirect()->to(base_url('/order_id/'.$order_id));

        }else{
            return redirect()->to(base_url());
        }
    }

    public function cekOrder($order_id = false)
    {
        if($order_id != false){

            $cekMidtrans = \Midtrans\Transaction::status($order_id);

            $pesanan = $this->pesanan->getPesanan($order_id);
            
            if(empty($pesanan)){
                $pesanan = "Invalid Order ID";
            }else{
                $pesanan = $pesanan[0];
            }

            $data = [
                'data' => $pesanan,
                'midtrans' => $cekMidtrans
            ];
            
            return view('public_view/view_order', $data);

        }else{

            return redirect()->to(base_url());

        }
    }

    public function redirect()
    {
        return redirect()->to(base_url('/order_id/'.$_POST['search-order_id']));
    }

}