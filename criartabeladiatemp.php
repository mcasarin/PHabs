<?php

//Server Local - NitCabs
$servername = "192.168.0.3";
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

$diatual = "d".(date("dmY"));
echo $diatual."<br>";
$dianterior = "d".(date("dmY",strtotime("-1 day")));
echo $dianterior;

$sql = $conn_local->query("create table $diatual as select * from $dianterior limit 0");
if($sql){
	echo "<h2><b>Tabela criada!</h2>";
} else {
	echo "<h2><b>Falha na criação da tabela do DIA</h2>";
}
