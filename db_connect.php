<?php
$db = mysql_select_db("shwet", mysql_connect("localhost","root","root"));
if (mysql_errno()>0) {
	echo("Impossible d'ouvrir la base "+ERREUR);
	echo(mysql_error());
}
mysql_query("set client_encoding to UTF8");