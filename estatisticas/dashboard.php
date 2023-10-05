<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
#   
#   Entrada de menu Estatistica
#   data: 29jun23
#
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 523 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">

<title>Dashboard</title>
</head>
<body>

	<div class="container">
        <div class="row" style="padding:10px;">
            <div class="col">
                <a href="dashboard.php" class="btn btn-outline-success">Atualizar</a>
            </div>
        </div>
        
        <div class="row">
            <?php
            $mediaUs = 0;
            $totalUs = 0;
            $mediaVi = 0;
            $totalVi = 0;

            // Definir a data atual
            $dataAtual = new DateTime();
	        $dataAtualv = new DateTime();

            // Definir a data de sete dias atrás
            $dataCincoDiasAtras = (clone $dataAtual)->modify('-7 days');
            $dataCincoDiasAtrasv = (clone $dataAtualv)->modify('-7 days');
            echo "<h3 class='bg-warning bg-gradient'>Usuários - Volume de acessos dos últimos 8 dias</h3>";
            
            echo "<div class='col-md-2 bg-info border-3 border-dark'><div class='row' style='border: 1px solid black'>Data </div><div class='row' style='border: 1px solid black'>Total do dia</div></div>";
            $data = $dataCincoDiasAtras;
            while ($data <= $dataAtual) {
                $tabeladia = $data->format('dmY');
                // echo $tabeladia."<br>";
                $tabeladia = "d".$tabeladia;
                // echo $tabeladia."<br>";
                $sqltotal = "SELECT count(distinct Matricula) as total from $tabeladia";
                // echo $sqltotal."<br>";
                $sqltotalexe = $conn->query($sqltotal);
                $totaldia = $sqltotalexe->fetch_assoc();
                echo "<div class='col-sm-1 text-center'><div class='row' style='border: 1px solid black;'>".$data->format('d/m/y')."</div><div class='row' style='border: 1px solid black'><strong>".$totaldia['total']."</strong></div></div>";
                $data->modify('+1 day');
                $totalUs = $totalUs + $totaldia['total'];
                
            }
            echo "</div><div class='row' style='padding: 20px;'>";
            echo "<div class='col-md-4 bg-info border-3 border-dark'><div class='row' style='border: 1px solid black'>Total de acessos dos usuários: </div><div class='row' style='border: 1px solid black'>Média de acessos diários dos usuários: </div></div>";
            
            $mediaUs = $totalUs/8;
            
            echo "<div class='col-md-1 text-center'><div class='row' style='border: 1px solid black;'><strong>".$totalUs."</strong></div><div class='row' style='border: 1px solid black'><strong>".round($mediaUs)."</strong></div></div>";
            
?>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
<?php
            echo "<h3 class='bg-warning bg-gradient'>Visitantes - Volume de acessos dos últimos 8 dias</h3>";
            echo "<div class='col-md-2 bg-info'><div class='row' style='border: 1px solid black'>Data </div><div class='row' style='border: 1px solid black'>Total do dia</div></div>";
            $datav = $dataCincoDiasAtrasv;
            while($datav <= $dataAtualv){
                $dataacesso = $datav->format('Y-m-d');
                $sqltotal = "SELECT count(Acesso) as total from movvis where Acesso='Cadastro' and DataAcesso ='".$dataacesso."'";
                $sqltotalexe = $conn->query($sqltotal);
                $totaldia = $sqltotalexe->fetch_assoc();
                echo "<div class='col-sm-1 text-center'><div class='row' style='border: 1px solid black'>".$datav->format('d/m/y')."</div><div class='row' style='border: 1px solid black'><strong>".$totaldia['total']."</strong></div></div>";
                $datav->modify('+1 day');
                $totalVi = $totalVi + $totaldia['total'];
            }

            echo "</div><div class='row' style='padding: 20px;'>";
            echo "<div class='col-md-4 bg-info border-3 border-dark'><div class='row' style='border: 1px solid black'>Total de acessos dos visitantes: </div><div class='row' style='border: 1px solid black'>Média de acessos diários dos visitantes: </div></div>";
            
            $mediaVi = $totalVi/8;
            
            echo "<div class='col-md-1 text-center'><div class='row' style='border: 1px solid black;'><strong>".$totalVi."</strong></div><div class='row' style='border: 1px solid black'><strong>".round($mediaVi)."</strong></div></div>";

            ?>
        </div>
    </div>
</body>
</html>