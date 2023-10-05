<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include '../include/function.php';
include_once '../include/connect.php';
sessao();
// Logs
//use Monolog\Level;
//use Monolog\Logger;
//use Monolog\Handler\StreamHandler;
//use Monolog\Handler\FirePHPHandler;

// Create the logger
//$logger = new Logger('my_logger');
// Now add some handlers
//$logger->pushHandler(new StreamHandler(__DIR__.'/monolog.log', Level::Debug));
//$logger->pushHandler(new FirePHPHandler());
// You can now use your logger
//$logger->info('Salvando',['usuario' => $_SESSION['usuario']]);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro Entrada</title>
</head>
<body>
<div class="container">

<?php
// Verifica se o arquivo foi enviado corretamente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $valid = "";
  $dataInfo = $_POST['dataInfo'];
  $conjunto = $_POST['conjunto'];
  $nome = $_POST['nome'];
  $registroar = $_POST['registroar'];
  $tipoar = $_POST['tipoar'];
  $obs = $_POST['obs'];
  $disc = $_POST['disc'];
  $login = $_SESSION['nome'];
  $imageData = $_POST['imagem_data'];
  $fileName = $_FILES['imgentr']['name'];
  $fileTmpName = $_FILES['imgentr']['tmp_name'];
  $fileSize = $_FILES['imgentr']['size'];
  //$fileError = $_FILES['imgentr']['error'];
  $fileType = $_FILES['imgentr']['type'];
  $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
  $fileExt = mb_strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  $allowedExt = array('jpg', 'jpeg', 'png', 'gif');
  // testando saída
  //echo $fileSize."<br>";
  //var_dump($fileName);
  //var_dump($fileTmpName);
  if($fileTmpName != ""){
    if(in_array($fileExt, $allowedExt)) {
    //if ($fileError === 0) {
      if ($fileSize < 5000000) {
        $fileNameNew = $fileNameWithoutExt . '.' . $fileExt;
        $imgpath = 'uploads/' . $fileNameNew;
        if(file_exists($imgpath)){ // verificado se o arquivo já existe, se existe botão VOLTAR recarrega as infos para o form
          echo "<div class='row'><div class='col-6'><p class='alert alert-danger' role='alert'>Arquivo já existe no banco de dados.<br>Clique em voltar para recarregar o formulário com os dados.<br>
          <form action='entrada.php' method='POST'>
            <input type='hidden' value='$dataInfo' name='dataInfo'>
            <input type='hidden' value='$nome' name='nome'>
            <input type='hidden' value='$conjunto' name='conjunto'>
            <input type='hidden' value='$registroar' name='nome'>
            <input type='hidden' value='$tipoar' name='tipoar'>
            <input type='hidden' value='$obs' name='obs'>
            <input type='hidden' value='$disc' name='disc'>
            <input type='hidden' value='$fileName' name='imgentrVoltar'>
            <button type='submit' class='btn btn-info btn-sm' name='submit'> Voltar </button>
            </form></div></div>";
        } else {
          move_uploaded_file($fileTmpName, $imgpath);
          $valid = "com";
        } // end if verificação de arquivo
    } else {
      echo "<div class='row'><div class='col-6'><p class='alert alert-danger' role='alert'>Falha no tamanho</div></div>";
      echo "<a href='entrada.php' class='btn btn-outline-warning'>Voltar</a>";
    }
  } else {
    echo "<div class='row'><div class='col-6'><p class='alert alert-danger' role='alert'>Falha na extensão do arquivo</div></div>";
    echo "<a href='entrada.php' class='btn btn-outline-warning'>Voltar</a>";
  }
} else { // não tem arquivo
  $valid = "sem";
}    
        
  if($valid != ""){
      if($valid == "com"){ // validação se há upload de arquivo
        $valid = $imgpath;
      } else {
        $valid = "sem imagem";
      }
        $sql = "INSERT INTO corr_entrada (dataInfo, nome, conjunto, registroar, tipoar, obs, disc, imgpath, login) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sqlexe = $conn->prepare($sql);
        $sqlexe->bind_param('sssssssss', $dataInfo, $nome, $conjunto, $registroar, $tipoar, $obs, $disc, $valid, $login);
        
        if ($sqlexe->execute() === true) {
          echo "<div class='row'><div class='col-6'><p class='alert alert-success' role='alert'>Upload e gravação realizado com sucesso!</div></div>";
          echo "<a href='menuEntradas.php' class='btn btn-outline-info'>Voltar</a>";
        } else {
          echo "<div class='row'><div class='col-6'><p class='alert alert-danger' role='alert'>Falha na gravação no banco de dados. Desfazendo upload.</div></div>";
          printf("Errormessage: %s\n", $conn->error);
          echo "<br><a href='menuEntradas.php' class='btn btn-outline-warning'>Voltar</a>";
          unlink($imgpath);
        }
      } 
} else {
  echo "Falhou o POST";
}
$conn->close();
?>
</div>
</body>
</html>