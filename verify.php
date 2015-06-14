<?php
session_save_path('sess');
session_start();
require_once 'CAS.class.php';
if (!isset($_SESSION['user']))
{
	$user = CAS::authenticate();
	if ($user != -1) $_SESSION['user'] = $user;
}
if (isset($_SESSION['user']))
{
	require_once 'MAJ.class.php';
}
else CAS::login();
?>
