<?php
//1. POSTデータ取得




//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=********;charset=utf8;host=localhost','******','******');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO ********(id, name, email, naiyou,
indate )VALUES(NULL, ******, *******, ********, sysdate())");
$stmt->bindValue('******', *****, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('******', *****, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('******', *****, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: *********");
  exit;

}
?>
