<?php
session_save_path('sess');
session_start();
require_once 'CONF.class.php';
require_once 'CAS.class.php';
if (isset($_SESSION['user'])) require_once 'view/index.php';
else
{
	$user = CAS::authenticate();
	if ($user != -1)
	{
		$_SESSION['user'] = $user;
		$_SESSION['ticket'] = $_GET['ticket'];
		header('Location: shwet/shwet.php');
	}
	else CAS::login();
}
?>
