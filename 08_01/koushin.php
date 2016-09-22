<?php
include("functions.php");
//1.GETでidを取得
$id = $_GET["id"];
echo $id;

//2.DB接続など
$pdo = db_con();

//3.SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table01 WHERE id=:id");//変えます！！
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
queryError($stmt); //27行目でstmt に値を渡しているので、いれる必要がある。
}else{
 $row = $stmt->fetch();   
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>書籍データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select01.php">データ一覧</a></div>
  </nav>
</header>
<form method="post" action="update01.php">
  <div class="jumbotron">
   <fieldset>
    <legend>読書量データ入力ページ</legend>
     <label>全ページ数：<input type="text" name="allbookpage" value="<?=$row["allbookpage"]?>"></label><br>
     <label>読了ページ数：<input type="text" name="bookpage" value="<?=$row["bookpage"]?>"></label><br>
     <label>読書開始日：<input type="text" name="book_start_dairy" value="<?=$row["book_start_dairy"]?>"></label><br>
     <label>読書終了予定日：<input type="text" name="book_finish_dairy" value="<?=$row["book_finish_dairy"]?>"></label><br>
     <label>感想コメント：
     <select name="book_cmt">
    <option value="<?=$row["book_cmt"]?>">面白い</option>
    <option value="<?=$row["book_cmt"]?>">まあまあ</option>
    <option value="<?=$row["book_cmt"]?>">つまらない</option>
    </select>
    </label><br>
     <input type ="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!--
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍一覧</legend>
     <label>書籍名：<input type="text" name="bookname" value="<?=$row["bookname"]?>"></label><br>
     <label>書籍URL：<input type="text" name="book_url" value="<?=$row["book_url"]?>"></label><br>
     <label>書籍コメント：
     <select name="book_cmt">
    <option value="<?=$row["book_cmt"]?>">面白い</option>
    <option value="<?=$row["book_cmt"]?>">まあまあ</option>
    <option value="<?=$row["book_cmt"]?>">つまらない</option>
    </select>
    </label><br>
     <input type ="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
-->
<!-- Main[End] -->


</body>
</html>






