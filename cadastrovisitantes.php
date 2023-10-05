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
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 523 -->
	<link rel="stylesheet" href="../css/bootstrap.css">
	<script src="../js/jquery-3.6.4.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<title>Cadastro de Visitantes </title>
</head>
<body OnLoad='document.getElementById("rg").focus();'>

	<div class="container-fluid">
	<h2 style="text-align:center;background-color:#FEE39A;">Cadastro de Visitantes</h2>
		<div class="row">
			<div class="col-6" style="margin:20px;">
				<form action="include/buscavisitante.php" id="busca" method="POST" class="form-horizontal" autocomplete="off">
				<label>Documento (RG): </label> 
				<input type="text" id="rg" name="rg" placeholder=" preferencialmente RG  " value="<?php echo $rg;?>" autofocus required onfocus="var temp_value=this.value; this.value=''; this.value=temp_value" style="margin-bottom:20px;"> <!-- Função para colocar o focus no final do texto retornado -->
				<button id="btnSubmit" type="submit" class="btn btn-info"> Busca </button>
				<br>
				<span class="alert alert-info" style="display:block;align-self:flex-end;">Insira o documento para busca do cadastro.</span>
				</form>
			</div>
		</div> <!-- end row -->
	</div> <!-- end container -->
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
