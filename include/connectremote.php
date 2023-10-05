<?php
// Create connection
$connremote = new mysqli($remote, $usersite, $pass, $db);

mysqli_set_charset($connremote, "utf8");
// Check connection
if ($connremote->connect_error) {
  echo "Falha ao conectar ao banco de dados remoto!<br>";
  die("Connection failed: " . $connremote->connect_error);
}
