<?php
include_once '../include/connect.php';

$buscaar = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
$sql = "SELECT * FROM corr_entrada WHERE registroar like '%$buscaar%' ORDER BY dataInfo DESC limit 5;";

$resultado_busca = $conn->query($sql);
if(($resultado_busca) and ($resultado_busca->num_rows != 0)){
    while($row = $resultado_busca->fetch_array(MYSQLI_ASSOC)){
        echo "<tr><td>".$row['registroar']."</td><td>".$row['dataInfo']."</td><td>".$row['conjunto']."</td><td>".$row['nome']."</td><td>".$row['obs']."</td><td>".$row['disc']."</td><td>";
        if($row['imgpath'] = "sem imagem"){
            echo "<div class='alert alert-dark' role='alert'>Sem imagem</div>";
        } else {
            echo "<a href='".$row['imgpath']."' target='_blank'><img src='".$row['imgpath']."' width='150' height='60'></a>";
        }
        echo "</td></tr>"; 
    }
} else {
    echo "<div class='alert alert-dark' role='alert'>Nenhum resultado encontrado.</div><br>";
}
?>