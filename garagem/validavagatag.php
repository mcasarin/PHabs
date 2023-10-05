<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

if($_SERVER['REQUEST_METHOD'] == "GET") {
$empresa = $_GET["empresa"];
$vaga = $_GET["vaga"];
$conjunto = $_GET["conjunto"];
$contagem="0";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/bootstrap.min.js"></script>
<title>Vagas</title>
</head>
<body>
<div class="container" style="margin-top:5px;margin-left:10px;margin-right:10px"><?php
$sql = "SELECT Nome,Matricula,Placa,Veiculo FROM usuarios WHERE empresa='".$empresa."' AND placa <> '' ORDER BY Matricula +0 ASC;";
$sqlexe = $conn->query($sql);
        if ($sqlexe->num_rows > 0) {
			?>
			<div class="alert alert-info">
				<span>Veículos cadastrados no conjunto <b><?php echo $empresa; ?></b><br>
				Números das vagas: <?php
				$sqlvaga = "SELECT vaga FROM garagem WHERE conjunto=".$conjunto." order by vaga +0 asc";
				$sqlvagaexe = $conn->query($sqlvaga);
				if($sqlvagaexe){
					while($rowvaga = $sqlvagaexe->fetch_array(MYSQLI_ASSOC)){
						echo $rowvaga['vaga']."  ";
						++$contagem;
					}
				}
				?><br>
				Total de vagas: <?php
				echo $contagem;
				?></span>
			</div>
			<table class="table table-hover">
				<thead>
					<th>Tag</th>
					<th>Nome</th>
					<th>Veículo</th>
					<th>Placa</th>
				</thead>
				<tbody>
		<?php
          while ($row = $sqlexe->fetch_array(MYSQLI_ASSOC)) {
            $veiculo = $row['Veiculo'];
			$nome = $row['Nome'];
            $placa = $row['Placa'];
            $tag = $row['Matricula'];
			?>
					<tr>
						<td><?php echo $tag;?></td>
						<td><?php echo $nome;?></td>
						<td><?php echo $veiculo;?></td>
						<td><?php echo $placa;?></td>
          <?php } // end while
		  ?>
		  		</tbody>
			</table>
		<?php
        } else {
			echo "<div class='alert alert-warning'>
				<p>Nenhuma tag encontrada</p>
				</div>";
		} // end if sql
	?></div>
</body>
</html>
<?php
$conn->close;
} // if get
//eof
?>