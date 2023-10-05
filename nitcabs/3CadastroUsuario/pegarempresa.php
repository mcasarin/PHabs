<?php 
require ("testebanco.php");
$empresa = mysql_query("SELECT * FROM empresas where empresa like '95 - %' ");

while($l = mysql_fetch_array($empresa))
{
	$bloco = $l["Bloco"];
	$andar = $l["Andar"];
	$email = $l["email"];
}

//$ids = $id + 1;
echo "$bloco <br>$andar <br>$email <br> ";
?>