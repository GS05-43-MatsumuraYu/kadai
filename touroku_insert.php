<?php
//1. POSTデータ取得
$id = $_POST["id"];
$bookname = $_POST["bookname"];
// $allbookpage = $_POST["allbookpage"];
$book_start_dairy = $_POST["book_start_dairy"];

//2. DB接続します
try {
  $pdo = new PDO("mysql:dbname=spice-shelf_jp;host=spice-shelf.sakura.ne.jp", "spice-shelf", "e4uyb4f9k2");
} catch (PDOException $e) {
  exit('データベース接続エラー:'.$e->getMessage());
}

//2.DBに接続
function db_con(){
  $dbname = 'spice-shelf_jp';
  $host   = 'mysql327.db.sakura.ne.jp';
  $dsn    = 'mysql:dbname='.$dbname.';host='.$host.';charset=utf8';
  $user   = 'spice-shelf';
  $pass   = 'e4uyb4f9k2';
  try {
    $pdo = new PDO($dsn,$user,$pass);
  } catch (PDOException $e) {
    exit('データベース接続エラー:'.$e->getMessage());
  }
  return $pdo;
}
//３．データ登録SQL作成
VALUES(NULL, :a2, :a4 )");
$stmt->bindValue('a2', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue('a3', $allbookpage, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('a4', $book_start_dairy,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: view01.php");
  exit;//いちおう入れている。

}
?>