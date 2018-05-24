<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = '1xRbg9ZC/ZDa9yTUfcsnca6+776kRaRV1SYOHEHLVsAdGVroKwefKlR48C1O/hVTYQtcDqujTEyK8McaiqaoudaL2BsAUxbf91jJkxnyrTYlDTB8hSBtAMm/uASSo6WDt9KbKjPl0ZbI9fpU6mNqMgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			//$text = $event['source']['userId'];
			$text = "รับแจ้งเตือนแล้วครับ";
			$file = fopen("vardump.txt", "r");
$members = explode("\n", file_get_contents("vardump.txt"));
fclose($file);

$userid = $members;
array_push($userid,$event['source']['userId']);
$userid = array_unique($userid);
$useridstring = "";
for( $i = 0;$i<count($userid);$i++){
	if($i == 0 ){
		$useridstring = $useridstring.$userid[$i];
	}
	else{
		$useridstring = $useridstring."\n".$userid[$i];
	}
}
$fp = fopen('vardump.txt', 'w');
fwrite($fp,$useridstring );
fclose($fp);
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
