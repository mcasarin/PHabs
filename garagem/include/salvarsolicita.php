<?php
include '../../include/function.php';
include '../../include/connect.php';
sessao();
//Declara variaveis
$nomesolicita = "";
$empresa = "";
$carro = "";
$placa = "";
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/bootstrap.css">
<script src="../../js/jquery-1.11.3.js"></script>
<script src="../../js/bootstrap.js"></script>
<title>Salvar Solicita</title>
<body>
<div class="row">
<div class="col-md-10 col-centered">
<div class="table-responsive">
<table class="table">
<tr><td align="center">
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
$nomesolicita = $_POST[htmlspecialchars('nomesolicita')];
$empresa = $_POST["empresa"];
$carro = $_POST[htmlspecialchars('carro')];
$placa = $_POST[htmlspecialchars('placa')];
//fim do envio
$nomesolicita = strtoupper($nomesolicita);
$carro = strtoupper($carro);
$placa = strtoupper($placa);

$sqlinsert = "INSERT INTO solicita (id_sol, tag ,nomesolicita, empresa, carro, placa, datasolicita) VALUES (NULL,'N/D','$nomesolicita','$empresa','$carro','$placa',NOW())";
$result = $conn->query($sqlinsert);
if($result) {
                echo "<div class='p-3 mb-2 bg-success text-white'>Registro efetuado com sucesso<br />";
                echo "Informe ao solicitante que aguarde até 3 dias úteis.</div>";
					 $to  = 'suporte@etwas.com.br';

// assunto
$subject = 'Formulario de solicitação de tag';

// mensagem
$message = '
<html>
<head>
 <title>Envio de solicitação</title>
</head>
<body>
<p>Foi enviado uma nova solicitação de tag!</p>
<p>O(a) sr(a). <b>'. $nomesolicita .'</b>,</p>
<p>Do conjunto <b>'. $empresa .'</b>, solicita tag para o veículo <b>'. $carro .'</b> de placa <b>'. $placa .'</b> .</p>
<p>Verifique o relatório e providencie.</p>
<p>Att</p>
<br>
<p>Administrador</p>
</body>
</html>';

$headers = 'suporte@edificiochurchill.com.br';

mail($to,$subject,$message,$headers);

} else { 
    printf("Errormessage: %s\n", $conn->error);       
    $conn->close();
}
$conn->close();
}//end POST

?>
</td>
</tr>
<tr><td align="center"><a href="../solicitatag.php"> << Voltar << </a></td></tr>
</table>
</div>
</div>
</div>
</html>