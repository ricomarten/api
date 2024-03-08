<?php
header("Access-Control-Allow-Origin:*");
include("koneksi.php");
$json=file_get_contents('php://input');
$param=json_decode($json);

if($json<>null){
    $id = $param->id;
    $sql = "SELECT *  FROM product where id=$id";
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
