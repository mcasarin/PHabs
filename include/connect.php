<?php
include "config.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
    echo "Necessário configurar o servidor, não foi possível conectá-lo!<br>";
    sleep(2);
    header('Location: formconfig.php');
    die("Connection failed: " . $conn->connect_error);
}
if($servername == '192.168.0.3'){
    $serverType = "<div style='color:#ff0000;background:#ffff80;margin:5px;text-align: center;'>    ---    Conectado em homologação    ---    Conectado em homologação    ---    Conectado em homologação    ---    </div>";
}
?>
