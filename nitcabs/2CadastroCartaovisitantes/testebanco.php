<?php
// base teste 
/*
$conecta = mysql_connect("192.168.0.14", "root", "") or print (mysql_error()); 
mysql_select_db("churchill",$conecta);

//-------------------------------------------------------------------------------------------------------*/

// base valendo
$conecta = mysql_connect("192.168.0.100", "root", "mysqlbanco") or print (mysql_error()); 
mysql_select_db("nitcabs",$conecta);

//-------------------------------------------------------------------------------------------------------*/
/*
//teste no churchill 00
$conecta = mysql_connect("192.168.0.14", "root", "") or print (mysql_error()); 
mysql_select_db("altera",$conecta);


//print "Conexão OK!"; 
//mysql_close($conecta); 
*/
?>