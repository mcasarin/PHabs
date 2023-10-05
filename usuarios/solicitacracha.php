<?php
include '../include/function.php';
include '../include/connect.php';
include '../include/connectremote.php';
sessao();

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/churchill.css">
<script src="../js/jquery-1.11.3.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Solicitação de TAG</title>
</head>
<body>
<div class="col-md-2 container col-centered"><a class="btn btn-success" role="button" href="index.php"> <<< Voltar <<< </a></div>

<?php
/*
*  Consulta de solicitação de tag no site edificiochurchill.com.br
*/
/* Validar SQL para agregar campos
select ybd53_facileforms_records.id as idsoltag, ybd53_facileforms_records.username as usuario,ybd53_facileforms_records.user_full_name as nome,ybd53_facileforms_records.form as form, ybd53_facileforms_records.user_id as userid, ybd53_facileforms_records.submitted as datahora, ybd53_empresa.Empresa as Empresa from ybd53_facileforms_records,ybd53_users,ybd53_empresa,ybd53_fields_values where ybd53_facileforms_records.user_id = ybd53_users.id and ybd53_fields_values.value = ybd53_empresa.id_empresa and ybd53_facileforms_records.form='4' order by ybd53_facileforms_records.submitted ASC;
*/
$sql = "select a.id as idsoltag, a.submitted as datahora, a.username as usuario, a.user_full_name as nome, a.form as form, a.viewed as visual, b.Empresa as Empresa from ybd53_facileforms_records a join ybd53_fields_values c ON c.item_id = a.user_id join ybd53_empresa b ON c.value = b.id_empresa where a.form='2' and a.exported='0' and a.archived='0' order by a.submitted ASC;";

$listSolTag = $connremote->query($sql);
?>
<div class="table-responsive">
  <table class="table table-hover table-sm">
    <thead align="center">
      <th>ID</th>
      <th>Data Hora</th>
      <th>Usuário</th>
      <th>Nome</th>
      <th>Empresa</th>
	  <th>Visualizado</th>
    </thead>
    <?php
    $listuser = $connremote->query($sql);
	 
    if ($listuser->num_rows > 0) {
      while ($row = $listuser->fetch_array(MYSQLI_ASSOC)) {
		$datarow = date_create($row['datahora']);
		$dataMod = date_format($datarow, 'd/m/y H:i');
        echo "<tr><td>" . $row['idsoltag'] . " </td><td> " . $dataMod . " </td><td> " . $row['usuario'] . " </td><td> " . $row['nome'] . " </td><td> " . $row['Empresa'] . " </td><td>";
		echo ($row['visual'] == '1') ? "sim" : "não";
		echo "</td></tr>";
      }
    }
	?>
    </table>
</div>
<?php
$connremote->close();
?>

</div>
</body>