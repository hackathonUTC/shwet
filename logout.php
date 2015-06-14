<?php
session_save_path('sess');
session_start();
$_SESSION = array();
require_once 'CAS.class.php';
CAS::logout();
?>
