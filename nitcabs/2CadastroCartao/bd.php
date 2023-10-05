<?php
	$conecta = mysql_connect("192.168.0.16", "root", "") or print (mysql_error()); 
	mysql_select_db("Visitas",$conecta);
?>