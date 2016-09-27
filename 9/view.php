<?php
include("functions.php");
//0.外部ファイル読み込み


//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table01 ORDER BY id DESC LIMIT 10 ;;");
$status = $stmt->execute();

    if($status==false){
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる

$text="";
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $id = $result["id"];
        $bookname = $result["bookname"];      
        $allbookpage = $result["allbookpage"];
        $bookpage =    $result["bookpage"];
        $difference = ($result["allbookpage"] - $result["bookpage"])/$result["allbookpage"]*100;
        $all = $result["bookpage"];
        $currnt = $result["allbookpage"]-$result["bookpage"];
        $book_start_dairy = $result["book_start_dairy"];
        $book_finish_dairy = $result["book_finish_dairy"];
          $edit ="";
          $edit .='<a href="detail.php?id='.$result["id"].'">';
          $edit .='[編集]';
          $edit .='</a>';
          $del ="";
          $del .='<a href="delete.php?id='.$result["id"].'">';
          $del .='[削除]';
          $del .='</a><br>';    

      $text ='<table class="type04">';
      $text .='<tr>';
      $text .='<th>No</th>';
      $text .='<th>書籍名</th>';
      $text .='<th>読書量</th>';
      $text .='</tr>';
      
      $text .='<tr>';
      $text .='<td>'.$result["id"].'</td>';
      $text .='<td>'.$result["bookname"].'</td>';
      $text .='<td>'.$result["bookpage"].'</td>';
      $text .='</tr>';
      
      $text ='</table>';      
//        $tables= '<table class="type04">
//        <tr><th>No</th><th>書籍名</th><th>読書量</th></tr>
//        <tr><td>'.$result["id"].'</td><td>'.$result["bookname"].'</td><td>'.$result["bookpage"].'</td></tr>
//        </table>';
    }
}
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

<?=$text ?>

</body>
</html>