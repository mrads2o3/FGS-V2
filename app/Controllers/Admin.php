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
        $matauang = $this->files->getFiles("matauang");
        $ikon_game = $this->files->getFiles("ikon");
        $cari_id = $this->files->getFiles("cari_id");
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
            'matauang' => $matauang,
            'ikon_game' => $ikon_game,
            'cari_id' => $cari_id,
        ];
        return view('admin/games', $data);
    }

    public function paket()
    {
        $banner_paket = $this->files->getFiles("banner_game");
        $ikon_paket = $this->files->getFiles("ikon");
        $allGame = $this->gameApiModel->orderby('urutan', 'ASC')->findAll();
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
            'game' => $allGame,
            'banner_paket'=> $banner_paket,
            'ikon_paket' => $ikon_paket,
            
        ];
        return view('admin/paket', $data);
    }

    public function nominal()
    {
        $allPaket = $this->paketApiModel->getAllPaket()->getResult();
        $matauang = $this->files->getFiles('matauang');
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
            'inPaket' => $allPaket,
            'c_matauang' => $matauang,
            
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

            $data = array(
                'error' => 404
            );
            
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
            }else if($kode == "getdetailgames" && isset($_GET['id'])){
                $data = $this->gameApiModel->where('kode_game', $_GET['id'])->first();
            }else if($kode == "getdetailpaket" && isset($_GET['id'])){
                $data = $this->paketApiModel->where(['kode_paket'=> $_GET['id']])->first();
            }else if($kode = "getdetailharga"){
                $data = $this->harga->where(['kode_harga'=>$_GET['id']])->first();
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

    public function gameProcess()
    {
        if($_POST){
            $var = $_POST;

            $data = array(
                'message' => 'error'
            );

            if($var['formtype'] && $var['urutan'] && $var['kode_game'] && $var['nama_game'] && $var['ikon_matauang'] && $var['ikon_game'] && $var['cari_id'] && $var['status']){
            }else{
                $data = array(
                    'message' => 'Mohon isi semua field yang tersedia!'
                );
                return json_encode($data);
            }
            
            if(user()->getRoles()[0]['name'] == "admin"){
                    if($var['formtype'] == 'insert'){
                        $slug = strtolower(str_replace(" ", "_",$var['nama_game']));
                        $query = $this->gameApiModel->where(['kode_game'=> $var['kode_game']])->first();
                        if($query == NULL){
                            $query = $this->gameApiModel->where(['slug'=> $slug])->first();
                            if($query == NULL){
                                
                                $kode_game = strtolower(str_replace(" ", "_",$var['kode_game']));
                                $querty = $this->gameApiModel->insert(['kode_game'=> $kode_game, 'nama_game'=> $var['nama_game'], 'slug'=> $slug, 'ikon_matauang'=> $var['ikon_matauang'], 'ikon_game'=> $var['ikon_game'], 'cari_id'=> $var['cari_id'], 'status'=>$var['status']]);

                                if(!$querty){

                                    $loop = true;
                                    $urutan = $var['urutan'];
                                    $var_kodegame = '';
                                    while($loop){
                                        $qwerty = $this->gameApiModel->where(['urutan'=> $urutan, 'kode_game!='=>$var_kodegame])->orderby('updated_at', 'ASC')->first();
                                        if($qwerty != NULL){
                                            $new_urutan = $urutan+1;
                                            $querty = $this->gameApiModel->set(['urutan'=> $new_urutan])->where(['urutan'=> $urutan, 'kode_game'=> $qwerty['kode_game']])->update();
                                            $var_kodegame = $qwerty['kode_game'];
                                        }else{
                                            $loop = false;
                                            break;
                                        }
                                        $urutan++;
                                    }

                                    $qwerty = $this->gameApiModel->set(['urutan'=> $var['urutan']])->where(['kode_game'=> $kode_game])->update();
                                    if($qwerty){
                                        $data = array(
                                            'message' => 'Berhasil',
                                        );
                                    }else{
                                        $data = array(
                                            'message' => 'Gagal',
                                        );
                                    }
                                    
                                }else{
                                    $data = array(
                                        'message' => 'Input data gagal',
                                    );
                                }

                            }else{
                                $data = array(
                                    'message' => 'Data dengan nama game '.$var['nama_game'].' sudah ada didalam database'
                                );
                            }
                        }else{
                            $data = array(
                                'message' => 'Data dengan kode game '.$var['kode_game'].'sudah ada didalam database!'
                            );
                        }
                    }else if($var['formtype'] == 'update'){
                        $query = $this->gameApiModel->where(['kode_game'=>$var['old_kode_game']])->first();
                        if($query != NULL){

                            $old_slug = $query['slug'];
                            $old_urutan = $query['urutan'];

                            if($var['old_kode_game'] == $var['kode_game']){
                                $query = NULL;
                            }else{
                                $query = $this->gameApiModel->where(['kode_game'=>$var['kode_game']])->first();
                            }

                            if($query == NULL){

                                $slug = strtolower(str_replace(" ", "_",$var['nama_game']));
                                $kode_game = strtolower(str_replace(" ", "_",$var['kode_game'])); 

                                if($old_slug == $slug){
                                    $query = NULL;
                                }else{
                                    $query = $this->gameApiModel->where(['slug'=>$slug])->first();   
                                }

                                if($query == NULL){
                                    $urutan = $var['urutan'];
                                    $loop = true;
                                    $var_kodegame = $kode_game;
                                    $query = $this->gameApiModel->set(['urutan'=> $urutan, 'kode_game'=> $kode_game, 'nama_game'=> $var['nama_game'], 'slug'=> $slug, 'ikon_matauang'=> $var['ikon_matauang'], 'ikon_game'=> $var['ikon_game'], 'cari_id'=> $var['cari_id'], 'status'=>$var['status']])->where(['kode_game'=>$var['old_kode_game']])->update();
                                    
                                    while($loop){
                                        $qwerty = $this->gameApiModel->where(['urutan'=> $urutan, 'kode_game!='=>$var_kodegame])->orderby('updated_at', 'ASC')->first();
                                        if($qwerty != NULL){
                                            $new_urutan = $urutan+1;
                                            $querty = $this->gameApiModel->set(['urutan'=> $new_urutan])->where(['urutan'=> $urutan, 'kode_game'=> $qwerty['kode_game']])->update();
                                            $var_kodegame = $qwerty['kode_game'];
                                        }else{
                                            $loop = false;
                                            break;
                                        }
                                        $urutan++;
                                    }

                                    if($query){
                                        $data = array(
                                            'message' => 'Berhasil',
                                        );
                                    }else{
                                        $data = array(
                                            'message' => 'Gagal',
                                        );
                                    }

                                }else{
                                    $data = array('message'=>'Nama game '.$var['nama_game'].' sudah ada didalam database!');
                                }

                            }else{
                                $data = array('message'=>'Kode game '.$var['kode_game'].' sudah ada didalam database!');
                            }

                        }else{
                            $data = array('message'=>'Data yang ingin diupdate tidak ditemukan!');
                        }
                    }else{
                        $data = array('message'=>'Value error!');
                    }
            }
        }else if(isset($_GET['del_id'])){
            $query = $this->gameApiModel->delete(['kode_game'=>$_GET['del_id']]);
            if($query){
                $data = array(
                    'message' => 'Data berhasil dihapus!'
                );
            }else{
                $data = array(
                    'message' => 'Data gagal dihapus!'
                );
            }
        }
        return json_encode($data);
    }

    public function paketProcess()
    {
        $msg = 'Nothing todo here!';
        if($_POST){
            $var = $_POST;
            $msg = 'Error';

            if($var['formtype'] && $var['urutan'] && $var['slug_game'] && $var['nama_paket'] && $var['deskripsi_paket'] && $var['banner_paket'] && $var['ikon_paket'] && $var['game_id'] && $var['game_idType'] && $var['game_server'] && $var['game_serverType'] && $var['game_note'] && $var['game_nickname'] && $var['petunjuk'] && $var['status']){
            }else{
                $data = array(
                    'message' => 'Mohon isi field urutan, game, nama paket, deskripsi paket, banner paket, ikon paket, id, server, note, nickname, petunjuk, dan status'
                );
                return json_encode($data);
            }

            if($var['formtype'] == 'insert'){
                $msg = 'Oke insert';
                $query = $this->paketApiModel->insert([
                    'urutan'=>$var['urutan'],
                    'slug_game'=>$var['slug_game'],
                    'nama_paket'=> $var['nama_paket'],
                    'deskripsi_paket'=>nl2br($var['deskripsi_paket']),
                    'banner_paket'=>$var['banner_paket'],
                    'ikon_paket'=>$var['ikon_paket'],
                    'banner_paket'=>$var['banner_paket'],
                    'game-id'=>$var['game_id'],
                    'game-id_type'=>$var['game_idType'],
                    'game-id_placeholder'=>$var['game_idPlaceholder'],
                    'game-server'=>$var['game_server'],
                    'game-server_type'=>$var['game_serverType'],
                    'game-server_placeholder'=>$var['game_serverPlaceholder'],
                    'game-server_select-value'=>$var['game_serverSelectValue'],
                    'game-server_placeholder'=>$var['game_serverPlaceholder'],
                    'note'=>$var['game_note'],
                    'note_placeholder'=>$var['game_notePlaceholder'],
                    'game-nickname'=>$var['game_nickname'],
                    'game-nickname_placeholder'=>$var['game_nicknamePlaceholder'],
                    'sub1'=>$var['sub1'],
                    'sub2'=>$var['sub2'],
                    'sub3'=>$var['sub3'],
                    'petunjuk'=>$var['petunjuk'],
                    'status'=>$var['status'],
                ]);
                                
                if($query){
                    $loop = true;
                    $urutan = $var['urutan'];
                    $var_kodepaket = $query;
                    
                    while($loop){

                        $qwerty = $this->paketApiModel->where([
                            'urutan'=>$urutan,
                            'slug_game'=>$var['slug_game'],
                            'kode_paket!='=>$var_kodepaket
                        ])->orderby('updated_at', 'ASC')->first();

                        if($qwerty != NULL){
                            
                            $new_urutan = $urutan+1;
                            $qwertyu = $this->paketApiModel->set([
                                'urutan'=>$new_urutan
                            ])->where('kode_paket', $qwerty['kode_paket'])->update();
                            $var_kodepaket = $qwerty['kode_paket'];
                       
                        }else{

                            $loop = false;
                            break;
                            
                        }
                        
                        $urutan++;
                    }
       
                    $msg = 'Berhasil';
                }else{
                    $msg = 'Data gagal diinput';
                }

            }else if($var['formtype'] == 'update'){
                $msg = 'Oke update';

                $qwerty = $this->paketApiModel->where(['kode_paket'=>$var['id_paket']])->first();
                if($qwerty != NULL){
                    
                    $query = $this->paketApiModel->set([
                        'urutan'=>$var['urutan'],
                        'slug_game'=>$var['slug_game'],
                        'nama_paket'=> $var['nama_paket'],
                        'deskripsi_paket'=>nl2br($var['deskripsi_paket']),
                        'banner_paket'=>$var['banner_paket'],
                        'ikon_paket'=>$var['ikon_paket'],
                        'banner_paket'=>$var['banner_paket'],
                        'game-id'=>$var['game_id'],
                        'game-id_type'=>$var['game_idType'],
                        'game-id_placeholder'=>$var['game_idPlaceholder'],
                        'game-server'=>$var['game_server'],
                        'game-server_type'=>$var['game_serverType'],
                        'game-server_placeholder'=>$var['game_serverPlaceholder'],
                        'game-server_select-value'=>$var['game_serverSelectValue'],
                        'game-server_placeholder'=>$var['game_serverPlaceholder'],
                        'note'=>$var['game_note'],
                        'note_placeholder'=>$var['game_notePlaceholder'],
                        'game-nickname'=>$var['game_nickname'],
                        'game-nickname_placeholder'=>$var['game_nicknamePlaceholder'],
                        'sub1'=>$var['sub1'],
                        'sub2'=>$var['sub2'],
                        'sub3'=>$var['sub3'],
                        'petunjuk'=>$var['petunjuk'],
                        'status'=>$var['status'],
                    ])->where(['kode_paket'=>$var['id_paket']])->update();

                    $loop = true;
                    $urutan = $var['urutan'];
                    $var_kodepaket = $var['id_paket'];
                    
                    while($loop){

                        $qwerty = $this->paketApiModel->where([
                            'urutan'=>$urutan,
                            'slug_game'=>$var['slug_game'],
                            'kode_paket!='=>$var_kodepaket
                        ])->orderby('updated_at', 'ASC')->first();

                        if($qwerty != NULL){
                            
                            $new_urutan = $urutan+1;
                            $qwertyu = $this->paketApiModel->set([
                                'urutan'=>$new_urutan
                            ])->where('kode_paket', $qwerty['kode_paket'])->update();
                            $var_kodepaket = $qwerty['kode_paket'];
                       
                        }else{

                            $loop = false;
                            break;
                            
                        }
                        
                        $urutan++;
                    }

                    $msg = 'Berhasil';

                }else{
                    $msg = 'Data gagal diupdate';
                }
            }else{
                $msg = 'Missing value...';
            }

        }else if(isset($_GET['del_id'])){
            $query = $this->paketApiModel->delete(['kode_game'=>$_GET['del_id']]);
            if($query){
                $msg = 'Data berhasil dihapus!';
            }else{
                $msg = 'Data gagal dihapus!';
            }
        }else{
            $msg = 'Nothing todo here!';
        }

        $data = [
            'message' => $msg
        ];

        return json_encode($data);
    }

    public function nominalprocess()
    {
        $msg = 'Nothing todo here!';

        if($_POST){
            $var = $_POST;

            if($var['formtype'] == 'insert'){
                $msg = 'Insert';
                
                if($var['template'] == 'divider'){
                    if($var['urutan'] && $var['nominal'] && $var['ukuran'] && $var['kode_paket']){
                        
                        $query = $this->harga->insert([
                            'urutan'=>$var['urutan'],
                            'nominal'=>$var['nominal'],
                            'kode_paket'=>$var['kode_paket'],
                            'template'=>$var['template'],
                            'ukuran'=>$var['ukuran'],
                        ]);
                        
                        if($query){
                            $msg = 'Berhasil tambah data';
                        }else{
                            $msg = 'Input data gagal';
                        }
                        
                    }else{
                        $msg = 'Harap isi urutan, nominal, ukuran, dan game - paket';
                    }

                }else{
                    if($var['urutan'] && $var['nominal'] && $var['harga_basic'] && $var['ukuran'] && $var['kode_paket'] && $var['template']){
                        
                        $query = $this->harga->insert([
                            'urutan'=>$var['urutan'],
                            'nominal'=>$var['nominal'],
                            'harga_promo'=>$var['harga_promo'],
                            'harga_basic'=>$var['harga_basic'],
                            'ukuran'=>$var['ukuran'],
                            'kode_paket'=>$var['kode_paket'],
                            'template'=>$var['template'],
                            'c_matauang'=>$var['c_matauang'],
                        ]);
                        
                        if($query){
                            $msg = 'Berhasil tambah data';
                        }else{
                            $msg = 'Input data gagal';
                        }

                    }else{
                        $msg = 'Harap isi semua field yang dibutuhkan';
                    }
                }

                if($msg == 'Berhasil tambah data' && $query){
                    $loop = true;
                    $urutan = $var['urutan'];
                    $var_kodeharga = $query;
                    while($loop){
                        $qwerty = $this->harga->where(['urutan'=>$urutan, 'kode_harga!='=>$var_kodeharga, 'kode_paket'=>$var['kode_paket']])->orderby('kode_harga', 'ASC')->first();
                        if($qwerty != NULL){
                            $new_urutan = $urutan+1;
                            $querty = $this->harga->set(['urutan'=>$new_urutan])->where(['kode_harga'=>$qwerty['kode_harga']])->update();
                            $var_kodeharga = $qwerty['kode_harga'];
                        }else{
                            $loop = false;
                            break;
                        }
                        $urutan++;
                    }
                }
                
            }else if($var['formtype'] == 'update'){
                $msg = 'Update';

                $checking = $this->harga->where(['kode_harga'=>$var['kode_harga']]);
                if($checking != NULL){
                    if($var['template'] == 'divider'){
                        if($var['urutan'] && $var['nominal'] && $var['ukuran'] && $var['kode_paket']){
                            
                            $msg = 'Oke pertama';

                            $query = $this->harga->insert([
                                'urutan'=>$var['urutan'],
                                'nominal'=>$var['nominal'],
                                'kode_paket'=>$var['kode_paket'],
                                'template'=>$var['template'],
                                'ukuran'=>$var['ukuran'],
                            ]);
                            
                            if($query){
                                $msg = 'Berhasil';
                            }else{
                                $msg = 'Input data gagal';
                            }
                            
                        }else{
                            $msg = 'Harap isi urutan, nominal, ukuran, dan game - paket';
                        }

                    }else{
                        if($var['urutan'] && $var['nominal'] && $var['harga_basic'] && $var['ukuran'] && $var['kode_paket'] && $var['template']){
                            
                            $msg = 'Oke kedua'.$var['harga_promo'].$var['harga_basic'];

                            $query = $this->harga->insert([
                                'urutan'=>$var['urutan'],
                                'nominal'=>$var['nominal'],
                                'harga_promo'=>$var['harga_promo'],
                                'harga_basic'=>$var['harga_basic'],
                                'ukuran'=>$var['ukuran'],
                                'kode_paket'=>$var['kode_paket'],
                                'template'=>$var['template'],
                                'c_matauang'=>$var['c_matauang'],
                            ]);
                            
                            if($query){
                                $msg = 'Berhasil';
                            }else{
                                $msg = 'Input data gagal';
                            }

                        }else{
                            $msg = 'Harap isi semua field yang dibutuhkan';
                        }
                    }

                    if($msg == 'Berhasil' && $query){
                        $loop = true;
                        $urutan = $var['urutan'];
                        $var_kodeharga = $query;
                        while($loop){
                            $qwerty = $this->harga->where(['urutan'=>$urutan, 'kode_harga!='=>$var_kodeharga, 'kode_paket'=>$var['kode_paket']])->orderby('kode_harga', 'ASC')->first();
                            if($qwerty != NULL){
                                $new_urutan = $urutan+1;
                                $querty = $this->harga->set(['urutan'=>$new_urutan])->where(['kode_harga'=>$qwerty['kode_harga']])->update();
                                $var_kodeharga = $qwerty['kode_harga'];
                            }else{
                                $loop = false;
                                break;
                            }
                            $urutan++;
                        }
                    }
                }else{
                    $msg = 'Harga dengan kode '.$var['kode_harga'].' tidak ada didalam database';
                }
            }else{
                $msg = 'Missing value...';
            }
                
        }else if(isset($_GET['del_id'])){
            $query = $this->harga->delete(['kode_harga'=>$_GET['del_id']]);
            if($query){
                $msg = 'Data berhasil dihapus!';
            }else{
                $msg = 'Data gagal dihapus!';
            }
        }

        $data = array(
            'message' => $msg,
        );
        return json_encode($data);
    }
}
?>