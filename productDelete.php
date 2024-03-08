<?php
header("Access-Control-Allow-Origin:*");
include("koneksi.php");
$json=file_get_contents('php://input');
$param=json_decode($json);
$arr=[];
if($json<>null){
    $id = $param->id;
    $sql_select = "SELECT * FROM product where id=?";
    $stmt_select=$mysqli->prepare($sql_select);
    $stmt_select->bind_param('i', $id);
    $stmt_select->execute();
    $stmt_select->store_result();
    $count=$stmt_select->num_rows;

    if($count> 0){
        $sql='DELETE from product WHERE id=?';
        $stmt=$mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        if($stmt){
            $pesan="Berhasil Delete";
        }
        else $pesan="Gagal Delete";
    }
    else{
        $pesan= "Id tidak ditemukan";
    }
}else{
    $pesan="Parameter tidak boleh kosong";
}
$arr['pesan']=$pesan;
echo json_encode($arr);