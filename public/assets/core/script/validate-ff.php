<?php
$id = $_POST['id'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-xyz.com/trueid/freefire/?id=".$id."&token=NguyenThuWan");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

$result = curl_exec($ch);
curl_close($ch);
$res = json_decode($result,true);

//echo $res["nickname"];
if($res["error_msg"] != NULL){
    echo "Kami tidak dapat menemukan user ID : ".$id;
}else{
    echo "ID : ".$id;
    echo " Nickname : ".$res['nickname'];
}
?>
