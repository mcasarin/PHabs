<?php
if(isset($_POST['submit'])){
    $servidor = $_POST['servidor'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $db = $_POST['db'];
    $dados = "<?php \n\$servername='$servidor';\n\$username='$user';\n\$password='$pass';\n\$dbname='$db';";
    $criarconfig = fopen("config.php","w+");
    $escreveconfig = fwrite($criarconfig,$dados);
    fclose($criarconfig);
    chmod("config.php",0777);
        if(file_exists("config.php")){
            mkdir('../webcamImage/',0777,true);
            chmod('../webcamImage/',0777);
            header('Location: ../index.php');
        }
}
//função não funciona para alterar permissionamento em diretorios, avaliar
function chmod_R($path, $filemode, $dirmode) { 
    if (is_dir($path) ) { 
        if (!chmod($path, $dirmode)) { 
            $dirmode_str=decoct($dirmode); 
            print "Failed applying filemode '$dirmode_str' on directory '$path'\n"; 
            print "  `-> the directory '$path' will be skipped from recursive chmod\n"; 
            return; 
        } 
        $dh = opendir($path); 
        while (($file = readdir($dh)) !== false) { 
            if($file != '.' && $file != '..') {  // skip self and parent pointing directories 
                $fullpath = $path.'/'.$file; 
                chmod_R($fullpath, $filemode,$dirmode); 
            } 
        } 
        closedir($dh); 
    } else { 
        if (is_link($path)) { 
            print "link '$path' is skipped\n"; 
            return; 
        } 
        if (!chmod($path, $filemode)) { 
            $filemode_str=decoct($filemode); 
            print "Failed applying filemode '$filemode_str' on file '$path'\n"; 
            return; 
        } 
    } 
}
?>
<html>
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

<title> Formulário de Configuração Servidor Banco de Dados </title>
</head>
    <body>
<form action="" method="POST">
    <p>Digite o endereço do servidor: <input type="text" name="servidor" autofocus></p>
    <p>Usuário: <input type="text" name="user"></p>
    <p>Senha: <input type="password" name="pass"></p>
    <p>DB (nome): <input type="text" name="db"></p>
    <p><input type="submit" name="submit" value="Cadastrar"></p>
</form>
    </body>
</html>
