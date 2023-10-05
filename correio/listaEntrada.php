<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include '../include/function.php';
include_once '../include/connect.php';
sessao();

/*
#   
#   Lista de entradas Correio
#   data: 28ago23
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

<title>Lista Entradas</title>
</head>
<body>
<?php
$sql = "SELECT * FROM corr_entrada ORDER BY dataInfo DESC;";
$sqlexe = $conn->query($sql);
if($sqlexe){
?>
<div class="container">
    <div><a href="menuEntradas.php" class="btn btn-info btn-info-sm">Voltar ao menu</a></div>
                <table class="table table-responsive table-striped">
                    <thead>
                    <th>Registrar</th><th>Data</th><th>Conjunto</th><th>Nome</th><th>AR/Identificador</th><th>Tipo AR</th><th>Observação</th><th>Discriminação</th><th>Imagem</th>
                    </thead>
                    <tbody>
                        <?php
                        while($row = $sqlexe->fetch_array(MYSQLI_ASSOC)){
                            $date = date_create($row['dataInfo']);
                            echo "<tr><td><a href='recebidopor.php?id=".$row['id']."'><span class='badge text-bg-success'>Registrar<br>recebimento</span></a></td>";
                            echo "<td>".date_format($date,"d/m/Y")."</td>";
                            echo "<td>";
                            if($row['conjunto'] == 'ni'){
                                echo "Não identificado";
                            } else {
                                echo $row['conjunto'];
                            }
                            echo "</td>";
                            echo "<td>".$row['nome']."</td>";
                            echo "<td>".$row['registroar']."</td>";
                            echo "<td>".$row['tipoar']."</td>";
                            echo "<td>".$row['obs']."</td>";
                            echo "<td>".$row['disc']."</td>";
                            echo "<td>";
                            if($row['imgpath'] == "sem imagem"){
                                echo "<div class='alert alert-dark' role='alert'>Sem imagem</div>";
                            } else {
                                echo "<a href='".$row['imgpath']."' target='_blank'><img src='".$row['imgpath']."' width='150' height='60'></a>";
                            }
                            echo "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
    </div>
                <?php
            } else {
                echo "<div class='alert alert-dark' role='alert'>Nenhum registro encontrado.</div>";
            }

?>


</body>
</html>