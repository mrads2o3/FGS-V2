<?php 

namespace App\Models;
 
use CodeIgniter\Model;

class UserAccessModel extends Model
{
    protected $table = 'user_access';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = ['id_user', 'game_id', 'paket_id', 'times'];

    public function getPopular(){
        
        $result = $this->orderBy('times', 'DESC')->findAll();

        foreach($result as $a){

        }
        
    }

    public function getAccess($id_user=false){

        if($id_user != false){
            $result = $this->where(['id_user'=>$id_user])->orderBy('times', 'DESC')->findAll();
        }else{
            $result = $this->orderBy('game_id', 'DESC')->findAll();
        }
        return $result;
    }
    
    public function sendAccess($id_user=false, $id_game=false, $id_paket=false){
        if(!$id_game){
            return redirect()->to(base_url());
        }
        $rec = $this->where(['id_user'=>$id_user, 'game_id'=>$id_game, 'paket_id'=>$id_paket])->findAll();
        if(isset($rec[0])){
            $this->replace([
                'id'=>$rec[0]['id'],
                'id_user'=> $id_user,
                'game_id' => $id_game,
                'paket_id' => $id_paket,
                'times' => $rec[0]['times']+1
            ]);
            return $this->where('game_id', '0')->delete();
        }else{
            $this->replace([
                'id_user'=> $id_user,
                'game_id' => $id_game,
                'paket_id' => $id_paket,
                'times' => 1
            ]);
            return $this->where('game_id', '0')->delete();
        }
            $this->replace([
                'game_id' => $id_game,
                'paket_id' => $id_paket,
                'times' => 0
            ]);
            
        return $this->where('game_id', '0')->delete();
    }
}

?>