<?php
include('db_connect.php');

$result = array();

$req = "SELECT * FROM uvbranche b, docs d WHERE d.uv=b.uv AND b.uv='".$_POST['uv']."';";

$retour = db_query($req);

$row = mysql_fetch_array($retour);

$result = array (
		'branche' => $row["branche"],
		'uv' => $row["uv"],
		'titreuv' => $row["titreuv"],
		'id' => $row["id"],
		'type' => $row["type"],
		'nom' => $row["nom"],
		'extension' => $row["extension"]
	);

// var_dump($result);
echo json_encode($result);
?>