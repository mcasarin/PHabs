<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

$today=date("Y-m-d");
$datanew = explode("-",$today);
$todayinternal = $datanew[2]."/".$datanew[1]."/".$datanew[0];
// echo $today."<br>";
// echo $todayinternal."<br>";

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
	<title>Checagem de Visitante</title>
</head>
<body style="background-color:transparent">

<?php
$doc = $_POST["doc"];
		if (!$doc){
			echo "<div class=\"alert alert-danger\" role=\"alert\ style=\"width:250px\">
			<p><strong>Preencha com o RG ou nome do visitante!</strong><br>Campo não pode estar vazio.</p>
			</div>";
		} else {
			$sqlbuscaaut = "SELECT periodoini,periodofim,nomeautoriza,empresa,nomevisitante,rg FROM autorizavis WHERE (rg = '".$doc."' OR nomevisitante like '%".$doc."%') AND periodofim >= '".$today."'";
			// echo $sqlbuscaaut."<br>";
			$resultaut = $conn->query($sqlbuscaaut);
			if ($resultaut->num_rows == 1) {
				while ($linha = $resultaut->fetch_array(MYSQLI_ASSOC)){
					$periodoin = $linha['periodoini'];
					$periodoini = explode("-",$periodoin);
					$periodoini = $periodoini[2]."/".$periodoini[1]."/".$periodoini[0];
					$periodofi = $linha['periodofim'];
					$periodofim = explode("-",$periodofi);
					$periodofim = $periodofim[2]."/".$periodofim[1]."/".$periodofim[0];
					$nomeautoriza = strtoupper($linha['nomeautoriza']);
					$empresa = $linha['empresa'];
					$nomevisitante = strtoupper($linha['nomevisitante']);
					$rg = $linha['rg'];
					echo "<div class=\"alert alert-success\" role=\"alert\" style=\"text-align:center;width:450px;\">";
					if($periodoin > $today){
						echo "<span class=\"alert alert-danger\">Não está autorizado para o dia de hoje.</span><br><br>";
					} else {
						echo "<span class=\"alert alert-warning\" style=\"width:320px\"><strong>Autorizado termporariamente!</strong></span><br><br>";
					}
					echo "<p style=\"text-align:left;\">Visitante autorizado no conjunto: <br><b>".$empresa."</b><br>
					Período: <b>".$periodoini."</b> até <b>".$periodofim."</b><br>
					Autorizado por: ".$nomeautoriza."<br>
					Visitante: <b>".$nomevisitante."</b><br>
					<i><b>Lembre-se:</b> O registro do documento deve ser feito como visitante do conjunto acima.</i>
					</p>
					</div>";
					exit();
				} // end while
			} elseif($resultaut->num_rows > 1) {
				echo "<div class=\"alert alert-success\" role=\"alert\" style=\"text-align:center;width:600px;\">";
				echo "<span style=\"width:400px\"><strong>Há mais de uma autorização com esse nome ou RG <br>para hoje (".$todayinternal.").</strong></span><br>";
				while ($linha = $resultaut->fetch_array(MYSQLI_ASSOC)){
					$periodoin = $linha['periodoini'];
					$periodoini = explode("-",$periodoin);
					$periodoini = $periodoini[2]."/".$periodoini[1]."/".$periodoini[0];
					$periodofi = $linha['periodofim'];
					$periodofim = explode("-",$periodofi);
					$periodofim = $periodofim[2]."/".$periodofim[1]."/".$periodofim[0];
					$nomeautoriza = strtoupper($linha['nomeautoriza']);
					$empresa = $linha['empresa'];
					$nomevisitante = strtoupper($linha['nomevisitante']);
					$rg = $linha['rg'];
					
					echo "<p style=\"text-align:left;\">
					Visitante: <b>".$nomevisitante."</b> - RG: <b>".$rg."</b><br>
					Conjunto: <b>".$empresa."</b><br>
					Período: <b>".$periodoini."</b> até <b>".$periodofim."</b><br>
					Autorizado por: ".$nomeautoriza."<br>";
					// exit();
				} // end while
				echo "<br><br><i><b>Lembre-se:</b> O registro do documento deve ser feito como visitante do conjunto acima.</i>
					</p>
					</div>";
			} else {
				echo "<div class=\"alert alert-danger\" role=\"alert\ style=\"width:350px\">
				<p><strong>Não foi cadastrada ou encontrada autorização temporária!</strong><br>Documento ou nome não encontrado.</p>
				</div>";
			}
            
		} // if rg preenchida
?>

</body>
</html>