<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include '../include/function.php';
include_once '../include/connect.php';
sessao();

/*
#   
#   Lista de devoluções Correio
#   data: 22jun23
#
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.min.css" rel="stylesheet">

<title>Correios e Entregas</title>
</head>
<body>
<?php
$sql = "SELECT * FROM corr_devolucoes ORDER BY dataInfo DESC;";
$sqlexe = $conn->query($sql);
if($sqlexe){
?>
<div class="container">
    <div><a href="index.php" class="btn btn-info btn-info-sm">Voltar ao menu</a></div>
                <table class="table table-responsive table-striped">
                    <thead>
                    <th>Data</th><th>Conjunto</th><th>AR/Identificador</th><th>Motivo</th><th>Imagem</th>
                    </thead>
                    <tbody>
                        <?php
                        while($row = $sqlexe->fetch_array(MYSQLI_ASSOC)){
                            $date = date_create($row['dataInfo']);
                            echo "<tr><td>".date_format($date,"d/m/Y")."</td>";
                            echo "<td>";
                            if($row['conjunto'] == 'ni'){
                                echo "Não identificado";
                            } else {
                                echo $row['conjunto'];
                            }
                            echo "</td>";
                            echo "<td>".$row['registroar']."</td>";
                            echo "<td>".$row['motivo']."</td>";
                            echo "<td><a href='".$row['imgpath']."' target='_blank'><img src='".$row['imgpath']."' width='150' height='60'></a></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
    </div>
                <?php
            } else {
                echo "Nenhum registro encontrado.";
            }

?>


</body>
</html>