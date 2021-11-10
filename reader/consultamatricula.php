<?php
include_once('../include/connect.php');
$matricula = "";

if (isset($_POST['matricula'])) {
  $matricula = $_POST['matricula'];
  $sql = "select count(*) as ctnMatricula from cartoes where sequencia='$matricula'";
  $result = $conn->query($sql);
  if ($result->num_rows) {
    $row = mysqli_fetch_array($result);
    $count = $row['ctnMatricula'];
    if ($count > 0) {
      $check = "<span style='color: red;'>Matrícula já existe!</span>";
    } else {
      $check = "<span style='color: green;'>Matrícula OK!</span>";
    }
    echo $check;
  }
}