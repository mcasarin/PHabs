<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
//require 'header.php';
include 'function.php';
include 'connect.php';
sessao();


// Declarando variaveis
$rg = "";
$formdirect = "";
$nomevis = "";
$empresaobs = "";
$cadastro = "";
$listanegra = "";
$motivo = "";
$visitas = "";
$visempresa = "";
$foto = "";


if($_SERVER['REQUEST_METHOD'] == "GET") {
	$formdirect = $_GET['formdirect'];
	$rg = $_GET["rg"];

if($_SESSION["tipo"] == '0'){
switch ($formdirect){
	case "block":
	echo "<div class=\"container\">
			<div class=\"row\">
				<div class='col-6 center' style='text-align:center;'><h3 class='alert alert-warning'>Confirme os dados do visitante antes de <b>restringir</b> o acesso </h3></div>
			</div>";

	echo "<form action='execute-block-vis.php' method='post'>";

	
$sqlbuscarg = "SELECT RG,Nome,Empresa,Cadastro,Visitas,VisEmpresa,Foto1,Motivo FROM visitantes WHERE RG = '$rg'";
	
$sqlbuscargexe = $conn->query($sqlbuscarg);
	
	if($sqlbuscargexe->num_rows > 0){
		while($rowa = $sqlbuscargexe->fetch_array(MYSQLI_ASSOC)){
					$rg = $rowa['RG'];
					$nomevis = $rowa['Nome'];
					$empresaobs = $rowa['Empresa'];
					$cadastro = $rowa['Cadastro'];
					$cadastro = date('d/m/Y',strtotime($cadastro));
					$visitas = $rowa['Visitas'];
					$visempresa = $rowa['VisEmpresa'];
					$foto = $rowa['Foto1'];
					$motivo = $rowa['Motivo'];
		
		
					echo "<div class='table-responsive col-6'>
						<table class='table table-sm table-borderer table-hover'>
						<tr><td colspan='2'>Nome: ".$nomevis."</td><td rowspan='3'><img name=\"foto\" src='data:image/jpg;base64,".base64_encode($foto)."' width=\"200px\" height=\"120px\" /></td></tr>
						<tr><td colspan='2'>RG: ".$rg."</td></tr>
						<tr><td>Cadastro: ".$cadastro."</td><td>Visitas: ".$visitas."</td></tr>
						<tr><td colspan='3'>Última empresa visitada: ".$visempresa."</td></tr>
						<tr><td colspan='3'>Empresa / Chamada na tela: <input type='text' name='empresaobs' id='empresaobs' value='".$empresaobs."' size='25'></td></tr>
						<tr><td colspan='3'><div class='form group'><label>Descreva o motivo:</label>
						<br>
						<textarea name='motivo' id='motivo' rows='4' cols='50' required>".$motivo."</textarea></div></td></tr>
						</table>
						</div>
							<input type='hidden' name='rg' id='rg' value='".$rg."' />
							<input type='hidden' name='formdirect' id='formdirect' value='".$formdirect."' />
						<div class='row'>
							<div class='col-sm' style='margin:auto;width:50%;text-align:center;'><input type='submit' class='btn btn-lg btn-danger' value='Restringir acesso' /></div>
						</div>

				</form>
				</div>";
		} // end while
		
	} else { // buscarg
		echo "<div class=\"container\"><div class=\"row\">
		<div class=\"alert alert-warning\" role=\"alert\">
			A recuperação dos dados falhou!
		</div>
		<div class=\"alert alert-info\" role=\"alert\">
			Houve um erro na sua requisição e é necessário refazê-la.
		</div>
		</div></div>";
	}
break;
case "unblock":
echo "<div class=\"container\">
			<div class=\"row\">
				<div class='col-6 center' style='text-align:center;'><h3 class='alert alert-info'>Confirme os dados do visitante antes de <b>remover a restrição</b></h3></div>
			</div>";

	echo "<form action='execute-block-vis.php' method='post'>";

	
$sqlbuscarg = "SELECT RG,Nome,Empresa,Cadastro,Visitas,VisEmpresa,Foto1,Motivo FROM visitantes WHERE RG = '$rg'";
	
$sqlbuscargexe = $conn->query($sqlbuscarg);
	
	if($sqlbuscargexe->num_rows > 0){
		while($rowa = $sqlbuscargexe->fetch_array(MYSQLI_ASSOC)){
					$rg = $rowa['RG'];
					$nomevis = $rowa['Nome'];
					$empresaobs = $rowa['Empresa'];
					$cadastro = $rowa['Cadastro'];
					$cadastro = date('d/m/Y',strtotime($cadastro));
					$visitas = $rowa['Visitas'];
					$visempresa = $rowa['VisEmpresa'];
					$foto = $rowa['Foto1'];
					$motivo = $rowa['Motivo'];
		
		
					echo "<div class='table-responsive col-6'>
						<table class='table table-sm table-borderer table-hover'>
						<tr><td colspan='2'>Nome: ".$nomevis."</td><td rowspan='3'><img name=\"foto\" src='data:image/jpg;base64,".base64_encode($foto)."' width=\"200px\" height=\"120px\" /></td></tr>
						<tr><td colspan='2'>RG: ".$rg."</td></tr>
						<tr><td>Cadastro: ".$cadastro."</td><td>Visitas: ".$visitas."</td></tr>
						<tr><td colspan='3'>Última empresa visitada: ".$visempresa."</td></tr>
						<tr><td colspan='3'>Empresa / Chamada na tela: <input type='text' name='empresaobs' id='empresaobs' value='".$empresaobs."' size='25'></td></tr>
						<tr><td colspan='3'><div class='form group'><label>Descreva o motivo:</label>
						<br>
						<textarea name='motivo' id='motivo' rows='4' cols='50' required>".$motivo."</textarea></div></td></tr>
						</table>
						</div>
							<input type='hidden' name='rg' id='rg' value='".$rg."' />
							<input type='hidden' name='formdirect' id='formdirect' value='".$formdirect."' />
						<div class='row'>
							<div class='col-sm' style='margin:auto;width:50%;text-align:center;'><input type='submit' class='btn btn-lg btn-success' value='Remover restrição' /></div>
						</div>

				</form>
				</div>";
		} // end while
		
	} else { // buscarg
		echo "<div class=\"container\"><div class=\"row\">
		<div class=\"alert alert-warning\" role=\"alert\">
			A recuperação dos dados falhou!
		</div>
		<div class=\"alert alert-info\" role=\"alert\">
			Houve um erro na sua requisição e é necessário refazê-la.
		</div>
		</div></div>";
	}
break;
} // switch
} else { // Caso não venha com string formdirect e não seja perfil administrativo
	echo "<div class=\"container\"><div class=\"row\">
		<div class=\"alert alert-warning\" role=\"alert\">
			Desculpe! Mas parece que vocês não tem acesso.
		</div>
		<div class=\"alert alert-info\" role=\"alert\">
			Solicite aos administradores para que executem o que precisa ou solicite permissão para isso.
		</div>
		</div></div>";
}

} // end if GET