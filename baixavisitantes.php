<?php
include 'include/function.php';
include 'include/connect.php';
sessao();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 523 -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<script src="js/jquery-3.6.4.min.js"></script>
	<script src="js/bootstrap.js"></script>

<title>Baixa de Visitantes </title>
</head>
<body>

<div class="container">
    <h3 style="text-align:center;background-color:#FEE39A;">Baixa de Visitantes</h3>
	<div class="row" style="margin-bottom:10px;"> <!-- row 1 -->
		<div class="col-2">
			<label>Busca dinâmica: </label>
		</div>
		<div class="col-4">
			<input name="busca" id="busca" type="text" tabindex="1" autocomplete="off" />
		</div>
		<div class="container-fluid" name="resultadobusca" id="resultadobusca"></div>
	</div> <!-- row 1 -->
	<div class="row"> <!-- row 2 -->
		
			<div class="col-1">
				<label>Ordem: </label>
			</div>
			<div class="col-2">
			<form action="include/checkbaixa.php" method="post" target="baixadisplay">
				<input type="hidden" name="opt" value="doc" id="doc" />
				<button type="submit" value="submit" class="btn btn-outline-dark">Por Documento</button>
			</form>
			</div>
			<div class="col-2">
			<form action="include/checkbaixa.php" method="post" target="baixadisplay">
				<input type="hidden" name="opt" value="cartao" id="cartao" />
				<button type="submit" class="btn btn btn-outline-dark">Por Cartão</button>
			</form>
			</div>
			<div class="col-2">
			<form action="include/checkbaixa.php" method="post" target="baixadisplay">
				<input type="hidden" name="opt" value="nome" id="nome" />
				<button type="submit" class="btn btn btn-outline-dark">Por Nome</button>
			</form>
			</div>
			<div class="col-3">
			<?php
			if($_SESSION["tipo"] == '0'){ // administrativo
				?>
			<form action="include/checkbaixa.php" method="post" target="baixadisplay">
				<button type="submit" class="btn btn btn-outline-dark">Por documento com data</button>
				<input type="hidden" name="opt" value="data" id="data" />
			</form>
			<?php
			} // if administrativo
			?>
			</div>
			
		
	</div> <!-- row 2 -->
		
	<div class="container-fluid">
		<iframe class="iframe" name="baixadisplay" width="700" height="800" style="border:0;position:absolute;overflow:hidden">
		</iframe>
	</div>
</div> <!-- fim container -->

<script type="text/javascript">
//função Busca cartão live
$(document).ready(function() {
  var timerId;

  $('#busca').on('input', function() {
    var search = $(this).val();

    clearTimeout(timerId);

    if (search !== '') {
      timerId = setTimeout(function() {
		  $.ajax({
		  url:"include/ajax-baixa.php",
   			method:"POST",
   			data:{
				query:search
			},
			success:function(data) {
    			$('#resultadobusca').html(data);
				$('#resultadobusca').css('display', 'block');
   			},
   			error: function(error) {
            console.error(error);
          }
        }).fail(function(error) {
          console.error(error);
        });
      }, 400); // delay de 500ms (meio segundo)
    } else {
      $('#resultadobusca').css('display', 'none');
    }
  });
});
</script>
</body>
</html>
<?php
//fim do arquivo
?>
