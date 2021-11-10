<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.js"></script>

<title>Empresas</title>
</head>
<body>
<div class="container">
	<div class="row">
		<p class="badge">Lista em Ordem: 
			<form action="checkempresa.php" method="post" target="empresadisplay">
			<input type="hidden" name="opt" value="conj" id="conj" />
			<button type="submit" value="submit" class="btn btn-outline-info" style="margin: 5px;">Conjunto</button>
			</form>
			<form action="checkempresa.php" method="post" target="empresadisplay">
			<input type="hidden" name="opt" value="sonome" id="sonome" />
			<button type="submit" class="btn btn-outline-info" style="margin: 5px;">Ausentes</button>
			</form>
		</p>	
			<form action="consultaempresa.php" method="post">
				<button type="submit" class="btn btn-warning" style="margin: 5px;">Limpar resultados</button>
			</form>
	</div>
	<div class="row">
		<p class="badge">Busca dinâmica:
			<input name="busca" id="busca" type="text" tabindex="1" autocomplete="off"><br>
				<div class="container" name="resultadobusca" id="resultadobusca"></div>
		</p>
	</div>
	<div class="row">
		<form action="checkempresa.php" method="post" target="empresadisplay">
			<p class="badge">Ramo de atividade: 
			<input type="hidden" name="opt" value="ramo" id="ramo" />
			<select name="ramoatividade" id="ramoatividade">
			<?php
				$sqlramo = "SELECT valor,opcao from ramoatividade ORDER BY opcao ASC";
				$sqlramoexe = $conn->query($sqlramo);
				while ($rowramo = $sqlramoexe->fetch_array()) {
					echo "<option value='$rowramo[valor]'>$rowramo[opcao]</option>";
				}
			?>
			</select>
			<button type="submit" class="btn btn-outline-info" style="margin: 5px;">Buscar</button>
		</form>
	</div>
				<iframe class="iframe" name="empresadisplay" width="700" height="400" style="border:0;position:absolute;overflow:hidden">
				</iframe>

</div>
<script type="text/javascript" >
//função Busca empresa live
$(document).ready(function(){

load_data();

 function load_data(query)
 {
  $.ajax({
   url:"ajax-empresa.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#resultadobusca').html(data);
   }
  });
 }
 $('#busca').keyup(function(){
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
</script>
</body>
</html>
<?php
//fim do arquivo
?>