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
	<title>Checagem de prestador</title>
</head>
<body style="background-color:transparent">

<?php
$empresa = $_POST["empresa"];
	if (!$empresa){
		echo "<div class=\"alert alert-danger\" role=\"alert\ style=\"width:250px\">
		<p><strong>Selecione o conjunto!</strong><br>Campo não pode estar vazio.</p>
		</div>";
	} else {
			$sqlbuscaaut = "SELECT periodoini,periodofim,nomeautoriza,empresa,terceiro FROM autoriza WHERE empresa = '".$empresa."' AND periodoini <= '{$today}' AND periodofim >= '{$today}' AND terceiro > ''";
            // echo $sqlbuscaaut."<br>";
				$resultaut = $conn->query($sqlbuscaaut);
					if ($resultaut->num_rows > 0) {
                        echo "<div class=\"alert alert-success\" role=\"alert\" style=\"text-align:center;width:380px;\">";
						echo "<span class=\"alert alert-warning\" style=\"width:420px\"><strong>Autorizado termporariamente!</strong></span><br><br>";
						while ($linha = $resultaut->fetch_array()){
								$periodoin = $linha['periodoini'];
								$periodoini = explode("-",$periodoin);
								$periodoini = $periodoini[2]."/".$periodoini[1]."/".$periodoini[0];
								$periodofi = $linha['periodofim'];
								$periodofim = explode("-",$periodofi);
								$periodofim = $periodofim[2]."/".$periodofim[1]."/".$periodofim[0];
								$nomeautoriza = strtoupper($linha['nomeautoriza']);
								$empresa = $linha['empresa'];
								$terceiro = strtoupper($linha['terceiro']);
								echo "<p style=\"text-align:left;\">Prestador de Serviços / Terceiro: <br>
                                <b>".$terceiro."</b><br>
                                Período: <b>".$periodoini."</b> até <b>".$periodofim."</b><br>
								Autorizado por: ".$nomeautoriza."<br>";
                                // echo $terceiro."<br>";
                            } // end while
							echo "<br><i><b>Lembre-se:</b> O registro do veículo deve ser feito como visitante na vaga do conjunto acima.</i></p></div>";
						} else {
							echo "<div class=\"alert alert-danger\" role=\"alert\ style=\"width:350px\">
							<p><strong>Não encontrado!</strong><br>Nenhum prestador de serviços ou terceiro<br>cadastrado para o período.</p>
							</div>";
						}
		} // sqlbusca
$conn->close();
?>

</body>
</html>