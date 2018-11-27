<?php
require ('connect.php');
if (!isset($_SESSION)) session_start();
    $usuario=$_SESSION["usuario"];
	$date = date('Y-m-d');
	$hora = date('H:i:s');
	$sqllog = "INSERT INTO logoper (Operador,Operacao,Data,Hora,Terminal) VALUES ('$usuario','Saiu do PHabs','$date','$hora','$terminal')";
	$execlog = $conn->query($sqllog);
session_destroy();
$conn->close();
header('Location: ../index.php');
?>