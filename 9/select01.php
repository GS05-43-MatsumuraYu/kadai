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
        .$result["allbookpage"].'</th><th><a href="detail.php?id='.$result["id"].'">編集</a></th>
        <th><a href="delete.php?id='.$result["id"].'">削除</a></th></tr>
        <tr><th scope="row">読書量</th><th>'
        .$result["bookpage"].'</th><th><a href="detail.php?id='.$result["id"].'">編集</a></th>
        <th><a href="delete.php?id='.$result["id"].'">削除</a></th></tr><tr><th scope="row">読書開始日</th><th>'
        .$result["book_start_dairy"].'</th><th><a href="detail.php?id='.$result["id"].'">編集</a></th><th><a href="delete.php?id='.$result["id"].'">削除</a></th></tr><tr><th scope="row">読書終了予定日</th><th>'
        .$result["book_finish_dairy"].'</th><th><a href="detail.php?id='.$result["id"].'">編集</a></th><th><a href="delete.php?id='.$result["id"].'">削除</a></th></tr></table>';
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
            <h1 class="site-title">サービス一覧</h1>
            <div class="list-header text-right">
                </div>
    </header>
    <p>書籍名：<?= $id ?></p>
<!-- <div class="block-cource block-cource-lab clearfix">-->
<h3 class="cource-title text-center">読書量</h3>
<div class="chart">
    <canvas id="myChart" width="300" height="300"></canvas>
    <p class="ttl"><?= $difference ?>%</p>
</div>

<script>
(function(){
    var _data = [{value:91, color:"#80ceff"},{value:9, color:"#e7e7e7"}];
    var _obj = {
        segmentShowStroke : false,
		segmentStrokeColor : "#fff",
		segmentStrokeWidth : 9,
        percentageInnerCutout : 75,
        animation : true,
        animationSteps : 70,
        animationEasing : "easeOutQuart",
        animateRotate : true,
        animateScale : false,
        onAnimationComplete : null
    };
    
    var _chart = new Chart(document.getElementById("myChart").getContext("2d")).Doughnut(_data, _obj);
})();
</script>
</div>
</div>
<?=$table ?>

</body>
</html>