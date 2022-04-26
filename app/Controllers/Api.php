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

class Api extends ResourceController
{
    protected $helpers = ['auth'];

    protected $sendTo;
    protected $promo;
    protected $paketApiModel;

    use ResponseTrait;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->sendTo = new UserAccessModel();
        $this->promo = new PromoCodeModel();
        $this->paketApiModel = new DaftarPaketModel();
        $this->gameApiModel = new DaftarGameModel();
        $this->harga = new DaftarHargaModel();
        $this->pembayaran = new DaftarPembayaranModel();
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
        $this->auth = service('authentication');

            if(isset($_POST)){
                
                // Cek input atau post
                $post = count($_POST);
                foreach($_POST as $a){
                    if($a=='' || empty($a) || $a== NULL || $a == 'undefined'){
                        return '
                        <div class="alert alert-danger text-center" role="alert">
                            <b>Semua Field Wajib Diisi</b>
                        </div>';
                    }
                    $post--;
                    if($post == 1){
                        break;
                    }
                }
                // End Cek

                $paketData = $this->paketApiModel->getPaket(false, $_POST['paket_id']);
                $gameData = $this->gameApiModel->getGames($paketData[0]['slug_game']);
                
                // Penentuan Nickname
                if($paketData[0]['game-nickname'] == 'manual'){
                    $nickname = $_POST['nickname'];
                }else{
                    if($paketData[0]['slug_game'] == 'mobile_legends' || $paketData[0]['slug_game'] == 'free_fire'){
                        $nickname = 'Oke';
                        $id = $_POST['user_id'];
                        $ch = curl_init();
                        if(isset($_POST['server'])){
                            $zone = $_POST['server'];
                            curl_setopt($ch, CURLOPT_URL, "https://api-xyz.com/trueid/mobilelegends/?id=".$id."&zone=".$zone."&token=NguyenThuWan");
                        }else{
                            curl_setopt($ch, CURLOPT_URL, "https://api-xyz.com/trueid/freefire/?id=".$id."&token=NguyenThuWan");
                        }
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
                
                        $result = curl_exec($ch);
                        curl_close($ch);
                        $res = json_decode($result,true);
                        if(isset($res['error_msg'])){
                            return '
                            <div class="alert alert-danger text-center" role="alert">
                                <b>Akun tidak ditemukan!</b>
                            </div>';
                        }else{
                            $nickname = $res['nickname'];
                        }
                    }else{
                        $nickname = NULL;
                    }
                }

                // Penentuan Harga
                $harga = $this->harga->getHarga($_POST['paket_id'], $_POST['nominal']);

                if($_POST['promocode'] !== ''){
                    $promo = $this->promo->getPromo($_POST['promocode']);
                }else{
                    $promo = false;
                }

                if($harga){
                    
                    $randomHarga = rand(1, 100);
                    $hargaBasic = $harga[0]['harga_basic'];

                    $pembayaran = $this->pembayaran->getPembayaran($_POST['pembayaran']);
                    $feePembayaran = $pembayaran[0]['fee'];
                    
                    if($feePembayaran == 0){
                        $hargaTotal = $hargaBasic + $randomHarga;
                    }else if($feePembayaran > 1){
                        $hargaTotal = $hargaBasic + $feePembayaran + $randomHarga;
                    }else if($feePembayaran < 1){
                        $hargaTotal = $hargaBasic + ($hargaBasic * $feePembayaran) + $randomHarga;
                    }

                    $hargaTotalView = 'Rp '.str_replace(',', '.', number_format($hargaTotal));
                    
                }else{
                    return '
                    <div class="alert alert-danger text-center" role="alert">
                        <b>Harga Error!</b>
                    </div>';
                }
                
                //Jika benar semua pengecekan
                echo '
                <div class="row m-3">
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
                        <div class="col-7">
                            : '.$harga[0]['nominal'].'
                        </div>
                    </div>
                    ';
                }

                if($pembayaran){
                    echo '
                    <div class="row m-3">
                        <div class="col-5">
                            Bayar Via 
                        </div>
                        <div class="col-7">
                            : '.strtoupper($pembayaran[0]['nama_pembayaran']).'
                        </div>
                    </div>
                    ';
                }

                if($promo){
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

            }else{
                return 'Anda siapa?';
            }
            
    }

}

?>