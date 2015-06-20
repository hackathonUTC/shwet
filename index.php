<?php
//On vérifie/fait la connexion
include_once('connection_manager.php');
 
// //On se connecte à MySQL
// include_once("classes/Db.class.php");
// $bdd = DB::connect();

//On importe la classe de messages
include_once("classes/Messages.class.php");

//On inclut l'entête
include 'pages/header.php';

//On inclut le contrôleur s'il existe et s'il est spécifié
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
 
// //On ferme la connexion à MySQL
// DB::close();

// header('Location: shwet.php');