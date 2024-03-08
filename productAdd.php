<?php
header("Access-Control-Allow-Origin:*");
include("koneksi.php");
$json=file_get_contents('php://input');
$param=json_decode($json);
$arr=[];
if($json<>null){
    $nama = $param->nama;
    $harga = $param->harga;
    $stok = $param->stok;
    $sql='INSERT into product (nama,harga,stok) VALUES (?,?,?)';
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param('sii', $nama, $harga, $stok);
    $stmt->execute();
    $stmt->close();
    if($stmt){
        $pesan="Berhasil Input";
        
    }
    else {
        $pesan="Gagal Input";
        $kode=0;
    }
}else{
    $pesan="Parameter tidak boleh kosong";
    $kode=0;
}
$arr['pesan']=$pesan;
$arr['kode']=$kode;
echo json_encode($arr);