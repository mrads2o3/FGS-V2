<?php

namespace App\Controllers;
use App\Models\DaftarPesananModel;
use Myth\Auth\Models\UserModel;

class Member extends BaseController
{
    protected $pesanan;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->auth = service('authentication');
        $this->pesanan = new DaftarPesananModel();
        $this->users = new UserModel();
    }

    public function index()
    {
        echo 'ini halaman khusus <b> member </b> ya gaes';
    }

    public function historytx()
    {
        if(logged_in()){
            
            $pesanan = $this->pesanan->getHistoryTx();
            $data = array(
                'data' => $pesanan
            );
            
            return view('member/history', $data);
        }else{
            return redirect()->to(base_url());
        }
    }

    public function Profile()
    {
        return view('member/profile');
    }

    public function changePassword()
    {
        $msg = 'Nothing todo here!';
        
        if($_POST){
            $var = $_POST;
            if($var['old_password'] != '' && $var['new_password'] != NULL && $var['rep_new_password'] != NULL){
                
                if($var['new_password'] == $var['rep_new_password']){
                    $oldpassword = user()->password_hash;
                    $inp_oldpassword = $var['old_password'];
                    if(!password_verify(base64_encode(hash('sha384', $inp_oldpassword, true)), $oldpassword))
                    {
                        $msg = 'Password lama tidak benar, mohon ulangi!';
                    } else {

                        if($inp_oldpassword == $var['new_password']){
                            $msg = 'Password baru tidak boleh sama dengan password lama!';
                        }else{
                            // $msg = 'password matched';
                            $password_hash = password_hash(base64_encode(hash('sha384', $var['new_password'], true)), PASSWORD_DEFAULT);
                            $username = user()->username;

                            $query = $this->users->set(['password_hash'=>$password_hash])->where(['username'=>$username])->update();

                            if($query){
                                $msg = 'Password berhasil diubah!';
                            }else{
                                $msg = 'Password gagal diubah!';
                            }
                            
                        }
                    }
                }else{
                    $msg = 'Password baru dengan Ulangi password baru harus sama!';
                }

            }else{
                $msg = 'Mohon isi semua field!';
            }
            
            
        }

        $data = array(
            'message'=>$msg,
        );
        return json_encode($data);
    }
}
?>