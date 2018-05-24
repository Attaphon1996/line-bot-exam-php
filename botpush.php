<?php



require "vendor/autoload.php";

$access_token = '1xRbg9ZC/ZDa9yTUfcsnca6+776kRaRV1SYOHEHLVsAdGVroKwefKlR48C1O/hVTYQtcDqujTEyK8McaiqaoudaL2BsAUxbf91jJkxnyrTYlDTB8hSBtAMm/uASSo6WDt9KbKjPl0ZbI9fpU6mNqMgdB04t89/1O/w1cDnyilFU=';
$channelSecret = '11c8e5f96b7d59d300b100092b5834d3';

$pushID = ['U1b6de0ae915180340652adccba3e084f','U20b47d150d50b896bbbf53bddbfa601a'];

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');

$response = $bot->pushMessage($pushID[0], $textMessageBuilder);
$response = $bot->pushMessage($pushID[1], $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







