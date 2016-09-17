<?php
include("functions.php");
//0.外部ファイル読み込み


//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY indate DESC LIMIT 10 ;");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
queryError($stmt); //27行目でstmt に値を渡しているので、いれる必要がある。
    
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
      $view .='<tr>';
      $view .='<td>';
      $view .='<a href="detail.php?id='.$result["id"].'">';
      $view .=$result["bookname"]."[".$result["indate"]."]";
      $view .='</a>';
      $view .=' ';
      $view .='<a href="delete.php?id='.$result["id"].'">';
      $view .='[削除]';
      $view .='</a><br>';
      $view .='</td>';
      $view .='</tr>';
  }
}
?>
    

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="detail.php">データ登録</a>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
  </div>
</div>
<!-- Main[End] -->

</body>
</html>
