<?php
include('db_connect.php');

$result = array();

if (!empty($_POST['branche']))
	$req = "SELECT b.uv AS uv, b.titreuv AS nom, d.c AS count
			FROM uvbranche b
			LEFT OUTER JOIN (
				SELECT uv, COUNT( * ) AS c
				FROM docs
				GROUP BY uv
				)d ON d.uv = b.uv
			WHERE branche='".$_POST['branche']."'
			GROUP BY b.uv, b.titreuv
			ORDER BY b.uv;";
else
	$req = "SELECT b.uv AS uv, b.titreuv as nom, d.c AS count
			FROM uvbranche b
			LEFT OUTER JOIN (
				SELECT uv, COUNT(*) AS c
				FROM docs GROUP  BY uv
				) d ON d.uv=b.uv
			GROUP BY uv, nom
			ORDER BY uv;";

$retour = db_query($req);

while (($row = mysql_fetch_array($retour)) != 0) {
	$uv = array (
		'uvname' => $row['uv'],
		'uvtitre' => $row['nom'],
		'nbdocs' => $row['count']
		);

	array_push($result, $uv);
}
// var_dump($result);
echo json_encode($result);
?>
