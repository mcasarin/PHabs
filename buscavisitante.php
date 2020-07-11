<?php 
include 'function.php';
include 'connect.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../webcamjs-master/webcam.js"></script>
<title>Cadastro de Visitantes</title>
</head>
<body>

<?php
header('Content-Type: text/html; charset=iso-8859-1');
if($_SERVER["REQUEST_METHOD"] == "POST") {
$rg = $_POST['rg'];

?>
	<div class="row">
	<div class="col-xs-3 col-md-2">&nbsp;</div>
	<div class="col-xs-6 col-md-4 col-centered bg-sucess"><h3>Cadastro de Visitantes</h3></div>
	<div class="col-xs-3 col-md-2">&nbsp;</div>
	</div> <!-- class row -->
<?php
$sql="SELECT RG,Nome,Foto1,Cadastro,ListaNegra FROM visitantes WHERE RG = '".$rg."'";
$result = $conn->query($sql);
if($result->num_rows > 0){ // Se encontrado cadastro/registro
	$row = mysqli_fetch_array($result);
	?>
	<div class="col-xs-4 col-md-3">
	<div class="text-info bg-success" style="line-height: 75px" align="center">DOCUMENTO ENCONTRADO!</div>
	<form action="../cadastrovisitantes.php" method="post" name="return" id="return">
	<input type="hidden" name="rg" id="rg" value="<?php echo $rg;?>" />
		<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button" tabindex="8"> Tentar outro documento?<br>Faltou o dígito? </button>
	</form>
	<p class="text-danger">Abaixo o cadastro encontrado.</p>
	<?php
	if($row['ListaNegra'] == "SIM") {
		echo "<div style='background-color:red; align:center; text-align:center'><h3>Cadastro com restrição de acesso!</h3></div>";	
	}
	?>
	</div> <!-- Fecha caixa esquerda -->
	<form action="inserevisita.php" method="post" name="cadastro" id="cadastro" class="form-horizontal" onsubmit="envio();">
	<div class="col-xs-8 col-md-4">
			<div class="table-responsive">
			<table class="table">
				<tr class="info" align="center">
				<td><div class="col-md-1" id="webcam"></div></td>
				<td><div class="col-md-1" id="resultsfoto"><?php echo '<img name=\"fotoantiga\" src="data:image/jpg;base64,'.base64_encode($row['Foto1']).'" width=\"200px\" height=\"120px\" />';?></div></td>
				</tr>
				<tr class="info" align="center">
				<td><div class="col-md-1"><p align="center"> <input type="button" class="btn btn-default form-control" value=" Foto " onClick="captureimage()"> </p></div></td>
				<td><div class="col-md-1"><p class="bg-success" align="center"> Visualização </p></div></td>
				</tr>
			</table>
			</div>
	</div>
		<table class="table table-bordered table-hover">
		<tr><td>Cartão: <input name="cartao" id="cartao" placeholder="Busca cart�o para cadastro" tabindex="1" autocomplete="off" required autofocus></td>
		<td align="right">Cadastro: <?php 
							$d = strtotime($row['Cadastro']);
							echo date('d-m-Y',$d); ?></td></tr>
		<tr><td>Nome: <input type="text" name="nome" value="<?php echo $row['Nome']; ?>" size="40" required></td><td>Documento: <input type="text" name="rg" value="<?php echo $row['RG']; ?>" size="15" readonly></td></tr>
		
		<tr><td colspan="2">Última Empresa visitada: 
<?php 
		
		// populando o combobox primeira linha ultima empresa visitada
			    $sqlvis1 = "SELECT Empresa FROM movvis WHERE RG='".$rg."' ORDER BY DataAcesso AND HoraAcesso ASC LIMIT 1;";
			
			   // confirmando sucesso
				$resultvis1 = $conn->query($sqlvis1);
			
			   // agrupando resultados
				if($resultvis1->num_rows > 0) {
		        // combobox
		        echo "<select name='empresa' id='empresa' tabindex='2' required>";
		        
		        while ($rowvis = $resultvis1->fetch_array(MYSQLI_ASSOC))
		        	// while para agrupar todos os itens
		        	echo "<option value='$rowvis[Empresa]'>$rowvis[Empresa]</option>";
				}
				$conn->close;
				
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
		        	$conn->close;
		?>
		<tr><td>Autorização: <input type="text" name="autoriza" style="text-transform: uppercase;" tabindex="2"></td><td>Empresa/OBS: <input type="text" name="obs" style="text-transform: uppercase;" tabindex="3" value="<?php echo $empresavis; ?>"></td></tr>
		<input type="hidden" name="visita" value="1">
		<tr><td colspan="2"><div id="botcad"></div></td></tr>
		</form>
		</div>
		</div>
		</table>
		<script>
//Chamada camera
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
			
//fun��o Busca cart�o live
$(document).ready(function(){

load_data();

 function load_data(query)
 {
  $.ajax({
   url:"ajax.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#botcad').html(data);
   }
  });
 }
 $('#cartao').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});

document.getElementById('cartao').onkeydown = function(e){
   if(e.keyCode == 13){
     envio();
   }
};
</script>
	<?php
<<<<<<< HEAD
} else { // Se não encontrar cadastro
	?>
	<div class="row">
	<div class="col-xs-4 col-md-3">
	<div class="text-info bg-danger" style="line-height: 75px" align="center">DOCUMENTO NÃO ENCONTRADO!</div>
	<form action="../cadastrovisitantes.php" method="post" name="return" id="return">
		<input type="hidden" name="rg" id="rg" value="<?php echo $rg;?>" />
		<button class="btn btn-sm btn-warning btn-block" type="submit" name="return" role="button" tabindex="8"> Tentar novamente?<br>Faltou o dígito? </button>
=======
} else { // Se n�o encontrar cadastro
	?>
	<div class="row">
	<div class="col-xs-4 col-md-3">
	<div class="text-info bg-danger" style="line-height: 75px" align="center">DOCUMENTO N�O ENCONTRADO!</div>
	<form action="../cadastrovisitantes.php" method="post" name="return" id="return">
		<input type="hidden" name="rg" id="rg" value="<?php echo $rg;?>" />
		<button class="btn btn-sm btn-warning btn-block" type="submit" name="return" role="button" tabindex="8"> Tentar novamente?<br>Faltou o d�gito? </button>
>>>>>>> daf2cd98c9680322351e26e75b575be1ae1b475f
	</form>
	<p class="text-danger">Para cadastrá-lo no sistema, preencha abaixo.</p>
	</div>
	<form action="inserevisita.php" method="post" name="cadastro" id="cadastro" class="form-horizontal" onsubmit="envio();">
		<div class="col-xs-8 col-md-4">
			<div class="table-responsive">
			<table class="table">
				<tr class="info" align="center">
				<td><div class="col-md-1" id="webcam"></div></td>
				<td><div class="col-md-1" id="resultsfoto"></div></td>
				</tr>
				<tr class="info" align="center">
				<td><div class="col-md-1"><p align="center"> <input type="button" class="btn btn-default form-control" value=" Foto " onClick="captureimage()"> </p></div></td>
				<td><div class="col-md-1"><p class="bg-success" align="center"> Visualização </p></div></td>
				</tr>
			</table>
			</div>
		</div>
	</div>
			<div class="row">
			<div class="col-xs-12 col-md-8" id="dados">
			<div class="table-responsive">
			<table class="table table-bordered table-hover">
			<tr><td colspan="2">RG: <input type="text" name="rg" id="rg" value="<?php echo $rg;?>" size="15" required /></td></tr>
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
		        	// fim da combo<br>
		        	$conn->close;
        	?>
        	</td></tr>
<<<<<<< HEAD
			<tr><td>Autorização: <input type="text" name="autoriza" style="text-transform: uppercase;" tabindex="3"> </td><td> Empresa/OBS: <input type="text" name="obs" style="text-transform: uppercase;" size="30" tabindex="4"></td></tr>
=======
			<tr><td>Autoriza��o: <input type="text" name="autoriza" style="text-transform: uppercase;" tabindex="3"> </td><td> Empresa/OBS: <input type="text" name="obs" style="text-transform: uppercase;" size="30" tabindex="4"></td></tr>
>>>>>>> daf2cd98c9680322351e26e75b575be1ae1b475f
			<tr><td colspan="2">Cart�o: <input name="cartao" id="cartao" placeholder="Busca cart�o para cadastro" tabindex="5" autocomplete="off" required ></td></tr>
				<input type="hidden" name="visita" value="0">
			<tr><td colspan="2"><div id="botcad"></div></td></tr>
			<tr><td colspan="2"><div id="msgerr"></div></td></tr>
			</form>
			</div> <!-- table responsive -->
			</div> <!-- dados -->
			</div> <!-- row -->
			</table>
		
<script>
//Chamada camera
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

//Busca cart�o
$(document).ready(function(){

load_data();

 function load_data(query)
 {
  $.ajax({
   url:"ajax.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#botcad').html(data);
   }
  });
 }
 $('#cartao').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});

document.getElementById('cartao').onkeydown = function(e){
   if(e.keyCode == 13){
     envio();
   }
};

</script>
	<?php 
	} //end else
} //end request
?>