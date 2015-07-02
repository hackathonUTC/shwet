<?php
include_once('config.php');

class Bitly {
	private static $APIadress = "https://api-ssl.bitly.com";

	private function Bitly (){
	}

	public static function shorten($url){
		$ctx = stream_context_create(array(
		    'http' => array(
		        'method' => "GET",
		        'proxy' => "tcp://proxyweb.utc.fr:3128",
		        'request_fulluri' => true,
		        ),
		    'ssl' => array(
		        'SNI_enabled' => true,
		        )
		    )
		);
		$request = self::$APIadress."/v3/shorten?access_token=".BITLYTOKEN."&longUrl=".urlencode($url)."&format=txt";
		// $data = file_get_contents($request);
		$data = file_get_contents($request, 0, $ctx);
		echo $data."<br>";
		return substr($data, 14, -1); // on ne retourne que ce qui est après http://bit.ly/
	}

};