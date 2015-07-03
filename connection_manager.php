<?php
session_start();
require_once 'classes/CONF.class.php';
require_once 'classes/CAS.class.php';

if ( isset($_GET['page']) && $_GET['page']=='logout'){
	session_destroy();
	CAS::logout();
} else {
	if ( !isset($_SESSION['user'])){
		$user = CAS::authenticate();

		if ($user != -1) {
			// On revient du CAS et on a bien récupéré les infos :)

			// echo "Connecté";
			// echo $user;
			$_SESSION['user'] = $user;
			$_SESSION['ticket'] = $_GET['ticket'];
			$_SESSION['messages'] = '';

			// On ajoute l'utilisateur s'il n'y est pas déjà
			include('db_connect.php');
			$ret = db_query("SELECT COUNT(*) AS c FROM etu WHERE login='".$user."'");
			$ret = mysql_fetch_array($ret);
			$ret = intval($ret['c']);
			
			if ($ret === 0){
				db_query("INSERT INTO etu VALUES ('".$user."',NOW())");
			}

			Messages::future_info('Vous êtes bien connecté !');

			$redirection = true;
			header('Location: ?');
		}
		else {
			// L'user n'est pas connecté et ne revient pas du CAS, donc on l'envoie là-bas
			CAS::login();
		}
	}
}
