<?php

//Server Local - NitCabs
$servername = "192.168.0.100";
$username = "root";
$password = "mysqlbanco";
$dbname = "nitcabs";

// Create connection
$conn_local = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
{
        echo "Failed to connect to MySQL - Churchill local: " . mysqli_connect_error();
}

if (!mysqli_set_charset($conn_local, "latin1")) {
    printf("Error loading character set latin1: %s\n", mysqli_error($conn_local));
    exit();
}


$sql = $conn_local->query("insert into rede1 (cartao,matricula,id) select distinct cartao,matricula,id from usuarios;");
if($sql){
	echo "<h2><b>Matriculas, ID e cartões copiados!</h2>";
} else {
	echo "<h2><b>Falha na copia das Matriculas, ID e cartões copiados</h2>";
}

$sqlupdate = $conn_local->query("update rede1 set remota1='SNN', remota2='SNN', remota3='SNN', remota4='SNN', remota5='SNN', remota6='SNN', remota7='SNN', remota8='SNN', remota9='SNN', remota10='SNN', remota11='SNN', remota12='SNN', remota13='SNN', remota14='SNN', remota15='SNN', remota16='SNN', remota17='SNN', remota18='SNN', remota19='SNN', remota20='SNN', remota21='SNN', remota22='SNN', remota23='SNN', remota24='SNN', remota25='SNN', remota26='SNN', remota27='SNN', remota28='SNN', remota29='SNN', remota30='SNN', remota31='SNN', campo1='', campo2='', campo3='', campo4='', campo5='', campo6='', campo7='', campo8='';");
if($sqlupdate){
	echo "<h2><b>Permissões de catracas atualizadas!</b></h2>";
} else {
	echo "<h2><b>Falha na atualização de permissões de catracas</b></h2>";
}