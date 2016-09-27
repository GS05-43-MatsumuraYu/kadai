<?php
session_start();
include('include/func.php');

//POST値チェック
if(!isset($_POST["lid"]) || !isset($_POST["lpw"])){
  exit;
}

//DB処理
$pdo = db();
$stmt = $pdo->query('SET NAMES utf8');
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid AND lpw=:lpw");
$stmt->bindValue(':lid', $_POST["lid"]);
$stmt->bindValue(':lpw', $_POST["lpw"]);
$res = $stmt->execute();

//抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //データが1レコードとわかってる場合こちらを使用

//該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
  loginSessionSet($val);
  header("Location: select.php");
}else{
  //logout処理を経由して全画面へ
  header("Location: logout.php");
}
exit();

?>
