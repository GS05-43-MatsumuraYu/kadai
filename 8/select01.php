<?php
include("functions.php");
//0.外部ファイル読み込み


//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table01");
$status = $stmt->execute();

?>    
<?php
    if($status==false){
    queryError($stmt); //27行目でstmt に値を渡しているので、いれる必要がある。

    }else{    
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result["id"];
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
        $table= '<table class="type04"><tr><th scope="row">全体ページ数</th><th>'
        .$result["allbookpage"].'</th><th><a href="detail.php?id='.$result["id"].'">編集</a></th><th><a href="delete.php?id='.$result["id"].'">削除</a></th></tr>
        <tr><th scope="row">読書量</th><th>'
        .$result["bookpage"].'</th><th><a href="detail.php?id='.$result["id"].'">編集</a></th><th><a href="delete.php?id='.$result["id"].'">削除</a></th></tr><tr><th scope="row">読書開始日</th><th>'
        .$result["book_start_dairy"].'</th><th><a href="detail.php?id='.$result["id"].'">編集</a></th><th><a href="delete.php?id='.$result["id"].'">削除</a></th></tr><tr><th scope="row">読書終了予定日</th><th>'
        .$result["book_finish_dairy"].'</th><th><a href="detail.php?id='.$result["id"].'">編集</a></th><th><a href="delete.php?id='.$result["id"].'">削除</a></th></tr></table>';
    }
?>
<?php
$res ="";
if(isset($_POST['bookpage'])){
    if($_POST['allbookpage']%2 == 1){
        $res = "80%";
    }else{
        $res = "70%";
    }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js">
</script>
<title>読書量表示</title>
<link rel="stylesheet" href="css/range.css">
<link rel="stylesheet" href="css/style.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>

<body id="main">
<!-- Head[Start] -->
<!--
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="touroku_view.php">データ登録</a>
    </div>
  </nav>
</header>
-->
  <p>書籍No:<?= $id ?> PHPとMySQLのツボとコツがゼッタイに分かる本</p>
   <body>
 <div class="block-cource block-cource-lab clearfix">
                <div class="cource-img"><img src="img/01.png" alt=""></div>
                <div class="cource-txt cource-txt__usually">
                <h3 class="cource-title text-center">読書量メーター</h3>
                <canvas id="pieArea" height="250" width="250"></canvas>
                <script>
            <!-- 円グラフ用データ -->
            var pieData = [
                {
                    value: <?= $all ?>,
                    color:"#FF0066"
                },
                {
                    value : <?= $currnt ?>,
                    color : "#CCCCCC"
                }
            ];
            <!-- 円グラフ描画 -->
            var myPie = new Chart(document.getElementById("pieArea").getContext("2d")).Pie(pieData);
        </script>
<h4>残り<?= $difference ?>%です。頑張りましょう。</h4>
</div>
</div>
<?=$table ?>
</body>
</html>
