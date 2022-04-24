<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class DaftarPaketModel extends Model
{
    protected $table = 'daftar_paket';
    protected $primaryKey = 'kode_paket';
    protected $useTimestamps = true;
    protected $allowedFields = ['urutan', 'kode_paket', 'nama_paket', 'slug_game', 'slug_paket', 'deskripsi_paket', 'ikon_paket', 
    'banner_paket', 'game-id', 'game-id_placeholder', 'game-id_type', 'game-server', 'game-server_placeholder', 'game-serverr_type', 
    'game-server_select-value', 'note', 'note_placeholder', 'game-nickname', 'game-nickname_placeholder', 'petunjuk', 'status', 'sub1', 'sub2', 'sub3'];
    
    public function getPaket($slug_game=false, $paket_id=false)
    {
        
        if($slug_game=false && $paket_id=false){
            return $this->where(['status' => 'enabled'])->orderBy('urutan', 'ASC')->findAll();
        }else if($slug_game!=false && $paket_id!=false){
            return $this->where(['slug_game'=>$slug_game, 'kode_paket'=>$paket_id ,'status'=>'enabled'])->findAll();
        }else if($slug_game!=false){
            return $this->where(['slug_game'=>$slug_game,'status'=>'enabled'])->findAll();
        }else if($paket_id!=false){
            return $this->where(['kode_paket'=>$paket_id,'status'=>'enabled'])->findAll();
        }
    }
}

?>