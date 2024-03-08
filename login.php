<?php
header("Access-Control-Allow-Origin:*");
include("koneksi.php");
$json=file_get_contents('php://input');
$param=json_decode($json);
$arr=[];
if($json<>null){
    $email = $param->email;
    $password = md5($param->password);
    $pesan_sql="SELECT * from user WHERE email=$email and password = $password";
    $sql='SELECT * from user WHERE email=? and password = ?';
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->store_result();
    $count=$stmt->num_rows;
    if($count> 0){
        $pesan="Berhasil Login";
        $kode=1;
    }
    else {
        $pesan="Gagal Login";
        $kode=0;
    }
    $stmt->close();
}else{
    $pesan="Parameter tidak boleh kosong";
    $kode=0;
}
$arr['pesan']=$pesan;
$arr['kode']=$kode;
echo json_encode($arr);