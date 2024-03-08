<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include("koneksi.php");
$json=file_get_contents('php://input');
$param=json_decode($json);

if($json<>null){
    $nama = $param->nama;
    $sql = "SELECT *  FROM product where nama like '%$nama%' ";
}else{
    $sql = "SELECT *  FROM product";
}

$result = $mysqli -> query($sql);
$data=[];
// Associative array
while($row = $result -> fetch_array(MYSQLI_ASSOC)){
   array_push($data, $row);
}
//echo "<pre>";
//print_r($data);
//echo "</pre>";
echo json_encode($data);
