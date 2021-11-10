<?php
include 'include/function.php';
sessao();
$rg = "";
if(isset($_POST['rg'])) {
	$rg = $_POST['rg'];
} else {
	$rg = "";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/churchill.css">
	<script src="js/jquery-1.12.4.js"></script>
	<script src="js/jquery-ui-1.12.1.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<title>Cadastro de Visitantes </title>
	</head>
<body OnLoad='document.getElementById("rg").focus();'>

	<div class="row">
	<div class="col-xs-3 col-md-2">&nbsp;</div>
	<div class="col-xs-6 col-md-4 col-centered"><h2>Cadastro de Visitantes</h2></div>
	<div class="col-xs-3 col-md-2">&nbsp;</div>
	</div> <!-- class row -->
	<div class="row">
			<div class="col-xs-1 col-md-1">&nbsp;</div>
			<form action="include/buscavisitante.php" id="busca" method="POST" class="form-horizontal" autocomplete="off">
			<div class="col-xs-6 col-md-3 col-centered"><label>Documento (RG): </label> <input type="text" id="rg" name="rg" placeholder=" preferencialmente RG  " value="<?php echo $rg;?>" autofocus required onfocus="var temp_value=this.value; this.value=''; this.value=temp_value"> <!-- Função para colocar o focus no final do texto retornado -->
			<button id="btnSubmit" type="submit" class="btn btn-default"> Busca </button>
			</div>
			</form>
	</div>
	<div class="row">
		<div class="col-xs-1 col-md-2">&nbsp;</div><div class="col-xs-8 col-md-4">
		<span class="help-block">Insira o documento para busca do cadastro.</span></div>
	</div>
</body>
</html>
<script>
var input = document.getElementById("rg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("btnSubmit").click();
  }
});
</script>
<?php
?>
