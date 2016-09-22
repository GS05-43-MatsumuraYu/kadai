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

<form method="post" action="insert01.php">
  <div class="jumbotron">
   <fieldset>
    <legend>読書量データ入力ページ</legend>
     <label>全ページ数：<input type="text" name="allbookpage"></label><br>
     <label>読了ページ数：<input type="text" name="bookpage"></label><br>
     <label>読書開始日：<input type="date" name="book_start_dairy"></label><br>
     <label>読書終了予定日：<input type="date" name="book_finish_dairy"></label><br>
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


</body>
</html>






