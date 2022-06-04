<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['auth'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        date_default_timezone_set("Asia/Jakarta");
        $this->auth = service('authentication');

        // E.g.: $this->session = \Config\Services::session();
    }

    public function getUserID(){
        $this->auth = service('authentication');

        if($this->auth->check()){
            // $users = model(UserModel::class);
            // d($this->auth->user()->username);
            $id = $this->auth->user()->username;
        }else{
            // // $_IP_SERVER = $_SERVER['SERVER_ADDR'];
            // $_IP_ADDRESS = $_SERVER['REMOTE_ADDR']; 
            // // if($_IP_ADDRESS == $_IP_SERVER)
            // // {
            // //     ob_start();
            // //     system('ipconfig /all');
            // //     $_PERINTAH  = ob_get_contents();
            // //     ob_clean();
            // //     $_PECAH = strpos($_PERINTAH, "Physical");
            // //     $_HASIL = substr($_PERINTAH,($_PECAH+36),17);
            // // }
            // // else {
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
            // // $macaddr= preg_replace("/[^0-9]/", "", $random);
            
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
        return $id;
    }
}