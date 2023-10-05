<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=UTF-8>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jquery-3.6.4.min.js"></script>
<title>Empresas</title>
</head>
<body>
<div class="container">
	
	<div class="row">
		<div class="col-2">
			<p>Busca dinâmica:</p>
		</div>
		<div class="col-3">
			<input name="busca" id="busca" type="text" tabindex="1" autocomplete="off">
		</div>
		<div class="container" name="resultadobusca" id="resultadobusca">

		</div>
	</div>
	<hr>
	<div class="row">
			<div class="col-2">
				<p><small>Lista em Ordem:</small></p>
			</div>
			<div class="col-2">
				<form action="checkempresa.php" method="post" target="empresadisplay">
					<input type="hidden" name="opt" value="conj" id="conj" />
					<button type="submit" value="submit" class="btn btn-outline-info" style="margin: 5px;">Conjunto</button>
				</form>
			</div>
			<div class="col-2">
				<form action="checkempresa.php" method="post" target="empresadisplay">
					<input type="hidden" name="opt" value="sonome" id="sonome" />
					<button type="submit" class="btn btn-outline-info" style="margin: 5px;">Ausentes</button>
				</form>
			</div>
			<div class="col-2">
				<form action="consultaempresa.php" method="post">
					<button type="submit" class="btn btn-warning" style="margin: 5px;">Limpar resultados</button>
				</form>
			</div>
	</div>
	<div class="row">
		<div class="col-2">
			<form action="checkempresa.php" method="post" target="empresadisplay">
			<p><small>Ramo de atividade:</small></p>
		</div> 
		<div class="col-4">
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
		</div>
		<div class="col-2">
			<button type="submit" class="btn btn-outline-info" style="margin: 5px;">Buscar</button>
		</form>
		</div>
	</div>
	<iframe class="iframe" name="empresadisplay" height="400" width="100%" style="border:0;overflow:hidden">
	</iframe>
</div>

<script type="text/javascript" >
//função Busca empresa live
$(document).ready(function() {
  var timerId;

  $('#busca').on('input', function() {
    var search = $(this).val();

    clearTimeout(timerId);

    if (search !== '') {
      timerId = setTimeout(function() {
        $.ajax({
          method: 'POST',
          url: 'ajax-empresa.php',
          data: {
            query: search
          },
          success: function(data) {
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