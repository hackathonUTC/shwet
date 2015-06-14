<?php
// session_save_path('sess');
session_start();
require_once 'CONF.class.php';
require_once 'CAS.class.php';
// if (isset($_SESSION['user'])){
// 	var_dump($_SESSION);
// 	header('Location: shwet.php');
// } else {
	$user = CAS::authenticate();
	if ($user != -1)
	{
		echo $user;
		$_SESSION['user'] = $user;
		$_SESSION['ticket'] = $_GET['ticket'];
		header('Location: shwet.php');
	}
	else CAS::login();
// }
?>
