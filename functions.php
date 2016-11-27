<?php
/** 共通で使うものを別ファイルにしておきましょう。*/

//ssid check
function ssidCheck(){
if(
   !isset($_SESSION["schk"])||
   $_SESSION["schk"]!=session_id()
  ){
    exit("Error!!");
}else{
    session_regenerate_id();
    $_SESSION["schk"]=session_id();
}

}

function db_con(){
  $dbname = 'spice-shelf_jp';
  $host   = 'mysql327.db.sakura.ne.jp';
  $dsn    = 'mysql:dbname='.$dbname.';host='.$host.';charset=utf8';
  $user   = 'spice-shelf';
  $pass   = 'e4uyb4f9k2';
  try {
    $pdo = new PDO($dsn,$user,$pass);
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  return $pdo;
}

//SQL処理エラー
function queryError($stmt){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}


/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}


?>
