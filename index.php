<?php
// =============lineへの表示部分==================

$accessToken = '/tQBM8qKMjlmk3Kxd8pIzfX9HfgFqLUDcK2EYFkgR/6GL2Hdx09z8Bxnwhx9bhNHQ5EFtpPvtgZIFUrOou4w+HaVtZGR2S1g/FulhouwMFmj76PnA9GgpEnWnXotMNdOBxYz2u8+D1Ha2Ry9W1zhsgdB04t89/1O/w1cDnyilFU=ISSUE';

//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);

$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
//メッセージ取得
$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
//ReplyToken取得
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

//メッセージ以外のときは何も返さず終了
if($type != "text"){
 exit;
}

//返信データ作成
$response_format_text2 = "";
$response_format_text3 = "";

if($text=="残量は？"){
 $response_format_text = [
 "type" => "text",
 "text" => "ttl1
 ];
}else{
 exit;
}

$post_data = [
"replyToken" => $replyToken,
"messages" => [$response_format_text]
];

$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
 'Content-Type: application/json; charser=UTF-8',
 'Authorization: Bearer ' . $accessToken
 ));
$result = curl_exec($ch);
curl_close($ch);

?>
// =============PHPのDB接続部分==================
<?php
session_start();
include("functions1.php");
$pdo = db_con();
//２．データ登録SQL作成
//$stmt = $pdo->prepare("SELECT * FROM gs_bm_table01");
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table01 ORDER BY id DESC LIMIT 1 ;;");
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

        $id = $result["id"];
        $bookname = $result["bookname"];
        $allbookpage = $result["allbookpage"];
        $bookpage =    $result["bookpage"];
//        $difference = ($result["allbookpage"] - $result["bookpage"])/$result["allbookpage"]*100;
        $all = $result["bookpage"];
        $currnt = $result["allbookpage"]-$result["bookpage"];
        $book_start_dairy = $result["book_start_dairy"];
//        $book_finish_dairy = $result["book_finish_dairy"];
          $edit ="";
          $edit .='<a href="select01.php?">';
          $edit .='[編集]';
          $edit .='</a>';
      $text .='<tr>';
      $text .='<td>'.$result["bookname"].'</td>';
      $text .='<td><span id="board"></span></td>';
      $text .='<td>'.$result["book_start_dairy"].'</td>';
      $text .='<td><a href="select01.php?id='.$result["id"].'">詳しく見る</a></td>';//ここのコードは正しくないから？
      $text .='</tr>';
  }
}
?>
// =============残量の計算==================

<script>
        $(function(){

        	var milkcocoa = new MilkCocoa('zooiv4gg5gp.mlkcca.com');
        	var chatDataStore = milkcocoa.dataStore('esp8266/tout');
        	var history = milkcocoa.dataStore('esp8266/tout').history();
        	history.sort('DESC'); //ASC昇順、DESC降順
        	history.size(1);
        	history.limit(20); // 20件
          var i = 0;
        	// 探したいキー値
        	var KEY = '1';
        	// 値が見つかったらtrueにする制御フラグ
        	var done = false;
        	// API結果を取得する.
        	history.on('data', function(data) {
        		data.forEach(function(d) {
        			// すでに取得済みなら何もしない
        			if (done) {
        				return;
        			}
        			// キー値を取得する。
        			var key = Object.keys(d.value)[0];
        			// 探しているキーの場合は、値を取得する。
        			if (key === KEY) {
        				done = true;
        				callback(key, d.value[key]);
        			}
        		});
        	});
        	// 値を見つけたら呼び出す関数
        	function callback(key, value) {
        		console.log('見つけたよ。key=' + key + ', value=' + value);
            var firstgram = "<?= $allbookpage ?>";
            var val = value; // 1
            console.log(val);
            var resultgram = Math.round((val/firstgram)*1000) / 10;
            // alert(resultgram);
        		$(".ttl1").append(resultgram);
            // $('ttl3').eq(i++).html(resultgram);
            // console.log(ttl3);
        	}
          history.run();
   });

</script>
