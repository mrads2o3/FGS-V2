<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class AntrianProcessModel extends Model
{
    protected $table = 'antrian_proses';
    protected $primaryKey = 'no';
    protected $useTimestamps = false;
    protected $allowedFields = ['order_id'];

    public function getAntrianProcess()
    {
        $query = $this->db->table('antrian_proses')->join('daftar_pesanan', 'daftar_pesanan.order_id = antrian_proses.order_id')->orderBy('no', 'ASC')->get();
        return $query;
    }
}

?>