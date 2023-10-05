<?php
include_once '../include/connect.php';
include_once '../include/function.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="../css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $buscaData = $_POST["buscaData"];
    $sql = "SELECT * FROM corr_devolucoes WHERE dataInfo like '%$buscaData%' ORDER BY dataInfo DESC;";

    $resultado_busca = $conn->query($sql);
    if(($resultado_busca) and ($resultado_busca->num_rows != 0)){
        echo "<table class=\"table table-responsive table-striped\">
            <thead>
                <tr><th>AR/Identificador</th><th>Data</th><th>Conjunto</th><th>Motivo</th><th>Imagem</th></tr>
            </thead>
            <tbody class=\"resultado\">";
        while($row = $resultado_busca->fetch_array(MYSQLI_ASSOC)){
            
            echo "<tr><td>".$row['registroar']."</td><td>".ordenaData($row['dataInfo'])."</td><td>".$row['conjunto']."</td><td>".$row['motivo']."</td><td><a href='".$row['imgpath']."' target='_blank'><img src='".$row['imgpath']."' width='150' height='60'></a></td></tr>";
            
        }
        echo "</tbody></table>";
    } else {
        echo "Nenhum resultado encontrado.";
    }
}
?>
</body>
</html>