<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class UserAccessModel extends Model
{
    protected $table = 'user_access';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = ['id_user', 'game_id', 'paket_id', 'times'];
    
    public function sendAccess($id_user=false, $id_game=false, $id_paket=false){
        // d($id_user, $id_game, $id_paket);
        $rec = $this->where(['id_user'=>$id_user, 'game_id'=>$id_game, 'paket_id'=>$id_paket])->findAll();
        // return 'a';
        if(isset($rec[0])){
            $this->replace([
                'id'=>$rec[0]['id'],
                'id_user'=> $id_user,
                'game_id' => $id_game,
                'paket_id' => $id_paket,
                'times' => $rec[0]['times']+1
            ]);
            return 'b';
        }else{
            $this->replace([
                'id_user'=> $id_user,
                'game_id' => $id_game,
                'paket_id' => $id_paket,
                'times' => 0
            ]);
            return 'c';
        }
        //d($rec);
        //return $id_game;

            // $this->replace([
            //     'id'=>$rec[0]['id'],
            //     'id_user'=> $id_user,
            //     'game_id' => $id_game,
            //     'paket_id' => $id_paket,
            //     'times' => $rec[0]['times']+1
            // ]);

            //return 'elseeee';
            $this->replace([
                'game_id' => $id_game,
                'paket_id' => $id_paket,
                'times' => 0
            ]);
        
    }
}

?>