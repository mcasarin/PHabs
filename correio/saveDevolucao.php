<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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
    <title>Upload de Imagem</title>
</head>
<body>
<div class="container">

<?php
// Verifica se o arquivo foi enviado corretamente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $dataInfo = $_POST['dataInfo'];
  $conjunto = $_POST['conjunto'];
  $registroar = $_POST['registroar'];
  $motivo = $_POST['motivo'];
  $login = $_SESSION['nome'];
  $imageData = $_POST['imagem_data'];
  $fileName = $_FILES['imgdev']['name'];
  $fileTmpName = $_FILES['imgdev']['tmp_name'];
  $fileSize = $_FILES['imgdev']['size'];
  //$fileError = $_FILES['imgdev']['error'];
  $fileType = $_FILES['imgdev']['type'];
  $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
  $fileExt = mb_strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  $allowedExt = array('jpg', 'jpeg', 'png', 'gif');
  // testando saída
  //echo $fileSize."<br>";
  //var_dump($fileName);
  //var_dump($fileTmpName);
  if (in_array($fileExt, $allowedExt)) {
    //if ($fileError === 0) {
      if ($fileSize < 5000000) {
        $fileNameNew = $fileNameWithoutExt . '.' . $fileExt;
        $imgpath = 'uploads/' . $fileNameNew;
        if(file_exists($imgpath)){ // verificado se o arquivo já existe, se existe botão VOLTAR recarrega as infos para o form
          echo "<div class='row'><div class='col-6'><p class='alert alert-danger' role='alert'>Arquivo já foi inserido na Devolução.<br>Clique em voltar para recarregar o formulário com os dados.<br>
          <form action='devolucao.php' method='post'>
            <input type='hidden' value='$dataInfo' name='dataInfo'>
            <input type='hidden' value='$conjunto' name='conjunto'>
            <input type='hidden' value='$registroar' name='registroar'>
            <input type='hidden' value='$motivo' name='motivo'>
            <input type='hidden' value='$fileName' name='imgdevVoltar'>
            <button type='submit' class='btn btn-info btn-sm' name='submit'>Voltar</button>
            </form></div></div>";
        } else {
        move_uploaded_file($fileTmpName, $imgpath);

        $sql = "INSERT INTO corr_devolucoes (dataInfo, conjunto, registroar, motivo, imgpath, login) VALUES (?, ?, ?, ?, ?, ?)";
        $sqlexe = $conn->prepare($sql);
        $sqlexe->bind_param('ssssss', $dataInfo, $conjunto, $registroar, $motivo, $imgpath, $login);
        
        if ($sqlexe->execute() === true) {
          echo "<div class='row'><div class='col-6'><p class='alert alert-success' role='alert'>Upload e gravação realizado com sucesso!</div></div>";
          echo "<a href='devolucao.php' class='btn btn-outline-info'>Voltar</a>";
        } else {
          echo "<div class='row'><div class='col-6'><p class='alert alert-danger' role='alert'>Falha na gravação no banco de dados. Desfazendo upload.</div></div>";
          printf("Errormessage: %s\n", $conn->error);
          echo "<br><a href='devolucao.php' class='btn btn-outline-warning'>Voltar</a>";
          unlink($imgpath);
        }
        } // end if verificação de arquivo
    } else {
      echo "Falha no tamanho";
    }
    /*} else {
      echo "Falha no arquivo";
    }*/
  } else {
    echo "Falha na extensão do arquivo";
  }
} else {
  echo "Falhou o POST";
}
$conn->close();
?>
</div>
</body>
</html>