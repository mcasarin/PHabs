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
	<link rel="stylesheet" href="../css/bootstrap.css">
	<script src="../js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script> -->
	<script type="text/javascript" src="../js/jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="../js/buscaPlacaRelAutorizado.js"></script>
	<script type="text/javascript" src="../js/buscaEmpresaRelAutorizados.js"></script>
	<style>
	table {
		width: 100%;
	}
	th, td {
		font-size: 12px;
	}
	</style>
<title>Relatório autorizações temporárias Garagem</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
    <div class="col-12">
	<h3 align="center">Relatório de autorizações temporárias</h3>
	<p align="left"><a href="formautoriza.php" class="btn btn-info btn-sm">Nova autorização</a></p>
	<p>
		<form method="POST" id="form-pesquisa" action="">
			Pesquisar placa: <input type="text" name="pesquisa" id="pesquisa" placeholder="...">
			<input type="submit" class="btn btn-info btn-sm" name="enviar" value="Pesquisar">
		</form>
		
		<ul class="resultado">
		
		</ul>
	</p>
	<p>
		<form method="POST" id="form-pesquisa-empresa" action="">
			Pesquisar empresa: <input type="text" name="pesquisaemp" id="pesquisaemp" placeholder="...">
			<input type="submit" class="btn btn-info btn-sm" name="enviar" value="Pesquisar Empresa">
		</form>
		
		<ul class="resultadoemp">
		
		</ul>
	</p>
		<p align="right"><a class="btn btn-outline-secondary btn-sm" href="garagem.php">Voltar para o menu</a></p> 
		<?php
			$sql = "SELECT * FROM autoriza ORDER BY periodoini DESC";
			$sqlexe = $conn->query($sql);
			echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Edição</th><th>Início</th><th>Fim</th><th>Autorizador</th><th>Empresa</th><th>Nome</th><th>Placa</th><th>Login</th><th>Data registro</th>
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
					echo "<td><a href=\"formautoriza.php?id=$id&formdirect=update\" class=\"btn btn-warning btn-sm\">Editar</a></td><td>".ordenaData($periodoini)."</td><td>".ordenaData($periodofim)."</td><td>$nomeautoriza</td><td>$empresa</td><td>$nomeutiliza</td><td>$placa</td><td>$login</td><td>$registro</td></tr>";
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