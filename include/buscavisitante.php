<?php
include 'function.php';
include 'connect.php';
sessao();
/*
* Resultado de busca por visitante (RG) no cadastro
* Atualização Lista Restritiva mostrando motivo na tela de cadastro
* Atualização Mostra caixa de atenção de que a última empresa visitada encontra-se ausente
*/

// Declarando variáveis
$rg = "";
$cadastro = "";
$validaAusenteA = "";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/churchill.css">
	<script src="../js/jquery-3.6.4.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../webcamjs-master/webcam.js"></script>
<title>Cadastro de Visitantes</title>

</head>
<body>

<?php
//header("Content-type: text/html; charset=utf-8");
if($_SERVER["REQUEST_METHOD"] == "POST") {
$rg = $_POST[htmlspecialchars('rg')];
$rg = ltrim($rg);
$rg = rtrim($rg);
$rg = trim($rg);
$rg = preg_replace('/[^A-Za-z0-9\. -]/', '', $rg);
$empresavis = "";

?>
<div class="container">
	<div class="row">
	
		<div class="col"><h3 align="center">Cadastro de Visitantes</h3>
		</div>
	
	</div> <!-- class row -->

	<div class="row">
<?php
//valida rg com visita aberta
	$sqlvisopen = "SELECT Doc FROM visopen WHERE Doc='".$rg."'";
	$sqlvisopenexe = $conn->query($sqlvisopen);
	if($sqlvisopenexe->num_rows > 0){
	echo "Visitante com cadastro ativo para visita!<br>";
		?>
		<form action="../cadastrovisitantes.php" method="post">
			<input type="hidden" name="rg" id="rg" value="<?php echo $rg;?>" />
			<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button" tabindex="8"> Tentar outro documento?<br>Faltou o dígito? </button>
		</form>
		<?php
		exit();
	}
	// $conn->close;
	
$sql="SELECT RG,Nome,Foto1,Cadastro,ListaNegra,Motivo,Empresa FROM visitantes WHERE RG = '".$rg."'";
$result = $conn->query($sql);
if($result->num_rows > 0){ // Se encontrado cadastro/registro
	$row = mysqli_fetch_array($result);
	$empresavis = $row['Empresa'];
	$cadastro = $row['Cadastro'];
	?>

	<div class="col-3">
	<div class="row text-info bg-success" style="margin:5px;padding:5px;" align="center">DOCUMENTO ENCONTRADO!</div>
	<div class="row" align="center">
		<form action="../cadastrovisitantes.php" method="post" name="return" id="return">
			<input type="hidden" name="rg" id="rg" value="<?php echo $rg;?>" />
			<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button" tabindex="8"> Tentar outro documento?<br>Faltou o dígito? </button>
		</form>
	</div>
	<div class="row">
		<p class="text-danger">Abaixo o cadastro encontrado.</p>
	</div>
	<?php
	if($row['ListaNegra'] == "SIM") {
		echo "<div style='background-color:red; align:center; text-align:center'><h3>Cadastro com restrição de acesso!</h3>
		<p style='background-color:#ff9933'>Motivo: ".$row['Motivo']."</p>
		</div>";	
	}
	?>
	</div> <!-- Fecha caixa esquerda -->
	
	<div class="col-6">
		<form action="inserevisita.php" method="post" name="cadastro" id="cadastro" class="form-horizontal" onsubmit="envio();">
			<div class="table-responsive">
			<table class="table">
				<tr class="info" align="center">
				<td><div class="col" id="webcam"></div></td>
				<td><div class="col" id="resultsfoto"><?php echo '<img name=\"fotoantiga\" src="data:image/jpg;base64,'.base64_encode($row['Foto1']).'" width=\"200px\" height=\"120px\" />';?></div></td>
				</tr>
				<tr class="info" align="center">
				<td><div class="col"><p align="center"> <input type="button" class="btn btn-info form-control" value=" Foto " onClick="captureimage()"> </p></div></td>
				<td><div class="col"><p class="" align="center"> Visualização </p></div></td>
				</tr>
			</table>
			</div>
	</div>
</div>
		<table class="table table-bordered table-hover table-sm">
		<tr><td colspan="2"><div class="cartao">Cartão: <input type="text" name="cartao" id="cartao" placeholder="Busca cartão..." tabindex="1" autocomplete="off" required autofocus="autofocus">
		<div class="botcad" name="botcad" id="botcad"></div>
				</div></td></tr>
		<tr><td>Nome: <input type="text" name="nome" id="nome" value="<?php echo $row['Nome']; ?>" size="40" required></td><td>Documento: <input type="text" name="rg" id="rg" value="<?php echo $row['RG']; ?>" size="15" readonly></td></tr>
		
		<tr><td colspan="2">Última Empresa visitada: 
<?php
				$sqlvisA= "SELECT Empresa FROM movvis WHERE RG='".$rg."' ORDER BY DataAcesso DESC LIMIT 1;"; //ajuste no SQL para pegar última empresa
				$resultvisA = $conn->query($sqlvisA);
				if($resultvisA->num_rows > 0) {
					while ($rowvisA = $resultvisA->fetch_array(MYSQLI_ASSOC)){
						// Valida Empresa da ultima visita (ausente/vago)
						$sqlrastreio = "SELECT empresa FROM empresas WHERE empresa = '".$rowvisA['Empresa']."';";
						$resultrastreio = $conn->query($sqlrastreio);
							if($resultrastreio->num_rows == 0){
								echo "<script type='text/javascript'>
										$(window).load(function() {
											$('#popAusente').modal('show');
										});
										</script>
								<div class='modal' id='popAusente' tabindex='-1' role='dialog'>
								  <div class='modal-dialog' role='document'>
									<div class='modal-content'>
									  <div class='modal-header'>
										<h5 class='modal-title alert-danger'>Atualize a empresa visitada!!!</h5>
									  </div>
									  <div class='modal-body'>
										<p>Última empresa visitada está ausente ou o conjunto vago.<br>Atualize o conjunto!</p>
									  </div>
									  <div class='modal-footer'>
										<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
									  </div>
									</div>
								  </div>
								</div>";
							}
					}
				}
		// populando o combobox
			    $sqlvis1 = "SELECT Empresa FROM movvis WHERE RG='".$rg."' ORDER BY DataAcesso DESC LIMIT 1;"; //ajuste no SQL para pegar última empresa
			
			   // confirmando sucesso
				$resultvis1 = $conn->query($sqlvis1);
			
			   // agrupando resultados
				if($resultvis1->num_rows > 0) {
					
		        // combobox
		        echo "<select name='empresa' id='empresa' tabindex='2' required>";
		        
		        while ($rowvis = $resultvis1->fetch_array(MYSQLI_ASSOC))
		        	// while para agrupar todos os itens
		        	echo "<option value='$rowvis[Empresa]'>$rowvis[Empresa]</option>";
					echo $rowvis['Empresa'];
					
				} else { // caso falhar coleta da última visita compõe html/select
					echo "<select name='empresa' id='empresa' tabindex='2' required>";
					echo "<option value=''>-- Selecione --</option>";
				}
				
				// $conn->close;
				
		// montagem da combobox empresa
		
		// populando o combobox
		$sql2 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY empresa + 0 ASC;"; //+0 para ordenar campo
		
		// confirmando sucesso
		$result2 = $conn->query($sql2);
		
		// agrupando resultados
		if($result2->num_rows > 0) {
			// combobox
			while ($row = $result2->fetch_array(MYSQLI_ASSOC))
				// while para agrupar todos os itens
				echo "<option value='$row[empresa]'>$row[empresa]</option>";
		}
		echo "</select></td></tr>";
		// fim da combo
		
		// $conn->close;
		?>
		<tr><td>Autorização: <input type="text" name="autoriza" style="text-transform: uppercase;" tabindex="2"></td><td>Empresa/OBS: <input type="text" name="obs" style="text-transform: uppercase;" tabindex="3" value="<?php echo $empresavis; ?>"></td></tr>
		<tr><td align="right" colspan="2">Cadastro: <?php 
							echo date('d/m/Y',strtotime($cadastro)); ?></td><tr>
		<input type="hidden" name="visita" value="1">
		<script type="text/javascript">
			// Chamada Camera
					Webcam.set({
						width: 200,
						height: 120,
						image_format: 'jpeg',
						jpeg_quality: 100
					});
						Webcam.attach( '#webcam' );
						function captureimage() {
							// take snapshot and get image data
							Webcam.snap( function(data_uri) {
								// display results in page
								Webcam.upload( data_uri, 'savephotolocal.php', function(code, text) {
									document.getElementById('resultsfoto').innerHTML =
									'<img src="'+text+'" width="220px" height="140px" /><input type="hidden" value="'+text+'" name="foto" />';
								} );
							} );
						}
			// fim Chamada Camera
			// função focus
			document.getElementById('cartao').focus();
			//end
			// função Busca cartão live
			$(document).ready(function(){
				$('.cartao input[type="text"]').on("keyup input", function(){
					/* Get input value on change */
					var inputVal = $(this).val();
					var resultDropdown = $(this).siblings(".botcad");
					if(inputVal.length){
						$.get("ajax.php", {term: inputVal}).done(function(data){
							// Display the returned data in browser
							resultDropdown.html(data);
						});
					} else{
						resultDropdown.empty();
					}
				});
				
				// Set search input value on click of result item
				$(document).on("click", ".botcad p", function(){
					$(this).parents(".cartao").find('input[type="text"]').val($(this).text());
					$(this).parent(".botcad").empty();
				});
			});
			// fim busca cartão live
			
			// função ENTER envia
			document.getElementById('cartao').onkeydown = function(e){
			   if(e.keyCode == 13){
				 envio();
			   }
			};
			//fim função ENTER envia
		</script>
		</form>
		</div>
		</div>
		</table>

	<?php
} else { // SE NÃO encontrar cadastro #################################################################################
	?>
<div class="row">
	<div class="col-3">
		<div class="row text-info bg-danger" style="margin:5px;padding:5px;" align="center">DOCUMENTO NÃO ENCONTRADO!</div>
		<div class="row" align="center">
		<form action="../cadastrovisitantes.php" method="post" name="return" id="return">
			<input type="hidden" name="rg" id="rg" value="<?php echo $rg;?>">
			<button class="btn btn-sm btn-warning btn-block" type="submit" name="return" role="button" tabindex="8"> Tentar novamente?<br>Faltou o dígito? </button>
		</form>
		</div>
		<div class="row">
			<p class="text-danger">Para cadastrá-lo no sistema, preencha abaixo.</p>
		</div>
	</div>
	<div class="col-6">
		<form action="inserevisita.php" method="post" name="cadastro" id="cadastro" class="form-horizontal" onsubmit="envio();">
			<div class="table-responsive">
			<table class="table">
				<tr class="info" align="center">
					<td><div class="col" id="webcam"></div></td>
					<td><div class="col" id="resultsfoto"></div></td>
				</tr>
				<tr class="info" align="center">
					<td><div class="col"><p align="center"> <input type="button" class="btn btn-info form-control" id="capturafoto" name="capturafoto" value=" Foto " onClick="captureimage()"> </p></div></td>
					<td><div class="col"><p class="" align="center"> Visualização </p></div></td>
				</tr>
			</table>
			</div>
		</div>
	</div>
</div>
		<div class="row">
			<div class="col-xs-12 col-md-8" id="dados">
			<div class="table-responsive">
			<table class="table table-bordered table-hover">
			<tr><td colspan="2">RG: <input type="text" name="rg" id="rg" value="<?php echo $rg;?>" size="15" required></td></tr>
			<tr><td colspan="2">Nome: <input type="text" name="nome" id="nome" style="text-transform: uppercase;" size="40" tabindex="1" autofocus required></td></tr>
			<tr><td colspan="2">Empresa: 
			<?php
			// montagem da combobox empresa
		        echo "<select name='empresa' id='empresa' tabindex='2' required>";
		        echo "<option value=''>-- Selecione --</option>";
			    // populando o combobox
			    $sql3 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY empresa + 0 ASC;"; //+0 para ordenar campo
			
			   // confirmando sucesso
				$result3 = $conn->query($sql3);
			
			   // agrupando resultados
				if($result3->num_rows > 0) {
		        // combobox
		        
		        while ($row = $result3->fetch_array(MYSQLI_ASSOC))
		        	// while para agrupar todos os itens
		        	echo "<option value='$row[empresa]'>$row[empresa]</option>";
				}
				echo "</select>";
		        	// fim da combo
		        	// $conn->close;
        	?>
        	</td></tr>
			<tr><td>Autorização: <input type="text" name="autoriza" style="text-transform: uppercase;"> </td><td> Empresa/OBS: <input tabindex="3" type="text" name="obs" style="text-transform: uppercase;" size="30"></td></tr>
			<tr><td colspan="2"><div class="cartao">Cartão: <input tabindex="4" type="text" name="cartao" id="cartao" placeholder="Busca cartão..." autocomplete="off" required autofocus>
		<div class="botcad" name="botcad" id="botcad"></div>
				</div></td></tr>
				<input type="hidden" name="visita" value="0">
			<tr><td colspan="2"><div id="msgerr"></div></td></tr>
			</form>
			</div> <!-- table responsive -->
			</div> <!-- dados -->
			</div> <!-- row -->
			</table>
</div> <!-- div container -->
	<script type="text/javascript">
			//Chamada Camera
					Webcam.set({
						width: 200,
						height: 120,
						image_format: 'jpeg',
						jpeg_quality: 100
					});
						Webcam.attach( '#webcam' );
						function captureimage() {
							// take snapshot and get image data
							Webcam.snap( function(data_uri) {
								// display results in page
								Webcam.upload( data_uri, 'savephotolocal.php', function(code, text) {
									document.getElementById('resultsfoto').innerHTML =
									'<img src="'+text+'" width="220px" height="140px" /><input type="hidden" value="'+text+'" name="foto" />';
								} );
							} );
						}
			//fim Chamada Camera
			// função focus
			document.getElementById('nome').focus();
			//end
			//função Busca cartão live
			$(document).ready(function(){
				$('.cartao input[type="text"]').on("keyup input", function(){
					/* Get input value on change */
					var inputVal = $(this).val();
					var resultDropdown = $(this).siblings(".botcad");
					if(inputVal.length){
						$.get("ajax.php", {term: inputVal}).done(function(data){
							// Display the returned data in browser
							resultDropdown.html(data);
						});
					} else{
						resultDropdown.empty();
					}
				});
				
				// Set search input value on click of result item
				$(document).on("click", ".botcad p", function(){
					$(this).parents(".cartao").find('input[type="text"]').val($(this).text());
					$(this).parent(".botcad").empty();
				});
			});
			//fim busca cartão live
			
			//função ENTER envia
			document.getElementById('cartao').onkeydown = function(e){
			   if(e.keyCode == 13){
				 envio();
			   }
			};
			//fim função ENTER envia
		</script>
	<?php 
	} //end else
} //end request
$conn->close();
?>