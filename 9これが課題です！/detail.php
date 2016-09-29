<?php
include("functions.php");
//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();

//3.SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table01 WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  $row = $stmt->fetch();
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

<form method="post" action="update01.php">
  <div class="jumbotron">
   <fieldset>
    <legend>読書量データ入力ページ</legend>
     <label>全ページ数：<input type="text" name="allbookpage" value="<?=$row["allbookpage"]?>"></label><br>
     <label>読了ページ数：<input type="text" name="bookpage" value="<?=$row["bookpage"]?>"></label><br>
     <label>読書開始日：<input type="text" name="book_start_dairy" value="<?=$row["book_start_dairy"]?>"></label><br>
     <label> 読書終了予定日：<input type="text" name="book_finish_dairy" value="<?=$row["book_finish_dairy"]?>"></label><br>
    </label><br>
     <input type ="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>


</body>
</html>






