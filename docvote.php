<?php
include('db_connect.php');

$result = array();

$doc = '';
if (!empty($_POST['doc']))
	$doc = $_POST['doc'];
else
	$doc = $_GET['doc'];

$user = ''; // attention, le MD5 du pseudo !
if (!empty($_POST['user']))
	$user = $_POST['user'];
else
	$user = $_GET['user'];

$val = 0;
if (!empty($_POST['val']))
	$val = intval($_POST['val']);
else
	$val = intval($_GET['val']);

if ((abs($val) !== 1) || empty($user) || empty($doc)){
	echo 'erreur';
} else {
	// La valeur du vote est correcte

	$req = "SELECT login FROM etu WHERE MD5(login)='".$user."';";
	$retour = db_query($req);

	if (($row = mysql_fetch_array($retour)) == 0){
		echo "unknown user";
	} else {
		$user = $row['login'];

		if ( db_action_autorisee($user) ){
			db_action_done($user);

			$req = "INSERT INTO avis(doc, valeur, etu) VALUES ('".$doc."', ".$val.", '".$user."')
						ON DUPLICATE KEY UPDATE valeur=".$val.";";

			$retour = db_query($req);

			$req = "SELECT valeur FROM avis WHERE etu='".$user."';";
			$retour = db_query($req);

			if (($row = mysql_fetch_array($retour)) != 0){
				echo $row['valeur'];
			} else {
				echo "erreur : une requete interne a echoue";
			}
		} else {
			echo "faut attendre";
		}

	}


}
?>