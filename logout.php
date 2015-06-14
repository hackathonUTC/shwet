<?php
session_start();
session_destroy();
require_once 'CAS.class.php';
CAS::logout();
?>
