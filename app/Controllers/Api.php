<?php 

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DaftarPaketModel;
use App\Models\DaftarGameModel;
use App\Models\UserAccessModel;
use App\Models\PromoCodeModel;
use App\Models\DaftarHargaModel;
use App\Models\DaftarPembayaranModel;
use App\Models\DaftarPesananModel;

use function PHPUnit\Framework\isEmpty;

class Api extends ResourceController
{
    protected $helpers = ['auth'];

    protected $sendTo;
    protected $promo;
    protected $paketApiModel;
    protected $pesanan;

    use ResponseTrait;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->server_key = 'SB-Mid-server-P6N3tvTTqzL2Ou8wb_sroUQO';
        $this->sendTo = new UserAccessModel();
        $this->promo = new PromoCodeModel();
        $this->paketApiModel = new DaftarPaketModel();
        $this->gameApiModel = new DaftarGameModel();
        $this->harga = new DaftarHargaModel();
        $this->pembayaran = new DaftarPembayaranModel();
        $this->pesanan = new DaftarPesananModel();
        $this->auth = service('authentication');
    }

    public function index(){
        $array = [
            'status' => 0,
            'data' => 'What you looking for there?'
        ];
        return $this->respond($array);
    }

    public function getpaket(){
        $gameid = $_GET['game_id'];
        if(isset($gameid)){
            $data = $this->paketApiModel->where(['slug_game'=>$gameid, 'status' => 'enabled'])->findAll();
            if(empty($data)){
                $array = [
                    'status' => 0
                ];
            }else{
                $array = [
                    'status' => 1,
                    'data' => $data
                ];
            }
            return $this->respond($array);
        }else{
            $array = [
                'status' => 0
            ];
            return $this->respond($array);
        }
    }

    public function recordAct(){
        if($this->auth->check()){
            $id = $this->auth->user()->username;
        }else{
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
               $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'IP tidak dikenali';
            $id = md5($ipaddress);
        }

        if(isset($_POST['game_id'])){
            $game_id = $_POST['game_id'];
        }else{
            $game_id = false;
        }

        if(isset($_POST['paket_id'])){
            $paket_id = $_POST['paket_id'];
        }else{
            $paket_id = false;
        }
        
        return $this->sendTo->sendAccess($id, $game_id, $paket_id);
    }

    public function promoCode()
    {
        if($_GET['kode']){
            $r_promo = $this->promo->getPromo($_GET['kode']);
            if(empty($r_promo)){
                $array = [
                    'status' => 0
                ];
            }else{
                $f_promo = $r_promo[0];
                $array = [
                    'status' => 1,
                    'data' => $f_promo
                ];
            }

        }else{
            $array = [
                'status' => 'Maaf anda siapa?'
            ];
        }
        
        return $this->respond($array);
    }
    
    public function verifyorder()
    {
        function is_email_valid($email) {
            if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", trim($email))){
                return TRUE;
            }
            return FALSE;
        }

        if(!empty($_POST['email'])){
            if(!is_email_valid($_POST['email'])){
                return '
                <div class="alert alert-danger text-center" role="alert">
                    <b>Masukan email yang benar atau kosongkan saja.</b>
                </div>';
            }
        }
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

                $paketData = $this->paketApiModel->getPaket(false, $_POST['paket_id']);
                $gameData = $this->gameApiModel->getGames($paketData[0]['slug_game']);
                
                // Penentuan Nickname
                if($paketData[0]['game-nickname'] == 'manual'){
                    $nickname = $_POST['nickname'];
                }else if($paketData[0]['game-nickname'] == 'auto'){
                    if($paketData[0]['slug_game'] == 'mobile_legends' || $paketData[0]['slug_game'] == 'free_fire'){
                        
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
                            echo '<input type="hidden" class="form-control" id="nickname" name="nickname" value="'.$nickname.'">';
                        }
                    }else{
                        $nickname = NULL;
                    }
                }else if($paketData[0]['game-nickname'] == 'disabled'){
                    $nickname = NULL;
                }

                // Penentuan Harga
                $harga = $this->harga->getHarga(false, $_POST['nominal']);
                
                if($_POST['promocode'] != ""){
                    $prom = $this->promo->getPromo($_POST['promocode']);
                    
                    if(!empty($prom)){
                        if($prom[0]['paket'] == '53' || $prom[0]['paket'] == $_POST['paket_id']){ // 53 adalah paket default
                            if($harga[0]['harga_basic'] > $prom[0]['min']){
                                if($prom[0]['disc'] > 1){
                                    $disc = $prom[0]['disc'];
                                }else{
                                    $disc = $harga[0]['harga_basic']*$prom[0]['disc'];
                                    if($disc > $prom[0]['max']){
                                        $disc = $prom[0]['max'];
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
                    $prom = false;
                    $disc = 0;
                }

                if($harga){
                    
                    $hargaBasic = $harga[0]['harga_basic'];
                    $hargaFinal = $hargaBasic - $disc;

                    if($disc > 0){
                        $hargaTotalView = 'Rp <s>'.str_replace(',', '.', number_format($hargaBasic)).'</s> '.str_replace(',', '.', number_format($hargaFinal));
                    }else{
                        $hargaTotalView = 'Rp '.str_replace(',', '.', number_format($hargaFinal));
                    }
                    
                }else{
                    return '
                    <div class="alert alert-danger text-center" role="alert">
                        <b>Harga Error!</b>
                    </div>';
                }

                // Snap
                $time = time();
                
                // if(empty($_POST['email'])){
                //     $email = 'empty@mail.com';
                // }else{
                //     $email = $_POST['email'];
                // }
                
                // $cus_details = array(
                //     'email' => $email
                // );

                // $item_detail = array(
                //     'id' => strtoupper($gameData[0]['kode_game']).$paketData[0]['kode_paket'].$harga[0]['kode_harga'],
                //     'price' => $hargaFinal,
                //     'quantity' => 1,
                //     'name' => strtoupper($gameData[0]['kode_game']).$paketData[0]['kode_paket'].'-'.$harga[0]['nominal']
                // );
                
                // $params = array(
                //     'transaction_details' => array(
                //         'order_id' => $time,
                //         'gross_amount' => $hargaFinal,
                //     ),
                //     'customer_details' => $cus_details,
                //     'item_details' => $item_detail,

                // );
                
                // $data = [
                //     'snapToken' => \Midtrans\Snap::getSnapToken($params)
                // ];
                
                //Jika benar semua pengecekan
                echo '
                <input type="hidden" name="order_id" value="'.$time.'">
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <h4>'.$gameData[0]['nama_game'].' - '.$paketData[0]['nama_paket'].'</h4>
                        <hr>
                    </div>
                </div>
                ';

                if(isset($_POST['server'])){
                    $user_id = $_POST['user_id'].' ('.$_POST['server'].')';
                }else{
                    $user_id = $_POST['user_id'];
                }

                echo '
                <div class="row m-3">
                    <div class="col-5">
                        User ID
                    </div>
                    <div class="col-7">
                        : '.$user_id.'
                    </div>
                </div>
                ';

                if(isset($nickname)){
                    echo '
                    <div class="row m-3">
                        <div class="col-5">
                            Nickname
                        </div>
                        <div class="col-7">
                            : '.$nickname.'
                        </div>
                    </div>
                    ';
                }

                if($harga){
                    echo '
                    <div class="row m-3">
                        <div class="col-5">
                            Nominal
                        </div>
                        <div class="col-7" id="harga">
                            : '.$harga[0]['nominal'].'
                        </div>
                    </div>
                    ';
                }
                
                if($prom){
                    echo '
                    <div class="row m-3">
                        <div class="col-5">
                            Promo Code
                        </div>
                        <div class="col-7">
                            : '.$_POST['promocode'].'
                        </div>
                    </div>
                    ';
                }

                if($hargaTotalView){
                    echo '
                    <div class="row m-3">
                        <div class="col-5">
                            Total 
                        </div>
                        <div class="col-7">
                            : '.$hargaTotalView.'
                        </div>
                    </div>
                    ';
                }

                if(isset($_POST['note'])){
                    echo '
                    <div class="row m-3">
                        <div class="col-5">
                            Catatan 
                        </div>
                        <div class="col-7 note">
                            : '.$_POST['note'].'
                        </div>
                    </div>
                    ';
                }
                // echo '
                // <button class="btn bg-sec-fastgaming text-white w-100" id="pay-button" onclick="snapMidtrans('."'".$data['snapToken']."'".')" type="button" value="Bayar">Bayar</button>
                // ';
                echo '<button class="btn bg-sec-fastgaming text-white w-100" type="submit" value="konfirmasi">KONFIRMASI</button>';

            }else{
                return 'Anda siapa?';
            }
            
    }

    public function UpdateTxStatus()
    {
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);
        if($result){
            $sign_code = strval($result->order_id).strval($result->status_code).strval($result->gross_amount).$this->server_key;
            $sign_code = hash('sha512', $sign_code);
            if($sign_code == $result->signature_key){
                if($result->transaction_status == 'settlement'){
                    $pay_at = $result->transaction_time;
                }else{
                    $pay_at = '';
                }
                $array = [
                    'status' => $result->transaction_status,
                    'pay_at' => $pay_at,
                ];
                $this->pesanan->set($array)->where('order_id', $result->order_id)->update();
            }               
        }else{
            return redirect()->to(base_url());
        }
    }

    public function getDetailOrder($order_id = false)
    {
        if($order_id){
            $query = $this->pesanan->where('order_id', $order_id)->first();
            if($query){
                $array = array(
                    'code' => true,
                    'data' => $query
                );
            }else{
                $array = array(
                    'code' => false,
                    'data' => false
                );
            }
            // d($array);
            return json_encode($array);
        }
    }

    public function updateStatus()
    {
        $result = $_POST;
        if($result){
            $order_id = $result['order_id'];
            $status = $result['status'];
            $datetime = NULL;
            if(isset($result['datetime'])){
                $datetime = $result['datetime'];
            }
            $array = ['', 'finish', 'process', 'cancel'];
            $cek_status = array_search($status, $array);

            if($cek_status){
                $query = $this->pesanan->set([
                    'status' => $status, 'process_time' => $datetime
                ])->where(['order_id'=>$order_id])->update();
                
                if($query){
                    $arr = array(
                        'order_id' => $order_id,
                        'status' => '200'
                    );
                }else{
                    $arr = array(
                        'order_id' => $order_id,
                        'status' => '400'
                    );
                }
            }else{
                $arr = array(
                    'order_id' => $order_id,
                    'status' => '404'
                );
            }
        }else{
            $arr = array(
                'status' => '404'
            );
        }
        return json_encode($arr);
    }
}

?>