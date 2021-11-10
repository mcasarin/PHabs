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
<div class="col-md-2 container col-centered"><a class="btn btn-success" role="button" href="garagem.php"> <<< Voltar <<< </a></div>
<br/>
<?php
/*
*  Consulta de solicitação de tag no site edificiochurchill.com.br
*/
/* Validar SQL para agregar campos
select ybd53_facileforms_records.id as idsoltag, ybd53_facileforms_records.username as usuario,ybd53_facileforms_records.user_full_name as nome,ybd53_facileforms_records.form as form, ybd53_facileforms_records.user_id as userid, ybd53_facileforms_records.submitted as datahora, ybd53_empresa.Empresa as Empresa from ybd53_facileforms_records,ybd53_users,ybd53_empresa,ybd53_fields_values where ybd53_facileforms_records.user_id = ybd53_users.id and ybd53_fields_values.value = ybd53_empresa.id_empresa and ybd53_facileforms_records.form='4' order by ybd53_facileforms_records.submitted ASC;
*/
$sql = "SELECT a.id AS idsoltag, a.submitted AS datahora, a.username AS usuario, a.user_full_name AS nome, a.form AS form, a.archived AS visual, b.Empresa AS Empresa FROM ybd53_facileforms_records a JOIN ybd53_fields_values c ON c.item_id = a.user_id JOIN ybd53_empresa b ON c.value = b.id_empresa WHERE a.form='4' AND a.archived='1' AND a.id IN (SELECT record FROM ybd53_facileforms_subrecords WHERE element = '385' AND value != 'Tag_encaminhada') ORDER BY datahora DESC";

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
	  <th>Invalidado</th>
    </thead>
    <?php
    $listuser = $connremote->query($sql);
	
    if ($listuser->num_rows > 0) {
      while ($row = $listuser->fetch_array(MYSQLI_ASSOC)) {
		$datarow = date_create($row['datahora']);
		$dataMod = date_format($datarow, 'd/m/y H:i');
		$ID = $row['idsoltag'];
		$Empresa = $row['Empresa'];
        echo "<tr><td><a class='btn btn-danger btn-sm' href='validasolicitacaotaginvalidada.php?ID=$ID&Empresa=$Empresa'>" . $ID . "</a></td><td> " . $dataMod . " </td><td> " . $row['usuario'] . " </td><td> " . $row['nome'] . " </td><td> " . $Empresa . " </td><td>";
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