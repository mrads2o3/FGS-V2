<?php 

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DaftarPaketModel;
use App\Models\DaftarGameModel;
use App\Models\UserAccessModel;
use App\Models\PromoCodeModel;

class Api extends ResourceController
{
    protected $helpers = ['auth'];

    protected $sendTo;
    protected $promo;

    use ResponseTrait;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->sendTo = new UserAccessModel();
        $this->promo = new PromoCodeModel();
        $this->paketApiModel = new DaftarPaketModel();
        $this->gameApiModel = new DaftarGameModel();
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
            // $users = model(UserModel::class);
            // d($this->auth->user()->username);
            $id = $this->auth->user()->username;
        }else{
            // $_IP_SERVER = $_SERVER['SERVER_ADDR'];
            // $_IP_ADDRESS = $_SERVER['REMOTE_ADDR']; 
            // if($_IP_ADDRESS == $_IP_SERVER)
            // {
            //     ob_start();
            //     system('ipconfig /all');
            //     $_PERINTAH  = ob_get_contents();
            //     ob_clean();
            //     $_PECAH = strpos($_PERINTAH, "Physical");
            //     $_HASIL = substr($_PERINTAH,($_PECAH+36),17);
            // }
            // else {
            // $_PERINTAH = "arp -a $_IP_ADDRESS";
            // ob_start();
            // system($_PERINTAH);
            // $_HASIL = ob_get_contents();
            // ob_clean();
            // $_PECAH = strstr($_HASIL, $_IP_ADDRESS);
            // $_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));
            // $_HASIL = substr($_PECAH_STRING[0], 0, 17);
            // // }
            // $id = md5($_HASIL);
            // $macaddr= preg_replace("/[^0-9]/", "", $random);
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
        d($_POST);
        if($this->auth->check()){

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

                echo $nickname;

            }else{
                return 'Anda siapa?';
            }
            
        }else{
            return 'Anda Siapa ? ';
        }
    }

}

?>