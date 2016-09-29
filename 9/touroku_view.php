<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
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

<form method="post" action="touroku_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>読書量データ入力ページ</legend>
     <label>本の名前：<input type="text" name="bookname"></label><br>
     <label>全ページ数：<input type="text" name="allbookpage"></label><br>
     <label>読了ページ数：<input type="text" name="bookpage"></label><br>
     <label>読書開始日：<input type="text" name="book_start_dairy"></label><br>
     <label>読書終了予定日：<input type="text" name="book_finish_dairy"></label><br>
     <input type ="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>

	<script src='js/jquery.min.js'></script>
	<script src='js/jquery.FlowupLabels.js'></script>
	<script src='js/main.js'></script>

</body>
</html>