<?php
include('db_connect.php');
session_start();

$result = array();

$doc = '';
if (!empty($_POST['doc']))
	$doc = $_POST['doc'];
else
	$doc = $_GET['doc'];

// $user = '';
// if (!empty($_POST['user']))
// 	$user = $_POST['user'];
// else
// 	$user = $_GET['user'];
$user = $_SESSION['user'];

$val = 0;
if (!empty($_POST['val']))
	$val = intval($_POST['val']);
else
	$val = intval($_GET['val']);

if ((abs($val) !== 1) || empty($user) || empty($doc)){
	echo '{ "result": "error", "value": "Valeur du vote ('.$val.'), utilisateur ('.$user.') ou référence document ('.$doc.') incorrect"}';
} else {
	// La valeur du vote est correcte

	$req = "SELECT login FROM etu WHERE login='".$user."';";
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

			$req = "SELECT valeur FROM avis WHERE etu='".$user."' AND doc='".$doc."';";
			$retour = db_query($req);

			if (($row = mysql_fetch_array($retour)) != 0){

				$req = "SELECT SUM(valeur) sum FROM avis WHERE etu='".$user."' AND doc='".$doc."';";
				$retour = db_query($req);
				$row2 = mysql_fetch_array($retour);

				echo '{ "result": "success", "rank": '.$row2['sum'].', "user_rank": '.$row['valeur'].'}';
			} else {
				echo '{ "result": "error", "value": "Une requete interne a echoue"}';
			}
		} else {
			echo '{ "result": "error", "value": "Temps trop court entre deux votes, il faut attendre !"}';
		}

	}


}
?>