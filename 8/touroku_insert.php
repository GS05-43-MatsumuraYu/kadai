<?php
//1. POSTデータ取得
$id = $_POST["id"];
$allbookpage = $_POST["allbookpage"];
$bookpage = $_POST["bookpage"];
$book_start_dairy = $_POST["book_start_dairy"];
$book_finish_dairy = $_POST["book_finish_dairy"];
$book_cmt = $_POST["book_cmt"];

//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベース接続エラー:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table01(id, allbookpage, bookpage, book_start_dairy, book_finish_dairy,book_cmt )
VALUES(NULL, :a2, :a3, :a4,:a5,:a6)");
$stmt->bindValue('a2', $allbookpage, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('a3', $bookpage, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('a4', $book_start_dairy,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('a5', $book_finish_dairy, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('a6', $book_cmt, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: select01.php");
  exit;//いちおう入れている。

}
?>
