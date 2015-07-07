<?php
include_once 'config.php';

$db = mysql_select_db(DBNAME, mysql_connect(DBHOST,DBUSER,DBPSWD));
if (mysql_errno()>0) {
	echo("Impossible d'ouvrir la base sql");
	echo(mysql_error());
}

mysql_set_charset("utf8");
mysql_query("set client_encoding to UTF8");
// mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8'");

function db_query($query){
	if (DBHOST == "localhost")
		echo $query."<br>";

	$ret = mysql_query($query);

	if (mysql_errno()>0) {
		echo("Erreur".mysql_error()."' ");
	} else {
		return $ret;
	}

	return FALSE;
}

function db_action_autorisee($user){
	$req = "SELECT * FROM etu WHERE login='".$user."' AND (lastAction + INTERVAL 1 MINUTE)<NOW();";
	$retour = db_query($req);

	if (($row = mysql_fetch_array($retour)) != 0){
		return true;
	} else {
		return false;
	}
}

function db_action_done($user){
	db_query("UPDATE etu SET lastAction=NOW() WHERE login='".$user."';");
}
