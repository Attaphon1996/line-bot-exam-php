<?php

require "vendor/autoload.php";
header('Access-Control-Allow-Origin: *');
if (isset($_GET['stationid'])) {
	$stationid = $_GET['stationid'];
	$modeold = $_GET['modeold'];
	$modenew = $_GET['modenew'];
	$data = "Station : ".$stationid." Change Mode From ".$modeold." To ".$modenew;
	echo $data;
	$access_token = '1xRbg9ZC/ZDa9yTUfcsnca6+776kRaRV1SYOHEHLVsAdGVroKwefKlR48C1O/hVTYQtcDqujTEyK8McaiqaoudaL2BsAUxbf91jJkxnyrTYlDTB8hSBtAMm/uASSo6WDt9KbKjPl0ZbI9fpU6mNqMgdB04t89/1O/w1cDnyilFU=';
	$channelSecret = '11c8e5f96b7d59d300b100092b5834d3';

	$pushID = ['U1b6de0ae915180340652adccba3e084f','U20b47d150d50b896bbbf53bddbfa601a'];

	$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
	$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

	$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($data);
	$file = fopen("vardump.txt", "r");
	$members = array();

	while (!feof($file)) {
	   $members[] = fgets($file);
	}

	fclose($file);
	$userid = $members;
	for($i=1;$i<count($userid);$i++){
		$response = $bot->pushMessage($userid[$i], $textMessageBuilder);
	}
	echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
}






