<?php
session_start();
require_once 'CONF.class.php';
require_once 'CAS.class.php';

if ( !isset($_SESSION['user'])){
	$user = CAS::authenticate();
	if ($user != -1) {
		// On revient du CAS et on a bien récupéré les infos :)

		// echo "Connecté";
		// echo $user;
		$_SESSION['user'] = $user;
		$_SESSION['ticket'] = $_GET['ticket'];
		header('Location: shwet.php');
	}
	else {
		// L'user n'est pas connecté et ne revient pas du CAS, donc on l'envoie là-bas
		CAS::login();
	}
}