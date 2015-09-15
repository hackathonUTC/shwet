<?php
include('db_connect.php');
session_start();

$result = array();

$uv = '';
if (!empty($_POST['uv']))
	$uv = $_POST['uv'];
else
	$uv = $_GET['uv'];

// $user = ''; // attention, le MD5 du pseudo !
// if (!empty($_POST['user']))
// 	$user = $_POST['user'];
// else
// 	$user = $_GET['user'];
$user = $_SESSION['user'];

$req = "SELECT *
			FROM docs d
			LEFT OUTER JOIN (
				SELECT SUM(a1.valeur) AS rank, doc FROM avis a1 GROUP BY doc
				) AS ta1 ON ta1.doc=d.id
			LEFT OUTER JOIN (
				SELECT a2.valeur AS user_rank, doc FROM avis a2 WHERE etu='".$user."' GROUP BY doc
				) AS ta2 ON ta2.doc=d.id
			WHERE uv='".$uv."' ORDER BY type, rank;";

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
		'rank' => $row['rank'],
		'user_rank' => $row['user_rank']
		);

	array_push($result, $uv);
}
// var_dump($result);
echo json_encode($result);
?>