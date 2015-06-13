<?php
include('db_connect.php');

$result = array();

$req = "SELECT uv, COUNT(*) AS count FROM docs GROUP BY uv ORDER BY uv";

$retour = mysql_query($req);

while (($row = mysql_fetch_array($retour)) != 0) {
	$uv = array (
		'uvname' => $row['uv'],
		'nbdocs' => $row['count']
		);

	array_push($result, $uv);
}

echo json_encode($result);
?>