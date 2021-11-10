<?php
include '../include/function.php';
include '../include/connect.php';
include '../include/connectremote.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery-1.12.4.js"></script>
  <script src="../js/jquery-ui-1.12.1.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</head>
<?php
/*
*  Consulta de usuarios do site edificiochurchill.com.br
*/

$sql = "select ybd53_users.id as idusuario,ybd53_users.name as nome,ybd53_users.username as user,ybd53_users.email as email,ybd53_users.block as block,ybd53_empresa.Empresa as Empresa from ybd53_users,ybd53_empresa,ybd53_fields_values where ybd53_fields_values.item_id = ybd53_users.id and ybd53_fields_values.value = ybd53_empresa.id_empresa order by Empresa+0 ASC;";
?>
<div class="table-responsive">
  <table class="table table-hover table-sm">
    <thead align="center">
      <th>Empresa</th>
      <th>ID</th>
      <th>Nome</th>
      <th>Usuário</th>
      <th>E-mail</th>
      <th>Bloqueado</th>
    </thead>
    <?php
    $listuser = $connremote->query($sql);

    if ($listuser->num_rows > 0) {
      while ($row = $listuser->fetch_array(MYSQLI_ASSOC)) {
        echo "<tr><td>" . $row['Empresa'] . " </td><td> " . $row['idusuario'] . " </td><td> " . $row['nome'] . " </td><td> " . $row['user'] . " </td><td> " . $row['email'] . " </td><td>";
        if ($row['block'] == '1') {
          echo "<b>SIM</b>";
        } else {
          echo "Não";
        }
        echo "</td></tr>";
      }
    }
    echo "</table></div>";
 $connremote->close();