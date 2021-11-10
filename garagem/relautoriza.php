<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../css/bootstrap.css">
	<script src="../../js/jquery-1.12.4.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
<title>Relatório autorizações temporárias Garagem</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
    <div class="col-12">
	<h3 align="center">Relatório de autorizações temporárias</h3>
	<p align="left"><a href="formautoriza.php" class="btn btn-info">Nova autorização</a></p><p align="right"><a class="btn btn-outline-secondary" href="garagem.php">Voltar para o menu</a></p> 
		<?php
			$sql = "SELECT * FROM autoriza ORDER BY periodoini ASC";
			$sqlexe = $conn->query($sql);
			echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Início</th><th>Fim</th><th>Autorizador</th><th>Empresa</th><th>Nome</th><th>Placa</th><th>Login</th><th>Data registro</th>
                    </thead>
                    <tbody>";
			if($sqlexe->num_rows > 0){
				while($linha = $sqlexe->fetch_array(MYSQLI_ASSOC)){
					$id = $linha['id_aut'];
					$periodoini = $linha['periodoini'];
					$periodofim = $linha['periodofim'];
					$nomeautoriza = $linha['nomeautoriza'];
					$empresa = $linha['empresa'];
					$nomeutiliza = $linha['nomeutiliza'];
					$placa = $linha['placa'];
					$login = $linha['login'];
					$registro = $linha['registro'];
					echo "<td>$periodoini</td><td>$periodofim</td><td>$nomeautoriza</td><td>$empresa</td><td>$nomeutiliza</td><td>$placa</td><td>$login</td><td>$registro</td></tr>";
				}//end while
			}//end if select
			echo "</tbody></table>";
		?>
	</div>
    </div> <!-- end row -->
	<br>
<p align="left"><a class="btn btn-outline-secondary" href="garagem.php">Voltar para o menu</a></p>
</section>
</body>
</html>
<?php
$conn->close();
?>