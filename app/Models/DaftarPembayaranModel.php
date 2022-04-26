<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class DaftarPembayaranModel extends Model
{
    protected $table = 'daftar_pembayaran';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_pembayaran', 'ikon_pembayaran', 'fee', 'status'];
    
    public function getPembayaran($id_bayar=false)
    {
        if($id_bayar==false){
            return $this->where(['status'=>'enabled'])->findAll();
        }else{
            return $this->where(['id'=>$id_bayar,'status'=>'enabled'])->findAll();
        }
    }
}

?>