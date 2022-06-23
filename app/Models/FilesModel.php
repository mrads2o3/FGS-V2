<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class FilesModel extends Model
{
    protected $table = 'semua_files';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['tipe_files', 'nama_files', 'catatan', 'created_at', 'updated_at'];
}

?>