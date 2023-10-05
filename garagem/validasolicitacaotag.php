<?php
include '../include/function.php';
include '../include/connect.php';
include '../include/connectremote.php';
sessao();
$ID = "";
$Empresa = "";
$contavaga = 0;
/*
#
Modal: https://www.w3schools.com/howto/howto_css_modals.asp
#
*/
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/churchill.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #ff6600;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #ff6600;
  color: white;
}
</style>
<title>Solicitação de TAG</title>
</head>
<body>
<div class="col-md-2 container col-centered"><a class="btn btn-success" role="button" href="solicitacaotagsite.php"> <<< Voltar <<< </a></div>

<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
	$ID = $_GET['ID'];
	$Empresa = $_GET['Empresa'];

$sql = "select a.id as idformtag, a.record as idregistro, a.name as camposform, a.value as valor from ybd53_facileforms_subrecords a where a.record = '$ID';";
$sqlSolVaga = "select a.value as vagainfo from ybd53_facileforms_subrecords a where a.record = '$ID' and a.name = 'Vaga';";
$sqlEmpresa = "select vaga from garagem where utiliza IN (select ID from empresas where Empresa = '$Empresa');";

$listSol = $connremote->query($sql);
$validaSolVaga = $connremote->query($sqlSolVaga);
$validaVaga = $conn->query($sqlEmpresa);

$formVaga = $validaSolVaga->fetch_array(MYSQLI_ASSOC);
$vagainfo = $formVaga['vagainfo'];
$vagaencontrada = "";
?>
<br/>
<div class="container-fluid">
	<div class="row">
		
		<div class="col">
<?php
	
	if ($listSol->num_rows > 0) {
      while ($row = $listSol->fetch_array(MYSQLI_ASSOC)) {
		$ID = $row['idregistro'];

        echo "<span><strong>" . $row['camposform'] . ":</strong> </td><td> " . $row['valor'] . " </span><br/>";
		
      }
	  echo "<br/>";
	  print_r($listSol->fetch_assoc);
    }
	
	if($validaVaga->num_rows > 0){
		
		echo "<span class='alert alert-success'><strong>Vaga(s) do Conjunto:&nbsp;</strong>";
		while ($rowVaga = $validaVaga->fetch_array(MYSQLI_ASSOC)){
			$vagaencontrada = $rowVaga['vaga'];
			if($vagainfo == $vagaencontrada){
				echo "<span class='badge badge-success'>".$vagaencontrada." </span>&nbsp;";
				$contavaga++;
			} else {
				echo "<span class='badge badge-secondary'>".$vagaencontrada." </span>&nbsp;";
			}
		}
		echo "</span><br/><br/>";
	} else {
		echo "<span class='alert alert-danger'>Valide a existência de vagas para o conjunto.</span>";
	}
	echo "<br/>";
	$botaoValida = "";
	if($contavaga == 0){
		echo "<span class='alert alert-warning'>Vaga informada no formulário <b>não</b> foi encontrada nas vagas cadastradas do conjunto.</span><br><br>";
		$botaoValida = "<a class='btn btn-dark' href=''>Validar Solicitação</a>";
	} else {
		$botaoValida = "<a class='btn btn-success' href='validaexec.php?ID=".$ID."&valid=S&motivo=Tag_encaminhada'>Validar Solicitação</a>";
	}
	echo "<div class='row'>
	<div class='col-md-6 container col-centered'>";
	echo $botaoValida;
	echo "</div>";
	echo "<div class='col-md-6 container col-centered'>
		<button class='btn btn-outline-dark' id='myBtn'> <b>Invalidar</b> solicitação </button>
	</div></div>";
	?>
		</div>
	</div>
</div>
<!-- Modal Motivo -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
		<form action='validaexec.php' method='GET'>
			<input type='hidden' name='ID' id='ID' value='<?php echo $ID; ?>'>
			<input type='hidden' name='valid' id='valid' value='N'>
				<h4>Motivo</h4>
				<label>Descreva o motivo da invalidação</label><br>
				<textarea name='motivo' id='motivo' maxlength='455' rows='4' cols='50' autofocus required></textarea><br><br>
				<input class='btn btn-info' type='submit' name='botGravar' id='botGravar' value='Gravar'>
		</form>
    </div>
    <div class="modal-footer">
    </div>
  </div>

</div>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<?php
} else {
// BLANK PAGE
}

$connremote->close();
$conn->close();
?>
</body>
</html>