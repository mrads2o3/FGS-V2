<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class DaftarPesananModel extends Model
{
    protected $table = 'daftar_pesanan';
    protected $primaryKey = 'order_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['order_id', 'owner', 'paket', 'nominal', 'userid', 'username', 'promocode', 'note', 'payment_method', 'total_harga', 'status'];
    
    public function getPesanan($order_id=false)
    {
        if($order_id != false){
            return $this->where(['order_id' => $order_id])->findAll();
        }

        return $this->findAll();
    }

    public function getHistoryTx()
    {
        if(user()->id != ''){
            return $this->where(['owner'=>user()->id])->findAll();
        }
    }
}

?>