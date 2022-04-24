<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class DaftarPembayaranModel extends Model
{
    protected $table = 'daftar_pembayaran';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_pembayaran', 'ikon_pembayaran', 'fee', 'status'];
    
    public function getPembayaran()
    {
        return $this->where(['status'=>'enabled'])->findAll();
    }
}

?>