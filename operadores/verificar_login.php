<?php
// Incluir o arquivo de conexão com o banco de dados
include_once '../include/connect.php';

// Verificar se o login já existe no banco de dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];

    // Consulta para verificar se o login já existe
    $sql = "SELECT * FROM operadores WHERE nome = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // O login já está em uso
        echo 'existe';
    } else {
        // O login está disponível
        echo 'disponivel';
    }
} else {
    // Método de requisição inválido
    echo 'erro';
}
?>