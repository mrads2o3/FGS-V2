<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class DaftarPesananModel extends Model
{
    protected $table = 'daftar_pesanan';
    protected $primaryKey = 'order_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['order_id', 'owner', 'paket', 'nominal', 'userid', 'username', 'promocode', 'note', 'email_notif' ,'total_harga', 'status', 'pay_at'];
    
    public function getPesanan($order_id=false)
    {
        if($order_id != false){
            return $this->where(['order_id' => $order_id])->first();
        }

        return $this->findAll();
    }

    public function getHistoryTx()
    {
        if(user()->id != ''){
            return $this->where(['owner'=>user()->id])->orderby('order_id', 'DESC')->findAll();
        }
    }

    public function updateTx($order_id = false, $status = false)
    {
        if($order_id && $status){
            $this->set('status', $status)->where('order_id', $order_id)->update();
        }
    }

    public function getPesananAlltime()
    {
        return $this->findAll();
    }

    public function getPesananByRangeTime($month_1 = false, $month_2 = false)
    {
        if($month_1 && $month_2){
            $var = $this->where('order_id >=', $month_1)->where('order_id <=', $month_2)->where('status', 'finish')->findAll();
            $total = 0;
            foreach($var as $a){
                $total = $total + $a['total_harga'];
            }
            return $total;
        }
    }
}

?>