<?php
/*
copyright @ medantechno.com
2017
*/
require_once('./line_class.php');
$channelAccessToken = 'Abf5CfWYGgqG5gPpxE17p66IcsC/efbowOC98tn6msKqQ2/JF/m27SI5i++mxlgZQ5EFtpPvtgZIFUrOou4w+HaVtZGR2S1g/FulhouwMFkXI+CQ6ECv1PFedqqJXNPLcw4O0DiYQ3/Ov9rCYJQqWQdB04t89/1O/w1cDnyilFU='; //sesuaikan
$channelSecret = '908dadf7b1657fe506af66a71f3a8a92';//sesuaikan
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
//var_dump($client->parseEvents());
//$_SESSION['userId']=$client->parseEvents()[0]['source']['userId'];
/*
{
  "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
  "type": "message",
  "timestamp": 1462629479859,
  "source": {
    "type": "user",
    "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
  },
  "message": {
    "id": "325708",
    "type": "text",
    "text": "Hello, world"
  }
}
*/
$userId 	= $client->parseEvents()[0]['source']['userId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];
$profil = $client->profil($userId);
$pesan_datang = $message['text'];
//pesan bergambar
if($message['type']=='text')
{
	if($pesan_datang=='1')
	{

		$get_sub = array();
		$aa =   array(
						'type' => 'image',
						'originalContentUrl' => 'https://spice-shelf.sakura.ne.jp/LINE/oil.png',
						'previewImageUrl' => 'https://spice-shelf.sakura.ne.jp/LINE/oil.png'

					);
		array_push($get_sub,$aa);
		$get_sub[] = array(
									'type' => 'text',
									'text' => 'こんにちは '.$profil->displayName.'さん, 現在のオリーブオイルの残量は55.3%です。関連情報はhttp://u0u1.net/BLKr です。'. date('Y-m-d H:i:s')
								);

		$balas = array(
					'replyToken' 	=> $replyToken,
					'messages' 		=> $get_sub
				 );
	}
	else
	if($pesan_datang=='2')
	{
		$get_sub = array();
		$aa =   array(
						'type' => 'image',
						'originalContentUrl' => 'https://spice-shelf.sakura.ne.jp/LINE/pepper.png',
						'previewImageUrl' => 'https://spice-shelf.sakura.ne.jp/LINE/pepper.png'

					);
		array_push($get_sub,$aa);
		$get_sub[] = array(
									'type' => 'text',
									'text' => 'こんにちは '.$profil->displayName.'さん, 現在のこしょうの残量は55.3%です。関連情報はhttp://u0u1.net/BLKr です。'. date('Y-m-d H:i:s')
								);

		$balas = array(
					'replyToken' 	=> $replyToken,
					'messages' 		=> $get_sub
				 );
		/*
		$alt = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array(
										'type' => 'text',
										'text' => 'Anda memilih menu 2, harusnya gambar muncul.'
									)
							)
						);
		*/
		//$client->replyMessage($alt);
	}
	else
	if($pesan_datang=='3')
	{
		$get_sub = array();
		$aa =   array(
						'type' => 'image',
						'originalContentUrl' => 'https://spice-shelf.sakura.ne.jp/LINE/soruce.png',
						'previewImageUrl' => 'https://spice-shelf.sakura.ne.jp/LINE/soruce.png'

					);
		array_push($get_sub,$aa);
		$get_sub[] = array(
									'type' => 'text',
									'text' => 'こんにちは '.$profil->displayName.', ソースの残量は55.3%です。関連情報はhttp://u0u1.net/BLKr です。.'
								);

		$balas = array(
					'replyToken' 	=> $replyToken,
					'messages' 		=> $get_sub
				 );

	}
	else
	if($pesan_datang=='4')
	{

		$balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array(
										'type' => 'text',
										'text' => 'Jam Server Saya : '. date('Y-m-d H:i:s')
									)
							)
						);

	}
	else
	if($pesan_datang=='6')
	{

		$balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array(
										'type' => 'location',
										'title' => 'Lokasi Saya.. Klik Detail',
										'address' => 'Medan',
										'latitude' => '3.521892',
										'longitude' => '98.623596'
									)
							)
						);

	}
	else
	if($pesan_datang=='7')
	{

		$balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array(
										'type' => 'text',
										'text' => 'Testing PUSH pesan ke anda'
									)
							)
						);

		$push = array(
							'to' => $userId,
							'messages' => array(
								array(
										'type' => 'text',
										'text' => 'Pesan ini dari medantechno.com'
									)
							)
						);


		$client->pushMessage($push);

	}
	else{
		$balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array(
										'type' => 'text',
										'text' => 'こんにちは '.$profil->displayName.'さん。自宅の調味料棚のセンサー番号を入力して下さい。 '
									)
							)
						);

	}
}else if($message['type']=='sticker')
{
	$balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array(
										'type' => 'text',
										'text' => 'Terimakasih stikernya... '

									)
							)
						);

}

$result =  json_encode($balas);
//$result = ob_get_clean();
file_put_contents('./balasan.json',$result);
$client->replyMessage($balas);
