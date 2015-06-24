<?php
include_once('config.php');

class Bitly {
	private static $APIadress = "https://api-ssl.bitly.com";

	private function Bitly (){
	}

	public static function shorten($url){
		$request = self::$APIadress."/v3/shorten?access_token=".BITLYTOKEN."&longUrl=".urlencode($url)."&format=txt";
		$data = file_get_contents($request);
		return substr($data, 14, -1); // on ne retourne que ce qui est après http://bit.ly/
	}

};