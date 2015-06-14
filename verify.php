<?php
session_save_path('sess');
session_start();
require_once 'CAS.class.php';
if (!isset($_SESSION['user']))
{
	$user = CAS::authenticate();
	if ($user != -1) $_SESSION['user'] = $user;
}
else CAS::login();
?>
