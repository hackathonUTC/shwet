<?php
session_start();
delete $_SESSION["user"];

require_once 'CAS.class.php';
CAS::logout();
?>
