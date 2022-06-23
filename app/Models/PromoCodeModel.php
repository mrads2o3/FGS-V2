<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class PromoCodeModel extends Model
{
    protected $table = 'promo_code';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = ['code', 'paket', 'dic', 'min', 'max', 'limited', 'sisa_limited', 'expired'];
    
    public function getPromo($code = false)
    {
        if($code != '' || $code != false){
            return $this->where(['code'=>$code])->findAll();
        }else{
            return $this->findAll();
        }
    }

    public function getAllPromo()
    {
        $data = $this->db->table('daftar_paket')->join('promo_code', 'daftar_paket.kode_paket = promo_code.paket')->orderby('id', 'ASC')->get();
        return $data;
    }
}

?>