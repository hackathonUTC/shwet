<?php
session_destroy();
require_once 'CAS.class.php';
CAS::logout();
?>
