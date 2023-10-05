<?php
include_once '../include/connect.php';

$buscaar = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
$sql = "SELECT * FROM corr_devolucoes WHERE registroar like '%$buscaar%' ORDER BY dataInfo DESC limit 5;";

$resultado_busca = $conn->query($sql);
if(($resultado_busca) and ($resultado_busca->num_rows != 0)){
    while($row = $resultado_busca->fetch_array(MYSQLI_ASSOC)){
        echo "<tr><td>".$row['registroar']."</td><td>".$row['dataInfo']."</td><td>".$row['conjunto']."</td><td>".$row['motivo']."</td><td><a href='".$row['imgpath']."' target='_blank'><img src='".$row['imgpath']."' width='150' height='60'></a></td></tr>";
    }
} else {
    echo "<div class='alert alert-dark' role='alert'>Nenhum resultado encontrado.</div><br>
    <a href='buscaEntrada.php' class='btn btn-warning btn-sm'> Voltar </a>";
}
?>