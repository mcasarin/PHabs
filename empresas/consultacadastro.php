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
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>

<title>Empresas</title>
</head>
<body>
<div class="container">

		<div class="btn btn-group">
			<button class="btn-sm btn-info" disabled>Lista em Ordem: </button>
			<form action="checkempresa.php" method="post" target="empresadisplay">
			<input type="hidden" name="opt" value="conj" id="conj" />
			<button type="submit" value="submit" class="btn btn-outline-info" style="margin: 5px;">Conjunto</button>
			</form>
			<form action="checkempresa.php" method="post" target="empresadisplay">
			<input type="hidden" name="opt" value="nomeconj" id="nomeconj" />
			<button type="submit" class="btn btn-outline-info" style="margin: 5px;">Nome</button>
			</form>
			<form action="checkempresa.php" method="post" target="empresadisplay">
			<input type="hidden" name="opt" value="sonome" id="sonome" />
			<button type="submit" class="btn btn-outline-info" style="margin: 5px;">Ausentes e Prestadores</button>
			</form>
           
		   		<form action="consultacadastro.php" method="post">
				<button type="submit" class="btn btn-warning" style="margin: 5px;">Limpar resultados</button>
				</form>
				
		</div>
		<div class="container">
		<button class="btn-sm btn-outline-info" disabled style="margin-right: 5px;margin-bottom: 5px">Busca dinâmica: </button><input name="busca" id="busca" type="text" tabindex="1" autocomplete="off" />
		<div class="container-fluid" name="resultadobusca" id="resultadobusca"></div>
		</div>
		<div class="container-fluid">
		<iframe class="iframe" name="empresadisplay" width="700" height="400" style="dysplay:none;border:0;position:absolute;overflow:hidden">
		</iframe>
		</div>
	</div> <!-- fim container -->
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
<?php
//fim do arquivo
?>
