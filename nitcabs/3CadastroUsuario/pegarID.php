<?php 
require ("testebanco.php");
$verid = mysql_query("SELECT max(ID) as id FROM usuarios");

while($l = mysql_fetch_array($verid))
{
	$id = $l["id"];
}

//$ids = $id + 1;
echo "&nbsp;&nbsp;&nbsp;Ultimo id = $id <br> ";
$id+=1;
echo "Proximo id = $id <br> ";
?>