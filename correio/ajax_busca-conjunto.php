<?php
include_once '../include/connect.php';

$buscaar = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
$sql = "SELECT * FROM corr_devolucoes WHERE conjunto like '%$buscaar%' ORDER BY dataInfo DESC limit 5;";

$resultado_busca = $conn->query($sql);
if(($resultado_busca) and ($resultado_busca->num_rows != 0)){
    while($row = $resultado_busca->fetch_array(MYSQLI_ASSOC)){
        echo "<tr><td>".$row['registroar']."</td><td>".$row['dataInfo']."</td><td><strong>";
        if($row['conjunto'] == 'ni'){ 
            echo "Não identificado";
        }else{
            echo $row['conjunto'];
        }
        echo "</strong></td><td>".$row['motivo']."</td><td><a href='".$row['imgpath']."' target='_blank'><img src='".$row['imgpath']."' width='150' height='60'></a></td></tr>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}
?>