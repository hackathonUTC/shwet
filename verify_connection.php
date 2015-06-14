<?php
session_start();
require_once 'CONF.class.php';
require_once 'CAS.class.php';
$user = CAS::authenticate();
if ($user == -1){
	echo "pas connecté";
	header('Location: shwet.php');
	// CAS::login();
}