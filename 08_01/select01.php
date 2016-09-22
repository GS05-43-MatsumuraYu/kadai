<?php
include("functions.php");
//0.外部ファイル読み込み


//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table01 ORDER BY indate DESC LIMIT 1 ;");
$status = $stmt->execute();

?>    

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js">
</script>
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link rel="stylesheet" href="css/style.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>

<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="touroku_view.php">データ登録</a>
    </div>
  </nav>
</header>
   <body>
            <div class="block-cource block-cource-lab clearfix">
                <div class="cource-img"><img src="img/01.png" alt=""></div>
                <div class="cource-txt cource-txt__usually">
                <h3 class="cource-title text-center">読書量</h3>
                <canvas id="pieArea" height="250" width="250"></canvas>
                <script>
            <!-- 円グラフ用データ -->
            var pieData = [
                {
                    value: 80,
                    color:"#FF0066"
                },
                {
                    value : 20,
                    color : "#CCCCCC"
                }
            ];
            <!-- 円グラフ描画 -->
            var myPie = new Chart(document.getElementById("pieArea").getContext("2d")).Pie(pieData);
        </script>
        </html>  
</div>
</div>
<?php
$result = $stmt->fetch(PDO::FETCH_ASSOC)
    $allbookpage = $result["allbookpage"];
    $bookpage = $result["bookpage"];
    $book_start_dairy = $result["book_start_dairy"];
    $book_finish_dairy = $result["book_finish_dairy"];
             
//更新ボタン         
          $edit ='<a href="detail01.php?id='.$result["id"].'">';
          $edit .='[編集]';
          $edit .='</a>';
          $del ='<a href="delete.php?id='.$result["id"].'">';
          $del .='[削除]';
          $del .='</a><br>';    
      
?>
<table class="type04">
	<tr><th scope="row">全体ページ数</th><th>'<?=$result['$allbookpage']?>'</th></tr>
    <tr><th scope="row">読書量</th><th>"<?=$row["bookpage"]?>"</th></tr>
    <tr><th scope="row">読書開始日</th><th>"<?=$row["book_start_dairy"]?></th></tr>
	<tr><th scope="row4">読書終了予定日</th><th>"<?=$row["book_finish_dairy"]?></th></tr>
</table>   
<!--
    <div class="container jumbotron"></div>
  </div>
-->
</div>
<!-- Main[End] -->

</body>
</html>
