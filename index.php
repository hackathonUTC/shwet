<?php
//On importe la classe de messages
include_once("classes/Messages.class.php");

$redirection = false;
//On vérifie/fait la connexion
include_once('connection_manager.php');
 
// //On se connecte à MySQL
// include_once("classes/Db.class.php");
// $bdd = DB::connect();


if ( !empty($_POST['form']) && !empty($_GET['page']) && is_file('pages/forms/'.$_GET['page'].'.php')) {

	include 'pages/forms/'.$_GET['page'].'.php';

} else if (!$redirection) {
	//On inclut l'entête
	include 'pages/header.php';

	//Les éventuels messages
	Messages::echo_future();

	//On inclut la page s'il existe et s'il est spécifié
	if (!empty($_GET['page']) && is_file('pages/'.$_GET['page'].'.php'))
	{
	    include 'pages/'.$_GET['page'].'.php';
	}
	else
	{
	    include 'pages/shwet.php';
	}
	 
	//On inclut le pied de page
	include 'pages/foot.php';
}
 
// //On ferme la connexion à MySQL
// DB::close();

// header('Location: shwet.php');