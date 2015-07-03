<?php
include('db_connect.php');

$result = array();

$uv = '';
if (!empty($_POST['uv']))
	$uv = $_POST['uv'];
else
	$uv = $_GET['uv'];

$req = "SELECT * FROM docs WHERE uv='".$uv."' ORDER BY type;";

$retour = db_query($req);

while (($row = mysql_fetch_array($retour)) != 0) {
	$uv = array (
		'id' => $row['id'],
		'uv' => $row['uv'],
		'type' => $row['type'],
		'nom' => $row['nom'],
		'extension' => $row['extension'],
		'note' => $row['note'],
		'semestre' => $row['semestre'],
		'etu' => $row['etu'],
		);

	array_push($result, $uv);
}
// var_dump($result);
echo json_encode($result);
?>