<?php

namespace App\Controllers;

use App\Models\DaftarGameModel;
use App\Models\DaftarPaketModel;
use App\Models\UserAccessModel;
use App\Models\SemuaFilesModel;
use App\Models\DaftarHargaModel;
use App\Models\DaftarPembayaranModel;

class Home extends BaseController
{
    protected $games;
    protected $paket;
    protected $uaccess;
    protected $files;
    protected $pembayaran;

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
            'pembayaran' => $this->pembayaran->getPembayaran(),
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
}