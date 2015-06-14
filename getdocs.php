<?php
include('db_connect.php');

$result = array();

$req = "SELECT uv, type, id, nom, extension FROM docs WHERE uv='".$_POST['uv']."' ORDER BY type;";

$retour = db_query($req);

while (($row = mysql_fetch_array($retour)) != 0) {
	$uv = array (
		'uv' => $row['uv'],
		'type' => $row['type'],
		'id' => $row['id'],
		'nom' => $row['nom'],
		'extension' => $row['extension']
		);

	array_push($result, $uv);
}
// var_dump($result);
echo json_encode($result);
?>