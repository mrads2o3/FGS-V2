<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class DaftarHargaModel extends Model
{
    protected $table = 'daftar_harga';
    protected $primaryKey = 'kode_harga';
    protected $useTimestamps = false;
    protected $allowedFields = ['urutan', 'kode_paket', 'nominal', 'harga_basic', 'ukuran', 'template', 'c_matauang'];
    
    public function getHarga($kode_paket=false, $kode_harga=false)
    {
        if($kode_paket !== false && $kode_harga !== false){
            return $this->where(['kode_paket'=>$kode_paket, 'kode_harga'=>$kode_harga])->findAll();
        }else if($kode_paket == false){
            return $this->orderBy('urutan', 'ASC')->findAll();
        }else{
            return $this->where(['kode_paket'=>$kode_paket])->findAll();
        }
    }
}

?>