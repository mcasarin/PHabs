<?php
include 'connect.php';

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

//função de timeout de sessão
function isLoginSessionExpired() {
	$login_session_duration = 10; 
	$current_time = time(); 
	if(isset($_SESSION['loggedin_time']) and isset($_SESSION["nome"])){  
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){
			header('Location: index.php'); // testando redirect em caso de sessão expirada 
		} 
	}
	return false;
}

// function para mudar a imagem para base64 (blob)
function changeImagetoBase64($image){
	$path = $image;
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	$base64 = 'data:image/'.$type.';base64,' . base64_encode($data);
	return $base64;
}

// function para esvaziar diretorio de fotos
// fonte:https://paulund.co.uk/php-delete-directory-and-files-in-directory
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
// Somente numeros na string
function limpaLetras($str) {
	$strlimpa = explode(" - ", $str);
	$strlimpa = $strlimpa[0];
	return $strlimpa;
}
// Ordena data de retorno do BD (Y-m-d) > (d/m/Y) 
function ordenaData($dataold){
	$datanew = explode("-",$dataold);
	$datareturn = $datanew[2]."/".$datanew[1]."/".$datanew[0];
	return $datareturn;
}
?>
<script type="text/javascript">
/*
 * FUNÇÕES JavaScript
 */
 
// funcao envia com enter
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