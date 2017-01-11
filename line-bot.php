
<?php // callback.php
define("LINE_MESSAGING_API_CHANNEL_SECRET", '908dadf7b1657fe506af66a71f3a8a92');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'Wm9C54aMISVIfm5z3XmRDWdSfrqsBoRdIxvjqGkIJRo+f3vkSFKV60Of2V/87OsFQ5EFtpPvtgZIFUrOou4w+HaVtZGR2S1g/FulhouwMFluuQSRpl1Vi8U5beHpHTKtPM6I6C7QnFugOi97HH2QFAdB04t89/1O/w1cDnyilFU=');

require __DIR__."/../vendor/autoload.php";

$bot = new \LINE\LINEBot(
    new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN),
    ['908dadf7b1657fe506af66a71f3a8a92' => LINE_MESSAGING_API_CHANNEL_SECRET]
);

$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$body = file_get_contents("php://input");

$events = $bot->parseEventRequest($body, $signature);

foreach ($events as $event) {
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
        $reply_token = $event->getReplyToken();
        $text = $event->getText();
        $bot->replyText($reply_token, $text);
    }
}

echo "OK";

<?php
//
// use LINE\LINEBot\EchoBot\Dependency;
// use LINE\LINEBot\EchoBot\Route;
// use LINE\LINEBot\EchoBot\Setting;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

// $setting = Setting::getSetting();
// $app = new Slim\App($setting);
//
// (new Dependency())->register($app);
// (new Route())->register($app);
//
// $app->run();

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('<Wm9C54aMISVIfm5z3XmRDWdSfrqsBoRdIxvjqGkIJRo+f3vkSFKV60Of2V/87OsFQ5EFtpPvtgZIFUrOou4w+HaVtZGR2S1g/FulhouwMFluuQSRpl1Vi8U5beHpHTKtPM6I6C7QnFugOi97HH2QFAdB04t89/1O/w1cDnyilFU=>');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '<908dadf7b1657fe506af66a71f3a8a92>']);

// エントリーポイントへのリクエストをこの処理で受け取る
// リクエストヘッダー内のシグネチャを得る
$signature = $request->headers->get(HTTPHeader::LINE_SIGNATURE);

$bot = new LINEBot(new CurlHTTPClient('Wm9C54aMISVIfm5z3XmRDWdSfrqsBoRdIxvjqGkIJRo+f3vkSFKV60Of2V/87OsFQ5EFtpPvtgZIFUrOou4w+HaVtZGR2S1g/FulhouwMFluuQSRpl1Vi8U5beHpHTKtPM6I6C7QnFugOi97HH2QFAdB04t89/1O/w1cDnyilFU='), [
            'channelSecret' => '908dadf7b1657fe506af66a71f3a8a92',
        ]);

try {
    // Bodyと$signatureから内容をVerifyして成功すればEventを得られる
    $events = $bot->parseEventRequest($request->getContent(), $signature);
} catch (Exception $e) {
}

//応答可能なEventのみを得る//
$message_events = [];
foreach ($events as $event) {
    if (!($event instanceof MessageEvent) && !($event instanceof PostbackEvent)) {
        continue;
    }
    $message_events[] = $event;
}

//
// $columns = []; // カルーセル型カラムを5つ追加する配列
// foreach ($lists as $list) {
//     // カルーセルに付与するボタンを作る
//     $action = new UriTemplateActionBuilder("クリックしてね", /* まとめのURL */ );
//     // カルーセルのカラムを作成する
//     $column = new CarouselColumnTemplateBuilder("タイトル(40文字以内)", "追加文", /* 画像のURL(httpsのみ) */, [$action]);
//     $columns[] = $column;
// }
// // カラムの配列を組み合わせてカルーセルを作成する
// $carousel = new CarouselTemplateBuilder($columns);
// // カルーセルを追加してメッセージを作る
// $carousel_message = new TemplateMessageBuilder("メッセージのタイトル", $carousel);

?>
