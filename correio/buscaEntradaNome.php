<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="../css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container">
        <h2 style="text-align:center;">Busca por Nome - Entrada</h2>
        <br>
        <div class="row align-items-center">
            <div class="col-8">
                <form method="post" id="form-busca-ar" action="">
                    <label for="busca" class="col-sm-3 col-form-label col-form-label-sm">Pesquisar Nome: </label>
                    <input type="text" name="busca" id="busca" class="input-sm" placeholder="Digite para pesquisar" size="30" autofocus>
                </form>
            </div>
            <div class="col-4">
                <a href="buscaEntrada.php" class="btn btn-warning btn-sm"> Voltar </a>
            </div>
        </div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr><th>Nome</th><th>AR/Identificador</th><th>Data</th><th>Conjunto</th><th>Observação</th><th>Discriminação</th><th>Imagem</th></tr>
            </thead>
            <tbody class="resultado">

            </tbody>
        </table>
        
        <script src="../js/jquery-3.6.4.min.js"></script>
        <script src="./buscaEntradaNome.js"></script>
    </div>
    </body>
</html>
