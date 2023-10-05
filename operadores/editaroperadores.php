<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.css" rel="stylesheet">
</head>
<body>
<?php

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$formdirect = $_POST["formdirect"];
    echo "<h2><strong>Tem alguma coisa errada... não faça mais isso!</strong></h2>";
} else {
	$formdirect = $_GET["formdirect"];
    // echo $formdirect;
    
    switch($formdirect){
        /*
            Edição de operador
        */
        case 'edit':
            $sql = "select nome,login,senhaBloq,data,tipo from operadores where nome = '".$_GET['login']."' limit 1;";
            $exec = $conn->query($sql);
            if($exec->num_rows > 0){
                $row = $exec->fetch_assoc();
                $login = $row['login'];
                $nome = $row['nome'];
                $senhaBloq = $row['senhaBloq'];
                $cadastro = $row['data'];
                $tipo = $row['tipo'];

            ?>
            <div class="container">
                <h1 class="text-center">Atualização de operador</h1>
                <form action="salvaroperadores.php" method="post" name="atualizaOperador" class="row g-3">
                <input type="hidden" name="formdirect" id="formdirect" value="<?php echo $formdirect; ?>">
                <div class="col-md-6">
                <label for="nome" class="form-label">Nome: </label>
                    <div class="col-sm-5">
                        <input class="form-control" name="nome" id="nome" type="text" value="<?php echo $login; ?>" size="50" required>
                    </div>
                </div>
                <div class="col-md-6">
                <label for="login" class="form-label">Login: </label>
                    <div class="col-sm-5">
                        <input name="login" id="login" type="text" class="form-control" value="<?php echo $nome; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                <label for="bloq" class="form-label">Bloqueio: </label>
                    
                    <select name="bloq" id="bloq" class="form-select" required>
                        <option value="0" <?php if ($senhaBloq === '0') echo 'selected'; ?>>Normal</option>
                        <option value="1" <?php if ($senhaBloq === '1') echo 'selected'; ?>>Bloqueado</option>
                    </select>
                    
                </div>
                <div class="col-md-4">
                <label for="cadastro" class="form-label">Cadastro: </label>
                    
                        <input name="cadastro" id="cadastro" type="text"  class="form-control" value="<?php 
                        $date = date_create($cadastro);
                        echo date_format($date,"d/m/Y");
                        ?>" disabled>
                    
                </div>
                <div class="col-md-4">
                <label for="tipo" class="form-label">Tipo: </label>
                    
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="0" <?php if ($tipo === '0') echo 'selected'; ?>>Administrador</option>
                    <option value="1" <?php if ($tipo === '1') echo 'selected'; ?>>Geral</option>
                    <option value="1" <?php if ($tipo === '2') echo 'selected'; ?>>Portaria</option>
                </select>
                    
                </div>
                <div class="col-md-6">
                    Marque aqui se precisa trocar a senha: <input type="checkbox" name="trocasenha" id="trocasenha" onchange="habilitarCamposSenha()" value="1">
                </div>
            
                <div class="col-md-12">
                    <label for="senha" class="form-label">Digite a senha nova:</label> 
                    <input type="password" name="senha" id="senha" class="form-control" disabled>
                </div>
                <div class="col-md-12">
                    <label for="confirma" class="form-label">Repita a senha:</label>
                    <input type="password" name="confirma" id="confirma" class="form-control" disabled>
                </div>
            
                <!-- Espaçador -->
                <div class="col-md-2">&nbsp;</div>
                <!-- Espaçador -->
                <div class="col-12 row">
                    <div class="col-5 align-items">
                        <button type="submit" class="btn btn-success" name="save">Salvar</button>
                    </div>
                    <div class="col-2">&nbsp;</div>
                    <div class="col-5">
                        <a href="index.php" class="btn btn-warning" name="cancel">Cancelar</a>
                    </div>
                </div>
            </div>

            <?php
                
            } else {
                
            }
        break;
        /* 
            Inserção de operador
        */
        case 'insert':
            ?>
            <div class="container">
                <h1>Inserção de operador</h1>
                <form onsubmit="return validarFormulario()" action="salvaroperadores.php" method="post" name="insereOperador">
                    <input type="hidden" name="formdirect" id="formdirect" value="<?php echo $formdirect; ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="login" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="login" name="login" required>
                        </div>
                            <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label">Login</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                         <span id="login-error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="confirma" class="form-label">Confirmação de Senha</label>
                            <input type="password" class="form-control" id="confirma" name="confirma" required>
                            <span id="senha-error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Usuário</label>
                        <select class="form-select" id="tipo" name="tipo" required>
                            <option value="0">Administrador</option>
                            <option value="1">Geral</option>
                            <option value="2">Portaria</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="save">Salvar</button>
                    <button type="button" class="btn btn-secondary" onclick="limparFormulario()" name="cancel">Cancelar</button>
                </form>
            </div>
    <?php
        break;
        
    } // end switch
    ?>
    <script src="../js/bootstrap523.min.js"></script>
    <script src="../js/jquery-3.6.4.min.js"></script>
    <script>
        function habilitarCamposSenha() {
          var checkbox = document.getElementById("trocasenha");
          var senha1 = document.getElementById("senha");
          var senha2 = document.getElementById("confirma");

          if (checkbox.checked) {
            senha1.disabled = false;
            senha2.disabled = false;
          } else {
            senha1.disabled = true;
            senha2.disabled = true;
          }
        }
        function validarFormulario() {
            // Validar campos obrigatórios
            var nome = document.getElementById("nome").value;
            var login = document.getElementById("login").value;
            var senha = document.getElementById("senha").value;
            var confirmaSenha = document.getElementById("confirma").value;

            if (nome === "" || login === "" || senha === "" || confirma === "") {
                alert("Todos os campos são obrigatórios");
                return false;
            }

            // Validar se as senhas são iguais
            if (senha !== confirmaSenha) {
                document.getElementById("senha-error").textContent = "As senhas não correspondem";
                return false;
            }

            // Verificar se o login já existe no banco de dados
            $.ajax({
                url: "verificar_login.php",
                type: "POST",
                data: { login: nome },
                success: function(response) {
                    if (response === "existe") {
                        document.getElementById("login-error").textContent = "O login já está em uso";
                        return false;
                    } else {
                        // Submeter o formulário se tudo estiver válido
                        document.querySelector("form").submit();
                    }
                }
            });

            return false; // Impedir o envio do formulário antes da resposta assíncrona
        }

        function limparFormulario() {
            document.getElementById("nome").value = "";
            document.getElementById("login").value = "";
            document.getElementById("senha").value = "";
            document.getElementById("confirma").value = "";
            document.getElementById("tipo").selectedIndex = 0;
        }
    </script>
            </body>
            </html>
<?php
}