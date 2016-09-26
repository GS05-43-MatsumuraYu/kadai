<?php
session_start();
//0.外部ファイル読み込み
include("functions.php");

ssidCheck();

//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view .= '<a href="detail.php?id='.$result["id"].'">';
    $view .= h($result["name"])."[".h($result["indate"])."]";
    $view .= '</a>　';
    $view .= '<a href="delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>管理者画面</title>
<meta keywords='flowupLabels, placeholder, plugin, javascript, jquery' />
<meta description='flowupLabels.js augments the labels in your HTML forms to behave like placeholders, but with a twist.' />
	
	<!-- Load the CSS -->
<link href='http://fonts.googleapis.com/css?family=Cantarell:400,700' rel='stylesheet' type='text/css'>
<link href="css/main_login.css" rel='stylesheet' type='text/css'>
<link href="css/jquery.FlowupLabels.css" rel='stylesheet' type='text/css'>


<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<?php
  if($_SESSION["kanri_flg"]=="1"){
    include("admenu.html");
  }else{
    include("menu.html");
  }
?>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div>ようこそ<? echo $_SESSION["name"] ?>さん</div>
    <div class="container jumbotron"><?=$view?></div>
  </div>
</div>
<!-- Main[End] -->
	<script src='js/jquery.min.js'></script>
	<script src='js/jquery.FlowupLabels.js'></script>
	<script src='js/main.js'></script>

</body>
</html>
