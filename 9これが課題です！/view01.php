<?php
session_start();
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成 
//問題　最新の５件のみを表示するsqlに変更してブラウザに表示する
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table01 ORDER BY id DESC LIMIT 10 ;;");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
    $text = '';
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){

        $id = $result["id"];
        $bookname = $result["bookname"];      
        $allbookpage = $result["allbookpage"];
        $bookpage =    $result["bookpage"];
//        $difference = ($result["allbookpage"] - $result["bookpage"])/$result["allbookpage"]*100;
        $all = $result["bookpage"];
        $currnt = $result["allbookpage"]-$result["bookpage"];
        $book_start_dairy = $result["book_start_dairy"];
//        $book_finish_dairy = $result["book_finish_dairy"];
          $edit ="";
          $edit .='<a href="select01.php?">';
          $edit .='[編集]';
          $edit .='</a>';
      $text .='<tr>';
      $text .='<td>'.$result["id"].'</td>';
      $text .='<td>'.$result["bookname"].'</td>';
      $text .='<td><a href="select01.php?id='.$result["id"].'">詳しく見る</a></td>';//ここのコードは正しくないから？
      $text .='</tr>';
        
  }
}

//echo linkify($text);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<link rel="stylesheet" href="css/range.css">
<link rel="stylesheet" href="css/style.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>読書量表示</title>
<style>div{padding: 10px;font-size:16px;}</style>
</head>

<body id="inner">
    <header class="header">
        <div class="inner clearfix">
            <h1 class="site-title">サービスロゴ</h1>
    </header>
</div>
        <form>
			<div class='wrap'>
<input type="button" value="新規登録" onClick="location.href='touroku_view.php?'">

			</div>
    </form>
<table class="type04">
<tr><th>No</th><th>書籍名</th><th>読書量</th></tr>
<?=$text ?>
</table>
	<script src='js/jquery.min.js'></script>
	<script src='js/jquery.FlowupLabels.js'></script>
	<script src='js/main.js'></script>
</body>
</html>