<?php
include('db_connect.php');

$result = array();

$req = "SELECT type, id, nom, extension FROM docs WHERE uv=".$_POST['uv'];

$retour = mysql_query($req);

while (($row = mysql_fetch_array($retour)) != 0) {
	$uv = array (
		'type' => $row['type'],
		'id' => $row['id'],
		'nom' => $row['nom'],
		'extension' => $row['extension']
		);

	array_push($result, $uv);
}

echo json_encode($result);
?>