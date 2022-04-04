<?php 

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DaftarPaketModel;
use App\Models\UserAccessModel;

class Api extends ResourceController
{
    protected $sendTo;

    use ResponseTrait;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->sendTo = new UserAccessModel();
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
        $apiModel = new DaftarPaketModel();
        $gameid = $_GET['game_id'];
        if(isset($gameid)){
            $data = $apiModel->getPaket($gameid);
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
            $_IP_ADDRESS = $_SERVER['REMOTE_ADDR']; 
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
            $_PERINTAH = "arp -a $_IP_ADDRESS";
            ob_start();
            system($_PERINTAH);
            $_HASIL = ob_get_contents();
            ob_clean();
            $_PECAH = strstr($_HASIL, $_IP_ADDRESS);
            $_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));
            $_HASIL = substr($_PECAH_STRING[0], 0, 17);
            // }
            $id = md5($_HASIL);
            // $macaddr= preg_replace("/[^0-9]/", "", $random);
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

}

?>