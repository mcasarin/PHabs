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
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
</head>
<?php
//header('Content-Type: text/html; charset=iso-8859-1');
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);

 $query = "SELECT Empresa,CNPJ,IE,contato,Telefone,email,obs,ID FROM empresas WHERE Empresa like '%".$search."%' OR Conjunto like '%".$search."%' OR obs like '%".$search."%'";
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
 $output .= '<td>Empresa</td><td>CNPJ</td><td>IE</td><td>Contato</td><td>Telefone</td><td>E-mail</td><td>OBS</td></tr>';
 while($row = mysqli_fetch_array($result)){
  $output .= '<tr>';
    if($_SESSION["tipo"] == '0'){
      $output .='<td><a class="btn btn-outline-info btn-sm" href="editarempresa.php?ID='.$row["ID"].'&formdirect=update"> Editar </a></td>';
    }
    $output .='<td>'.$row[Empresa].'</td><td>'.$row[CNPJ].'</td><td>'.$row[IE].'</td><td>'.$row[contato].'</td><td>'.$row[Telefone].'</td><td>'.$row[email].'</td><td>'.$row[obs].'</td></tr></form>';
 }
 $output .= '</table>';
 echo $output;
} else {
 echo $output .= '<div class="bg-warning" style="width: 300px;text-align:center"> Nenhum registro encontrado!</div>';
}
$conn->close;
?>