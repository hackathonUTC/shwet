<?php
include('db_connect.php');

$result = array();

if (!empty($_POST['branche']))
	$req = "SELECT d.uv, COUNT(*) AS count FROM docs d, uvbranche b WHERE branche=".$_POST['branche']." AND d.uv=b.uv GROUP BY d.uv ORDER BY d.uv";
else
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