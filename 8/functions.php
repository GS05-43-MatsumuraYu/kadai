<?php
/** 共通で使うものを別ファイルにしておきましょう。*/

//DB接続関数（PDO）

function db_con(){
        $dbname="gs_db";
    try {
      $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('DbConnectError:'.$e->getMessage());
    }
    return $pdo;
}
//必ず波カッコ同士がセットになっているか確認
//SQL処理エラー
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
function queryError($stmt){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}
/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");//スクリプトとかtagがあると無効化させる対策
}


?>
