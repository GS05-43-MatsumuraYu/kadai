<?php

require_once('./line_class.php');

$channelAccessToken = ''; //sesuaikan
$channelSecret = '';//sesuaikan
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

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
	}
	else
	if($pesan_datang=='3')
	{
		$get_sub = array();
		$aa =   array(
			{
				'type' => 'template',
				'altText' => 'this is a confirm template',
					'template': {
				'type' => 'confirm',
				'text' => 'Are you sure?',
					'actions': [
							{
				'type' => 'confirm',
				'label' => 'Yes',
				'text' => 'yes',
							},
							{
								'type' => 'confirm',
								'label' => 'No',
								'text' => 'no',
							}
					]
					}
				}
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
