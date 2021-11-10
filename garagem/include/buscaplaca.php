<?php
include '../../include/function.php';
include '../../include/connect.php';
sessao();

$today=date("Y-m-d");
// echo $today."<br>";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/bootstrap.css">
<script src="../../js/jquery-1.12.4.js"></script>
<script src="../../js/bootstrap.min.js"></script>
	<title>Checagem de placa</title>
</head>
<body style="background-color:transparent">

<?php
$placa = $_POST["placa"];
		if (!$placa){
			echo "<div class=\"alert alert-danger\" role=\"alert\ style=\"width:250px\">
			<p><strong>Preencha com a placa!</strong><br>Campo não pode estar vazio.</p>
			</div>";
		} else {
			$sqlbusca = "SELECT Nome,Empresa,Placa,Veiculo FROM usuarios WHERE Placa = '".$placa."'";
				$result = $conn->query($sqlbusca);
				if ($result->num_rows > 0) {
					while ($linha = $result->fetch_array(MYSQLI_ASSOC)){
						$empresa = $linha['Empresa'];
						$veiculo = $linha['Veiculo'];
						echo "<div class=\"alert alert-info\" role=\"alert\" style=\"width:350px;text-align:center;\">
						<span class=\"alert alert-success\"><h3>Autorizado!</h3></span><br><br>
						<p style=\"text-align:left;\">Placa registrada no conjunto: <br><b>".$empresa."</b><br>
						Veículo: <b>".$veiculo."</b>
						</p>
						</div>";
						exit();
					} // end while
				} else {
					$sqlbuscaaut = "SELECT periodoini,periodofim,nomeautoriza,empresa,nomeutiliza,placa FROM autoriza WHERE placa = '".$placa."' AND periodoini >= {$today} LIMIT 1"; // busca com condicional usando data com falha ao usar a string, cadastro por string/post funcional
					$resultaut = $conn->query($sqlbuscaaut);
						if ($resultaut->num_rows > 0) {
							while ($linha = $resultaut->fetch_array(MYSQLI_ASSOC)){
								$periodoin = $linha['periodoini'];
								$periodoini = explode("-",$periodoin);
								$periodoini = $periodoini[2]."/".$periodoini[1]."/".$periodoini[0];
								$periodofi = $linha['periodofim'];
								$periodofim = explode("-",$periodofi);
								$periodofim = $periodofim[2]."/".$periodofim[1]."/".$periodofim[0];
								$nomeautoriza = $linha['nomeautoriza'];
								$empresa = $linha['empresa'];
								$nomeutiliza = $linha['nomeutiliza'];
								$placa = $linha['placa'];
								echo "<div class=\"alert alert-success\" role=\"alert\" style=\"text-align:center;width:380px;\">";
								if($periodoin > $today){
									echo "<span class=\"alert alert-danger\">Não está autorizado para o dia de hoje.</span><br><br>";
								} else {
									echo "<span class=\"alert alert-warning\" style=\"width:320px\"><strong>Autorizado termporariamente!</strong></span><br><br>";
								}
								echo "<p style=\"text-align:left;\">Placa registrada no conjunto: <br><b>".$empresa."</b><br>
								Período: <b>".$periodoini."</b> até <b>".$periodofim."</b><br>
								Autorizado por: <b>".$nomeautoriza."</b><br>
								<i><b>Lembre-se:</b> O registro do veículo deve ser feito como visitante na vaga do conjunto acima.</i>
								</p>
								</div>";
								exit();
							} // end while
						} else {
							echo "<div class=\"alert alert-danger\" role=\"alert\ style=\"width:350px\">
							<p><strong>Não Autorizado uso da garagem!</strong><br>Placa não encontrada.</p>
							</div>";
						}
				} // sqlbusca

		} // if placa preenchida
?>

</body>
</html>