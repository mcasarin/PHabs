<?php
include '../include/function.php';
include '../include/connect.php';
include '../include/connectremote.php';

sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <script src="../js/jquery-1.12.4.js"></script>
  <script src="../js/jquery-ui-1.12.1.js"></script>
  <script src="../js/bootstrap.js"></script>

  <title>Editar Empresas</title>
</head>
<?php
if (isset($_GET["ID"])) {
  $ID = $_GET["ID"];

  $sql = "SELECT ybd53_users.id AS idusuario,ybd53_users.name AS nome,ybd53_users.username AS user,ybd53_users.email AS email,ybd53_users.block AS block,ybd53_empresa.Empresa AS Empresa FROM ybd53_users,ybd53_empresa,ybd53_fields_values WHERE ybd53_fields_values.item_id = ybd53_users.id AND ybd53_fields_values.value = ybd53_empresa.id_empresa AND ybd53_empresa.id_empresa = '$ID' ORDER BY Empresa+0 ASC;";
?>
  <span>
    <a href="editarempresa.php?ID=<?php echo $ID; ?>&formdirect=update" class="btn btn-warning btn-sm" target="_self"> Retorna ao cadastro da Empresa</a>
  </span>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead align="center">
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
        echo "<tr><td> " . $row['idusuario'] . " </td><td> " . $row['nome'] . " </td><td> " . $row['user'] . " </td><td> " . $row['email'] . " </td><td>";
        if ($row['block'] == '1') {
          echo "<b>SIM</b>";
        } else {
          echo "Não";
        }
        echo "</td></tr>";
      }
    } else {
      echo "<td colspan=\"5\"><b><h3>Não foi encontrado usuário no site para esse conjunto!</h3><b></td>";
    }
    echo "</table></div>";
  } // end if GET
  $connremote->close();
