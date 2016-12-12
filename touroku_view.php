<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
<link rel="stylesheet" href="css/range.css">
<link rel="stylesheet" href="css/style.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>調味料を登録する</title>
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
    <legend>調味料登録ページ</legend>
     <label>調味料の名前：<input type="text" name="bookname"></label><br>
     <label>現在の容量：<input type="text" name="allbookpage"><span class="js-board"></span></label><br>
     <label>賞味期限：<input type="date" name="book_start_dairy"></label><br>
     <input type ="hidden" name="id" value="<?=$id?>">
     <input type ="hidden" name="sensorId" value="">

     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>

	<script src='js/jquery.min.js'></script>
	<script src='js/jquery.FlowupLabels.js'></script>
	<script src='js/main.js'></script>

  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://cdn.mlkcca.com/v0.6.0/milkcocoa.js"></script>
  <script>
  $(function(){
      var milkcocoa = new MilkCocoa('zooiv4gg5gp.mlkcca.com');
      var chatDataStore = milkcocoa.dataStore('esp8266/tout');
      var history = milkcocoa.dataStore('esp8266/tout').history();
      history.sort('DESC'); //ASC昇順、DESC降順
      //history.size(1);//表示されていく数
      history.size(1);
      history.limit(5);
      var i = 0;
      history.on('data', function(data) {
            data.forEach(function(d){
              console.log('d:', d);
              var key = Object.keys(d.value)[0]; // "3"
              $('#sensorId').val(key);
              //履歴表示で文字を加工する場合はここに記入
              $('.js-board').eq(i++).html(JSON.stringify(d.value));
            });
      });
      history.run();
  });
      </script>

</body>
</html>
