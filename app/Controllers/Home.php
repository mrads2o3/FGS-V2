<?php

namespace App\Controllers;
use App\Models\DaftarGameModel;
use App\Models\DaftarPaketModel;

class Home extends BaseController
{
    protected $games;
    protected $paket;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->games = new DaftarGameModel();
        $this->paket = new DaftarPaketModel();
    }

    public function index()
    {
        $data = [
            'games' => $this->games->getGames(),
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