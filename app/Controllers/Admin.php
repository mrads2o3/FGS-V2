<?php

namespace App\Controllers;
use App\Models\DaftarPaketModel;
use App\Models\DaftarGameModel;
use App\Models\UserAccessModel;
use App\Models\PromoCodeModel;
use App\Models\DaftarHargaModel;
use App\Models\DaftarPembayaranModel;
use App\Models\DaftarPesananModel;
use App\Models\AntrianProcessModel;
use App\Models\FilesModel;
class Admin extends BaseController
{   
    public function __construct()
    {
        $this->sendTo = new UserAccessModel();
        $this->promo = new PromoCodeModel();
        $this->paketApiModel = new DaftarPaketModel();
        $this->gameApiModel = new DaftarGameModel();
        $this->harga = new DaftarHargaModel();
        $this->pembayaran = new DaftarPembayaranModel();
        $this->pesanan = new DaftarPesananModel(); 
        $this->AProcess = new AntrianProcessModel();   
        $this->files = new FilesModel();
    }

    public function index()
    {
        return redirect()->to(base_url('/admin/dashboard'));
    }

    public function dashboard()
    {   
        $year = date('Y');
        $month = 1;
        $var = '[';
        while($month <= 12){
           $date[0] = strtotime($year.'-'.$month);
           $date[1] = strtotime($year.'-'.($month+1));
           if(!$date[1]){
               $date[1] = strtotime(($year+1).'-1');
           }             
           $var = $var . $this->pesanan->getPesananByRangeTime($date[0], $date[1]);
           if($month <= 11){
            $var = $var . ',';
           }else if($month == 12){
            $var = $var . ']';
           }
           $month++;
        }
        
        $data = [
            'dashboard' => 'active',
            'pesanan_dibayar' => '',
            'pesanan_proses' => '',
            'semua_pesanan' => '',
            'files' => '',
            'games' => '',
            'paket' => '',
            'nominal' => '',
            'promo' => '',
            'pesanan_daily' => $this->pesanan->where('order_id >'.strtotime("today"))->where('order_id <'.strtotime("today +1 day"))->findAll(),
            'pesanan_alltime' => $this->pesanan->getPesananAlltime(),
            'dashboard_chart' => $var
        ];
        
        return view('admin/index', $data);
    }

    public function pesanan_dibayar()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => '',
            'pesanan_dibayar' => 'active',
            'semua_pesanan' => '',
            'files' => '',
            'games' => '',
            'paket' => '',
            'nominal' => '',
            'promo' => '',
        ];
        return view('admin/pesanan_dibayar', $data);
    }

    public function pesanan_proses()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => 'active',
            'pesanan_dibayar' => '',
            'semua_pesanan' => '',
            'files' => '',
            'games' => '',
            'paket' => '',
            'nominal' => '',
            'promo' => '',
        ];
        return view('admin/pesanan_proses', $data);
    }

    public function semua_pesanan()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => '',
            'pesanan_dibayar' => '',
            'semua_pesanan' => 'active',
            'files' => '',
            'games' => '',
            'paket' => '',
            'nominal' => '',
            'promo' => '',
        ];
        return view('admin/semua_pesanan', $data);
    }

    public function files()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => '',
            'pesanan_dibayar' => '',
            'semua_pesanan' => '',
            'files' => 'active',
            'games' => '',
            'paket' => '',
            'nominal' => '',
            'promo' => '',
        ];
        return view('admin/files', $data);
    }

    public function games()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => '',
            'pesanan_dibayar' => '',
            'semua_pesanan' => '',
            'files' => '',
            'games' => 'active',
            'paket' => '',
            'nominal' => '',
            'promo' => '',
        ];
        return view('admin/games', $data);
    }

    public function paket()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => '',
            'pesanan_dibayar' => '',
            'semua_pesanan' => '',
            'files' => '',
            'games' => '',
            'paket' => 'active',
            'nominal' => '',
            'promo' => '',
        ];
        return view('admin/paket', $data);
    }

    public function nominal()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => '',
            'pesanan_dibayar' => '',
            'semua_pesanan' => '',
            'files' => '',
            'games' => '',
            'paket' => '',
            'nominal' => 'active',
            'promo' => '',
        ];
        return view('admin/nominal', $data);
    }

    public function promo()
    {
        $data = [
            'dashboard' => '',
            'pesanan_proses' => '',
            'pesanan_dibayar' => '',
            'semua_pesanan' => '',
            'files' => '',
            'games' => '',
            'paket' => '',
            'nominal' => '',
            'promo' => 'active',
        ];
        return view('admin/promo', $data);
    }

    public function data($kode = false)
    {
        if($kode != false){
            if($kode == 'getpesanandibayar'){
                $data = $this->pesanan->where('status', 'settlement')->orderby('pay_at', 'ASC')->findAll();
            }else if($kode == "getsemuapesanan"){
                $data = $this->pesanan->orderby('updated_at', 'DESC')->findAll();
            }else if($kode == "getpesanandiproses"){
                // $data = $this->pesanan->where(['status' => 'process'])->orderby('updated_at', 'DESC')->findAll();
                $data = $this->AProcess->getAntrianProcess()->getResult();
            }else if($kode == "getallfiles"){
                $data = $this->files->orderby('id', 'ASC')->findAll();
            }else if($kode == "getallgames"){
                $data = $this->gameApiModel->orderby('urutan', 'ASC')->findAll();
            }else if($kode == "getallpaket"){
                $data = $this->paketApiModel->getAllPaket()->getResult();
            }else if($kode == "getallnominal"){
                $data = $this->harga->getAllNominal()->getResult();
            }else if($kode == "getallpromo"){
                $data = $this->promo->getAllPromo()->getResult();
            }
            return json_encode($data);
        }
    }

    public function uploadFiles()
    {
        if(user()->getRoles()[0]['name'] == "admin"){
            if(isset($_POST["submit"])){

                $type = $_POST['type'];
                $note = $_POST['note'];
                
                if($note == ''){
                    $message = "Note Error!";
                    $alert_type = "danger";
                    session()->setFlashdata('message', $message);
                    session()->setFlashdata('alert', $alert_type);
                    return redirect()->to(base_url('/admin/files'));    
                }
                
                $base_location = "assets/uploaded/image/";
                if($type == "matauang"){
                    $location = $base_location."/currency";
                }else if($type == "banner_home" || $type == "banner_game"){
                    $location = $base_location."/banner";
                }else if($type == "cari_id" || $type == "icon"){
                    $location = $base_location."/icon";
                }else{
                    $message = "Location Error!";
                    $alert_type = "danger";
                    session()->setFlashdata('message', $message);
                    session()->setFlashdata('alert', $alert_type);
                    return redirect()->to(base_url('/admin/files'));        
                }
                
                //Check Files
                if(isset($_FILES['files'])){

                    function generateRandomString($length = 64) {
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                        return $randomString;
                    }

                    $size = $_FILES['files']['size'];
                    $img_name = generateRandomString();
                    $img_filetype = strtolower(pathinfo(basename($_FILES["files"]["name"]),PATHINFO_EXTENSION));
                    $img_finalname = $img_name.'.'.$img_filetype;
                    $img_finallocation = $location.'/'.$img_finalname;
                    $img_check = getimagesize($_FILES["files"]["tmp_name"]);
                    
                    if($img_check !== false) {
                        if($img_filetype == "jpg" || $img_filetype == "jpeg" || $img_filetype == "png"){
                            if($size < 5000000){ // Max file size 5MB
                                if(file_exists($img_finallocation)) {
                                    $message = "Sorry, file already exists, pls reupload to get a new random name!";
                                    $alert_type = "danger";
                                }else{
                                    if(move_uploaded_file($_FILES["files"]["tmp_name"], $img_finallocation)) {

                                        $this->files->insert(['tipe_files'=>$type, 'nama_files'=>$img_finalname, 'catatan'=>$note]);
                                        
                                        $message = "The file ". htmlspecialchars(basename($_FILES["files"]["name"])). " has been uploaded with a new name ". $img_finalname;
                                        $alert_type = "success";
                                        
                                    }else{
                                        $message = "Sorry, there was an error uploading your file.";
                                        $alert_type = "danger";
                                    }
                                }
                            }else{
                                $message = "File is an image but to large, Max file size 5MB!";
                                $alert_type = "danger";
                            }
                        }else{
                            $message = "Format image not JPG/JPEG/PNG!";
                            $alert_type = "danger";
                        }

                    } else {
                        $message = "File is not an image.";
                        $alert_type = "danger";
                    }

                }else{
                    $message = "File not uploaded, please refresh before ReUpload!";
                    $alert_type = "danger";
                }
                
            }else{
                $message = "Post Error!";
                $alert_type = "danger";
            }
            session()->setFlashdata('message', $message);
            session()->setFlashdata('alert', $alert_type);
            return redirect()->to(base_url('/admin/files'));
        }
    }

    public function deleteFiles()
    {
        if(user()->getRoles()[0]['name'] == "admin"){
            if(isset($_POST)){
                $query = $this->files->where('id', $_POST['kode'])->first();
                $type = $query['tipe_files'];
                $base_location = "assets/uploaded/image/";
                $img_name = $query['nama_files'];

                if($type == "matauang"){
                    $location = $base_location."/currency";
                }else if($type == "banner_home" || $type == "banner_game"){
                    $location = $base_location."/banner";
                }else if($type == "cari_id" || $type == "ikon"){
                    $location = $base_location."/icon";
                }else{
                    $arr = array(
                        'status'=>'404',
                        'msg'=>'Failed to fetch location'
                    );
                    return json_encode($arr);
                }

                $img_finallocation = $location.'/'.$img_name;
                $del = $this->files->delete(['id'=>$_POST['kode']]);
                if($del){
                    if(file_exists($img_finallocation)) {
                        if(unlink($img_finallocation)){
                            $arr = array(
                                'status'=>'200',
                                'msg'=>'File deleted, and unlink true!'
                            );
                        }else{
                            $arr = array(
                                'status'=>'404',
                                'msg'=>'File not deleted, and unlink false mybe!'
                            );
                        }
                    }else{
                        $arr = array(
                            'status'=>'200',
                            'msg'=>'Data deleted, but no files deleted!'
                        );
                    }
                    // $arr = array(
                    //     'status'=>'200',
                    //     'msg'=>'Success delete files'
                    // );
                }else{
                    $arr = array(
                        'status'=>'404',
                        'msg'=>'Failed delete data!'
                    );
                }
            }else{
                $arr = array(
                    'status'=>'200',
                    'msg'=>'Failed delete files'
                );
            }   
        }else{
            $arr = array(
                'status'=>'404',
                'msg'=>'you are not admin! GET AWAY!'
            );
        }
        return json_encode($arr);
    }
}
?>