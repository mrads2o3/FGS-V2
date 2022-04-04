<?php
$id = $_POST['id'];
$zone = $_POST['server'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-xyz.com/trueid/mobilelegends/?id=".$id."&zone=".$zone."&token=NguyenThuWan");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

$result = curl_exec($ch);
curl_close($ch);
$res = json_decode($result,true);

if($res["error_msg"] != NULL){
    echo "Kami tidak dapat menemukan user ID : ".$id."(".$zone.")";
}else{
    echo "ID : ".$id;
    echo " Nickname : ".$res['nickname'];
}
//echo $res["nickname"];
/*
if($res["error_msg"] != NULL){
    echo "Kami tidak dapat menemukan user ID : ".$id." ( ".$zone." )";
}else{
    echo "ID : ".$id." ( ".$zone." ) ";
    echo "Nickname : ".$res['nickname'];
}*/
?>