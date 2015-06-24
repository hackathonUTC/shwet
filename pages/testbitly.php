<?php
// $bitlyToken = "065780294ce966ffe28a68565273b9f35b442dc3";
// $APIadress = "https://api-ssl.bitly.com";
// $request = $APIadress."/v3/shorten?access_token=".$bitlyToken."&longUrl=".urlencode("http://www.google.com")."&format=txt";
// $data = file_get_contents($request);
// echo $request.'<br>';
// var_dump($data);
include_once('classes/Bitly.class.php');
echo(Bitly::shorten("http://www.mewen.fr"));
?>