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
        <h2 style="text-align:center;">Busca por Data (Entradas)</h2>
        <br>
        <div class="row align-items-center">
            <div class="col-8">
                <form method="post" id="form-busca-ar" action="ajax_buscaEntrada-data.php" target="resultado">
                    <label for="buscaData" class="col-sm-3 col-form-label col-form-label-sm">Pesquisar Data: </label>
                    <input type="date" name="buscaData" id="buscaData" class="input-sm" size="30" autofocus required>
                    <button type="submit" class="btn btn-outline-info">Buscar</button>
                </form>
            </div>
            <div class="col-4">
                <a href="buscaEntrada.php" class="btn btn-warning btn-sm"> Voltar </a>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-10">
                <iframe name="resultado" width="800" height="600"></iframe>
            </div>
        </div>
        <script src="../js/jquery-3.6.4.min.js"></script>
        <!-- <script src="./buscaDevolucaoAR.js"></script> -->
    </div>
    </body>
</html>