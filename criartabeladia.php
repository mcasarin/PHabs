<?php

//Server Local - NitCabs
$servername = "IP ou Nome";
$username = "user";
$password = "senha";
$dbname = "dbname";

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
$diaposterior = "d".(date("dmY",strtotime("+1 day")));
echo $diaposterior."<br>";

$sql = $conn_local->query("create table $diaposterior as select * from $diatual limit 0");
if($sql){
	echo "<h2><b>Tabela criada!</h2>";
} else {
	echo "<h2><b>Falha na criação da tabela do DIA</h2><br>
	".mysqli_connect_error();
}
