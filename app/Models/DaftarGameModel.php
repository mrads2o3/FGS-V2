<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class DaftarGameModel extends Model
{
    protected $table = 'daftar_game';
    protected $primaryKey = 'kode_game';
    protected $useTimestamps = true;
    protected $allowedFields = ['urutan', 'kode_game', 'nama_game', 'slug', 'ikon_matauang', 'ikon_game', 'status', 'cari_id'];
    
    public function getGames($slug=false)
    {
        if($slug == false){
            return $this->where(['status' => 'enabled'])->orderBy('urutan', 'ASC')->findAll();
        }

        return $this->where(['slug'=>$slug])->findAll();
    }
}

?>