<?php
include('db_connect.php');

$result = array();

$req = "SELECT * FROM uvbranche b WHERE b.uv='".$_POST['uv']."';";

$retour = db_query($req);

while (($row = mysql_fetch_array($retour)) != 0) {
	$uv = array (
		'branche' => $row["branche"],
		'uv' => $row["uv"],
		'titreuv' => $row["titreuv"]
		);

	array_push($result, $uv);
}

// var_dump($result);
echo json_encode($result);
?>