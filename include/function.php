<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<?php
//header('Content-Type: text/html; charset=iso-8859-1');
/*
 *  Arquivo de funções diversas (PHP e Javascript)
 * ===============================================
 * 
 * FUNÇÕES PHP
 * 
 */
function sessao(){
	if(!isset($_SESSION)) session_start();
	if(!isset($_SESSION["senhabloq"]) OR ($_SESSION["senhabloq"] == '1')) {
		session_destroy();
		header('Location: index.php');
		exit;
	}
} //fim sessao

//function para mudar a imagem para base64 (blob)
function changeImagetoBase64($image){
	$path = $image;
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	$base64 = 'data:image/'.$type.';base64,' . base64_encode($data);
	return $base64;
}

//function para esvaziar diretorio de fotos
//fonte:https://paulund.co.uk/php-delete-directory-and-files-in-directory
function delete_directory($dirname) {
	if (is_dir($dirname))
		$dir_handle = opendir($dirname);
		if (!$dir_handle)
			return false;
			while($file = readdir($dir_handle)) {
				if ($file != "." && $file != "..") {
					if (!is_dir($dirname."/".$file))
						unlink($dirname."/".$file);
						else
							delete_directory($dirname.'/'.$file);
				}
			}
			closedir($dir_handle);
			rmdir($dirname);
			return true;
}
//Somente numeros na string
function limpaLetras($str) {
	$strlimpa = explode(" - ", $str);
	$strlimpa = $strlimpa[0];
	return $strlimpa;
}
?>
<script type="text/javascript">
/*
 * FUNÇÕES JavaScript
 */
 
//funcao envia com enter
function envio() {
    var txt = "";
    if (document.getElementById("nome").validity.valueMissing) {
    	txt = "<p class='bg-warning' align='center'>É necessário preencher o nome!</p>";
    } else if (document.getElementById("empresa").validity.valueMissing) {
    	txt = "<p class='bg-warning' align='center'>Selecione a empresa!</p>";
    } else {
        document.getElementById("cadastro").submit();
    }
    document.getElementById("msgerr").innerHTML = txt;
}

</script>
<?php

?>