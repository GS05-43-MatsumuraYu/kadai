<?php
//1.POSTでParamを取得
include ("functions.php");

$id = $_POST["id"];
$name = $_POST["bookname"];
$email = $_POST["book_url"];
$naiyou = $_POST["book_cmt"];

//2.DB接続など
$pdo = db_con();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("UPDATE gs_bm_table SET bookname=:bookname,book_url=:book_url,book_cmt=:book_cmt WHERE id=:id");
$stmt->bindValue(':bookname', $name,   PDO::PARAM_STR);  
$stmt->bindValue(':book_url', $email,  PDO::PARAM_STR);  
$stmt->bindValue(':book_cmt', $naiyou, PDO::PARAM_STR);  
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  
$status = $stmt->execute();
//Integer（数値の場合 PDO::PARAM_INT)

if($status==false){
    queryError($stmt);
}else{
    header("Location: select.php");
    exit;
}


?>
