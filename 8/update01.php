<?php
//1.POSTでParamを取得
include ("functions.php");

$id = $_POST["id"];
$allbookpage       = $_POST["allbookpage"];
$bookpage          = $_POST["bookpage"];
$book_start_dairy  = $_POST["book_start_dairy"];
$book_finish_dairy = $_POST["book_finish_dairy"];
$book_cmt = $_POST["book_cmt"];
//2.DB接続など
$pdo = db_con();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("UPDATE gs_bm_table01 SET allbookpage=:allbookpage,bookpage=:bookpage,book_start_dairy=:book_start_dairy,book_finish_dairy=:book_finish_dairy,book_cmt=:book_cmt WHERE id=:id");
$stmt->bindValue(':allbookpage', $allbookpage,   PDO::PARAM_INT);  
$stmt->bindValue(':bookpage', $bookpage,  PDO::PARAM_INT);  
$stmt->bindValue(':book_start_dairy', $book_start_dairy, PDO::PARAM_STR);  
$stmt->bindValue(':book_finish_dairy', $book_finish_dairy, PDO::PARAM_STR); 
$stmt->bindValue(':book_cmt', $book_cmt, PDO::PARAM_STR); 
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  
$status = $stmt->execute();
//Integer（数値の場合 PDO::PARAM_INT)

if($status==false){
    queryError($stmt);
}else{
    header("Location: select01.php");
    exit;
}


?>
