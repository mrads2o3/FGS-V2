<?php

namespace App\Controllers;

use App\Models\DaftarGameModel;
use App\Models\DaftarPaketModel;
use App\Models\UserAccessModel;

class Home extends BaseController
{
    protected $games;
    protected $paket;
    protected $uaccess;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->games = new DaftarGameModel();
        $this->paket = new DaftarPaketModel();
        $this->uaccess = new UserAccessModel();
        $this->auth = service('authentication');
    }

    public function index()
    {
        $popupler = '';
        
        $user_id = $this->getUserID();
        $data = [
            'games' => $this->games->getGames(),
            'uaccess' => $this->uaccess->getAccess($user_id),
            'paccess' => $this->uaccess->getAccess(),
            'newgames' => $this->games->where(['status'=>'enabled'])->orderBy('created_at', 'DESC')->findAll(),
        ];
        return view('public_view/index', $data);
    }

    public function games_paket($slug_game){
        $data = [
            'paket' => $this->paket->getPaket($slug_game),
            'slug_game' => $slug_game
        ];
        
        $countdata = count($data['paket']);
        if($countdata){
            
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Maaf paket tidak tersedia silahkan hubungi admin!');

        }else if($countdata){
            $location = base_url('/games/'.$slug_game.'/'.$data['paket']['0']['kode_paket']);
            header("location:".$location);
            exit();
        }

        return view('public_view/gamepaket', $data);
    }
}