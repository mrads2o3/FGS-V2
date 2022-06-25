<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class FilesModel extends Model
{
    protected $table = 'semua_files';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['tipe_files', 'nama_files', 'catatan', 'created_at', 'updated_at'];
    
    public function getFiles($tipe_files=false)
    {
        if($tipe_files == false){
            return $this->orderBy('created_at', 'ASC')->findAll();
        }

        return $this->where(['tipe_files'=>$tipe_files])->orderBy('created_at', 'ASC')->findAll();
    }
}

?>