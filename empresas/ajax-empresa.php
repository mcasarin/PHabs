<?php
//fonte: https://www.webslesson.info/2016/03/ajax-live-data-search-using-jquery-php-mysql.html
include "../include/function.php";
include "../include/connect.php";
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-3.6.4.min.js"></script>
<script src="../js/bootstrap.js"></script>
<style>
	.css-table {
	display: table;
	width: 550px;
	margin: auto;
	}
	
	.css-table-header {
	display: table-header-group;
	font-weight: bold;
	background-color: rgb(191, 191, 191);
	}
	
	.css-table-body {
	display: table-row-group;
	width: 550px;
	margin: auto;
	font-size: 12px;
	}
	
	.css-table-row {
	display: table-row;
	}
	
	.css-table-header div,
	.css-table-row div {
	display: table-cell;
	padding: 0 6px;
	}
	
	.css-table-header div {
	text-align: center;
	border: 1px solid rgb(255, 255, 255);
	}
	.menor {
		font-size: 12px;
	}
	</style>
</head>
<?php
//header('Content-Type: text/html; charset=iso-8859-1');
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);

 $query = "SELECT emp.Empresa,emp.contato,emp.Telefone,emp.email,emp.obs,emp.ID,info.conjagregados as conjagregados FROM empresas as emp left join empresas_info as info on emp.ID = info.id_ei WHERE emp.Empresa like '%".$search."%' OR emp.Conjunto like '%".$search."%' OR emp.obs like '%".$search."%' OR info.conjagregados like '%".$search."%' limit 5";
}
/*else
{
 $query = "
  SELECT * FROM tbl_customer ORDER BY CustomerID
 ";
}*/
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0) {
	
 $output .= '<br><table class="table table-striped" style="font-size: 11px;"><tr style="background: lightgrey;">';
 if($_SESSION["tipo"] == '0'){
  $output .= '<td>Editar</td>';
 }
 $output .= '<td>Empresa</td><td>Contato</td><td>Telefone</td><td>E-mail</td><td>Tel Emergenciais</td><td>OBS</td><td>Conjuntos agregados</td></tr>';
 while($row = mysqli_fetch_assoc($result)){
  $output .= '<tr>';
    if($_SESSION["tipo"] == '0'){
      $output .='<td><a class="btn btn-outline-info btn-sm" href="editarempresa.php?ID='.$row["ID"].'&formdirect=update"> Editar </a></td>';
    }
    $output .='<td>'.$row["Empresa"].'</td><td>'.$row["contato"].'</td><td>'.$row["Telefone"].'</td><td>'.$row["email"].'</td>
    <td><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalCenterTelEmerg'.$row["ID"].'"> 
    Telefones Emergenciais </button></td><td>'.$row["obs"].'</td><td>'.$row["conjagregados"].'</td></tr></form>';
    $output .='<div class="modal fade" id="ModalCenterTelEmerg'.$row["ID"].'" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title btn-danger" id="ModalLongTitle">Telefones Emergenciais</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        
        </button>
      </div>
      <div class="modal-body">
      <div class="css-table-row"><span class="badge badge-light">Conjunto: '.$row["Empresa"].'</span></div><br>
        <div class="css-table">
          <div class="table-body">
            <div class="css-table-row"><div class="cell">Nome: '.$row["nome1"].'</div>
            <div class="cell">Telefone: '.$row["telemerg1"].'</div></div>
            <div class="css-table-row"><div class="cell">Nome: '.$row["nome2"].'</div>
            <div class="cell">Telefone: '.$row["telemerg2"].'</div></div>
            <div class="css-table-row"><div class="cell">Nome: '.$row["nome3"].'</div>
            <div class="cell">Telefone: '.$row["telemerg3"].'</div></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
      </div>
      </div>
    </div>
    </div>';
 }
 $output .= '</table>';
 echo $output;
} else {
 echo $output .= '<div class="bg-warning" style="width: 300px;text-align:center"> Nenhum registro encontrado!</div>';
}
$conn->close();
?>
