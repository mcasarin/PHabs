<?php
//fonte: https://www.webslesson.info/2016/03/ajax-live-data-search-using-jquery-php-mysql.html
include "function.php";
include "connect.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.js"></script>
</head>
<?php
//header('Content-Type: text/html; charset=iso-8859-1');
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);

 $query = "SELECT Doc,Nome,Matricula,Campo1 FROM visopen WHERE Doc like '%".$search."%' OR Matricula like '%".$search."%' OR Nome like '%".$search."%'";
}
/*else
{
 $query = "
  SELECT * FROM tbl_customer ORDER BY CustomerID
 ";
}*/
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0) {
	
 $output .= '<br><table class="table table-striped" style="font-size: 11px;"><tr style="background: lightgrey;"><td>Baixa</td><td>Documento</td><td>Nome</td><td>Cartão</td><td>Status</td></tr>';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '<tr><td><form action="include/execbaixa.php" method="post">
  <input type="hidden" name="rg" id="rg" value="'.$row[Doc].'">
	<input type="hidden" name="cartao" id="cartao" value="'.$row[Matricula].'">
  <button type="submit" name="submit" class="btn btn-outline-dark btn-sm"> Baixa </button></td>
	<td>'.$row[Doc].'</td><td>'.$row[Nome].'</td><td>'.$row[Matricula].'</td><td>'.$row[Campo1].'</td></tr></form>';
 }
 $output .= '</table>';
 echo $output;
} else {
 echo $output .= '<div class="bg-warning" style="width: 300px;text-align:center"> Nenhum registro encontrado!</div>';
}
$conn->close;
?>