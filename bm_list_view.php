<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成 
//問題　最新の５件のみを表示するsqlに変更してブラウザに表示する
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY indate DESC LIMIT 5 ;");
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
      $text .='<tr>';
      $text .= '<td bgcolor="#EE0000">'."No". '<td>'.$result["indate"].'</td></td>';
      $text .= '<td>'.$result["bookname"].'</td>';
      $text .= '<td>'.$result["book_url"].'</td>';
      $text .= '</tr>';
  }
        
//  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
//    $view .= $result["indate"]."<br>".$result["bookname"]."<br>".$result["book_url"]."<br>";
//  }//FETCHがデータを渡す関数 1レコードづつ、10回勝手に回ってくれる！どのフィールド名から値をとるか

}

function linkify($text) {
    $tableInner = '/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+' .
               '|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?P<path>\/[\+~%\/.\w-_]*)?' .
               '\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/';
    return preg_replace_callback(
    $tableInner,
        function ($matches) {
            return sprintf(
                '<a href="%1$s" target="_blank">' .
                 (!preg_match('/\.(jpg|gif|png)$/i', $matches['path']) ? '%1$s' : '<img src="%1$s" alt="" />') .
                '</a>',
                $matches[0]
            );
        },
        $text
    );
}

//echo linkify($text);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマークリスト画面</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery.circliful.css">

<style>
div{padding: 10px;font-size:16px;}
    
table{table-layout: fixed;
    border:1px solid black;
	font-size:10pt;
    margin-left: 30px;
    }
th, td {
	margin: 0;
	padding: 0;
	width: 150px;
	height: 14pt;
	border:1px solid black;
}

#mycanvas   {
    margin-left: 70px;        
        
    }
    
</style>

</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="bm_insert_view.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<table>
<?= $text ?>
</table>

<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js">
</script>

<script>
$(document).ready(function(){
    $('.myStat').circliful();
});
</script>

<div class="myStat" data-text="35%"></div>


<canvas id="mycanvas" height="600" width="400"></canvas>
<script>
var data = [
 {
  value: 300,
  color:"#F7464A",
  highlight: "#FF5A5E",
  label: "Red"
 },
 {
  value: 50,
  color: "#46BFBD",
  highlight: "#5AD3D1",
  label: "Green"
 },
 {
  value: 100,
  color: "#FDB45C",
  highlight: "#FFC870",
  label: "Yellow"
 }
];
 
var myChart = new Chart(document.getElementById("mycanvas").getContext("2d")).Doughnut(data);    
</script>*/

<div class="myStat"></div>
<script src="js/jquery.circliful.js"></script>
<script src="js/jquery.circliful.min.js"></script>
-->
    </body>
</html>
