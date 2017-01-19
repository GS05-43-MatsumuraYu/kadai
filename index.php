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
 "text" => "85.5%"
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
