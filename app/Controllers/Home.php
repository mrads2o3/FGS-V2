<?php

namespace App\Controllers;

use App\Models\DaftarGameModel;
use App\Models\DaftarPaketModel;
use App\Models\UserAccessModel;
use App\Models\SemuaFilesModel;
use App\Models\DaftarHargaModel;
use App\Models\DaftarPembayaranModel;
use App\Models\DaftarPesananModel;
use App\Models\FilesModel;
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
        $this->files = new FilesModel();
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
            'last_tx' => $this->pesanan->where('status', 'finish')->orderby('updated_at', 'DESC')->findAll(),
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
            // dd($_POST);
            // if($_POST['g-recaptcha-response'] != ""){
            //     //Alternatif jika lagh!
            //     // return 0;

            //     //Jika tidak lagh
            //     // $url = 'http://www.google.com/recaptcha/api/siteverify';
            //     // $data = array('secret' => '6LeUpqkfAAAAAB7piY86GYe0vSBi_iKf_77CjRan', 'response' => $_POST['g-recaptcha-response']);
                
            //     // // use key 'http' even if you send the request to https://...
            //     // $options = array(
            //     //     'http' => array(
            //     //         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            //     //         'method'  => 'POST',
            //     //         'content' => http_build_query($data)
            //     //     )
            //     // );
                
                
            //     // $context  = stream_context_create($options);
            //     // $result = file_get_contents($url, false, $context);
            //     // if ($result === FALSE) {}
            //     // dd($_POST);
            //     // $res = json_decode($result);

            //     // if(!$res->success){
            //     //     return "Google Recaptcha Failed or Required!";
            //     // }
            //     $captcha=$_POST['g-recaptcha-response'];
            //     $secretKey = "6LeUpqkfAAAAAB7piY86GYe0vSBi_iKf_77CjRan";
            //     $ip = $_SERVER['REMOTE_ADDR'];
            //     $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
            //     $responseKeys = json_decode($response,true);
            //     d($responseKeys);
          
            //     dd($_POST);
                
            // }

            if(isset($_POST['g-recaptcha-response']))
            {
                $captcha=$_POST['g-recaptcha-response'];
            }

            $secretKey = "6LeUpqkfAAAAAB7piY86GYe0vSBi_iKf_77CjRan";
            $ip = $_SERVER['REMOTE_ADDR'];
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha).'&remoteip='.$ip;
            $response = file_get_contents($url);
            $responseKeys = json_decode($response,true);

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
            if(isset($_POST['user_id'])){
                if(isset($_POST['server'])){
                    $user_id = $_POST['user_id'].' ('.$_POST['server'].')';
                }else{
                    $user_id = $_POST['user_id'];
                }
            }else{
                $user_id = '';
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
                'email_notif' => $_POST['email'],
                'total_harga' => $hargaFinal, 
                'status' => 'pending'
            ]);
            
            return redirect()->to(base_url('/order_id/'.$order_id));

        }else{
            return redirect()->to(base_url());
        }
    }

    public function cekOrder($order_id = false)
    {
            if($order_id != false){

                $getpesanan = $this->pesanan->getPesanan($order_id);

                if(!empty($getpesanan['owner'])){
                    if(logged_in()){
                        if(user()->id != $getpesanan['owner']){
                            // return redirect()->to(base_url());
                            $getpesanan = "Private order";
                            $cekMidtrans = false;
                            $snap = false;

                            $data = [
                                'data' => $getpesanan,
                                'midtrans' => $cekMidtrans,
                                'snap' => $snap
                            ];
                            
                            return view('public_view/view_order', $data);   
                        }
                    }else{
                        // return redirect()->to(base_url());
                        $getpesanan = "Private order";
                        $cekMidtrans = false;
                        $snap = false;
                        
                        $data = [
                            'data' => $getpesanan,
                            'midtrans' => $cekMidtrans,
                            'snap' => $snap
                        ];
                        
                        return view('public_view/view_order', $data);   
                    } 
                }

                if(empty($getpesanan)){
                    $getpesanan = "Invalid Order ID";
                    $cekMidtrans = false;
                    $snap = false;
                }else{
                    if($getpesanan['status'] == 'pending' && $getpesanan['order_id'] < strtotime("-1 day")){
                        $cekMidtrans = 'expired';
                        $snap = false;
                        $data = [
                            'data' => $getpesanan,
                            'midtrans' => $cekMidtrans,
                            'snap' => $snap
                        ];
                        
                        return view('public_view/view_order', $data);
                    }

                    $getpesanan = $getpesanan;
                    $cekMidtrans = \Midtrans\Transaction::status($order_id);
                    $snap = false;
                    if($cekMidtrans == "404"){
                        $snap = true;
                        if($getpesanan['email_notif'] == '' || $getpesanan['email_notif'] == NULL || !isset($getpesanan['email_notif'])){
                            $email = 'mail@mail.com';
                        }else{
                            $email = $getpesanan['email_notif'];
                        }
                        $cus_details = array(
                            'email' => $email
                        );
        
                        $item_detail = array(
                            'id' => $getpesanan['order_id'],
                            'price' => $getpesanan['total_harga'],
                            'quantity' => 1,
                            'name' => strtoupper($getpesanan['paket'].' - '.$getpesanan['nominal'])
                        );
                        $params = array(
                            'transaction_details' => array(
                                'order_id' => $order_id,
                                'gross_amount' => $getpesanan['total_harga'],
                            ),
                            'customer_details' => $cus_details,
                            'item_details' => $item_detail,
                        );
                        $cekMidtrans = \Midtrans\Snap::getSnapToken($params);
                    }      
                }

                $data = [
                    'data' => $getpesanan,
                    'midtrans' => $cekMidtrans,
                    'snap' => $snap
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