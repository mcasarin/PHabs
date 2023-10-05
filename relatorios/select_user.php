<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

//declarar variaveis
$formdirect = "";
$usuarios = "";
$matricula = "";
$nome = "";
$rg = "";
$empresa = "";
$dataincl = "";
$bloq = "";
$obs = "";
$ID = "";
if(isset($_GET["formdirect"])){
	$formdirect = $_GET["formdirect"];
} else {
	$formdirect = $_POST["formdirect"];
}
	if(isset($_GET["matricula"])){
		$matricula = $_GET["matricula"];
	} else {
		$matricula = $_POST["matricula"];
	}
	if(isset($_POST["usuarios"])){
		$usuarios = $_POST["usuarios"];
	}
	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../js/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker3.css">
<script src="../js/jquery-3.6.4.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<title>Relatório de Usuários</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="table-responsive">
                
<form action="rel_user.php" method="post">
        <?php
            // Limpando tabela relatório
            $sqllimparel = "truncate table relusuario;";
            $sqllimparelexe = $conn->query($sqllimparel);
		if($formdirect == "reluserunit"){
            // Seleciona usuário
            $sqlusuarioselecionado = "SELECT Nome,RG,Matricula,Empresa,DataIncl,Bloq,OBS,ID from usuarios where matricula='$matricula';";
            $sqlusuarioselecionadoexe = $conn->query($sqlusuarioselecionado);
            if($sqlusuarioselecionadoexe){
                while($row = $sqlusuarioselecionadoexe->fetch_array(MYSQLI_ASSOC)){
                    $matricula = $row["Matricula"];
                    $nome = $row["Nome"];
                    $rg = $row["RG"];
                    $empresa = $row["Empresa"];
                    $dataincl = $row["DataIncl"];
                    $bloq = $row["Bloq"];
                    $obs = $row["OBS"];
                    $ID = $row["ID"];
				}
			}
		} elseif ($formdirect == "reluserempresa") {
			// Seleciona usuários
			$usuariosfim = count($usuarios);
			for($x = 0;$x <= $usuariosfim;$x++){
				$sqlusuarioselecionado = "SELECT Nome,RG,Matricula,Empresa,DataIncl,Bloq,OBS,ID from usuarios where matricula='$usuarios[$x]';";
				echo $sqlusuarioselecionado."<br />";
				$sqlusuarioselecionadoexe = $conn->query($sqlusuarioselecionado);
				if($sqlusuarioselecionadoexe){
					while($row = $sqlusuarioselecionadoexe->fetch_array(MYSQLI_ASSOC)){
						$matricula = $row["Matricula"];
						$nome = $row["Nome"];
						$rg = $row["RG"];
						$empresa = $row["Empresa"];
						$dataincl = $row["DataIncl"];
						$bloq = $row["Bloq"];
						$obs = $row["OBS"];
						$ID = $row["ID"];
							echo $matricula;
							echo $nome;
							echo $rg;
							echo $empresa;
							echo $dataincl;
							echo $bloq;
							echo $obs;
							echo $ID;
					}		
				}
			}
		}
        ?>
            <table class="table table-hover table-md">
                <thead>
                    <tr>
                        <td colspan="2"><b>Usuário selecionado:</b></td>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">Nome: <?php echo $nome;?></td>
                        </tr>
                        <tr>
                            <td>Matrícula: <?php echo $matricula;?></td><td>RG: <?php echo $rg;?></td>
                            <input type="hidden" value="<?php echo $matricula;?>" name="matricula" id="matricula">
                        </tr>
                        <tr>
                            <td colspan="2">Empresa: <?php echo $empresa;?></td>
                        </tr>
                        <tr>
                            <td>Cadastro: <?php echo $dataincl;?></td><td>Bloqueado: 
                                <?php
                                if($bloq == '1'){
                                    echo "SIM";
                                } else {
                                    echo "NÃO"; 
                                }
                                ?></td>
                        </tr>
        <thead><tr><td colspan="2">
                <b>Selecione a data e hora de início e final</b>
                <!-- Fonte do calendário e Demo
                    https://www.jqueryscript.net/time-clock/Configurable-Date-Picker-Plugin-For-Bootstrap.html
                    https://www.jqueryscript.net/demo/Configurable-Date-Picker-Plugin-For-Bootstrap/
                -->
            </tr></td></thead>
            <tr>
                <td>
                <div class="input-group input-daterange" id="datepicker">
                    <input type="text" class="form-control datepicker" name="datainicio" id="datainicio" autocomplete="off" />
                    <div class="input-group-addon">&nbsp;até&nbsp;</div>
                    <input type="text" class="form-control datepicker" name="datafim" id="datafim" autocomplete="off" />
                </div>
                <!-- jQuery Script -->
                <script type="text/javascript">
                    // Calendário
                    $('.input-daterange').datepicker({
                        format: "dd/mm/yyyy",
                        endDate: "today",
                        clearBtn: true,
                        language: "pt-BR"
                    });
                
                </script><!-- end calendario -->
            </td></tr>
            <tr>
                <td>
                <div class="input-group">
                    <select name="horainicio" id="horainicio">
                        <option value="00:00">00:00</option>
                        <option value="01:00">01:00</option>
                        <option value="02:00">02:00</option>
                        <option value="03:00">03:00</option>
                        <option value="04:00">04:00</option>
                        <option value="05:00">05:00</option>
                        <option value="06:00">06:00</option>
                        <option value="07:00">07:00</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                        <option value="23:00">23:00</option>
                    </select>
                    <span>&nbsp;&nbsp;até&nbsp;&nbsp;</span>
                    <select name="horafim" id="horafim">
                        <option value="00:00">00:00</option>
                        <option value="01:00">01:00</option>
                        <option value="02:00">02:00</option>
                        <option value="03:00">03:00</option>
                        <option value="04:00">04:00</option>
                        <option value="05:00">05:00</option>
                        <option value="06:00">06:00</option>
                        <option value="07:00">07:00</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                        <option value="23:00" selected>23:59</option>
                    </select>
                </div> <!-- end hora -->
            </td></tr>
            <tr>
                <td colspan="2">Observações no cadastro do usuário: <?php echo $obs;?></td>
            </tr>
        <tr>
            <td colspan="2">
                <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="load" style="width:0%">0%</div>
                        </div><br>
                <button type="submit" class="btn btn-primary btn-lg" id="loading" autocomplete="off"> Gerar relatório </button>
                <script type="text/javascript">
                    $('#loading').click(function() {

                            var timerId, percent;

                            // reset progress bar
                            percent = 0;
                            $('#pay').attr('disabled', true);
                            $('#load').css('width', '0px');
                            $('#load').addClass('progress-bar-striped active');

                            timerId = setInterval(function() {

                            // increment progress bar
                            percent += 5;
                            $('#load').css('width', percent + '%');
                            $('#load').html(percent + '%');


                            if (percent >= 100) {
                                clearInterval(timerId);
                                $('#pay').attr('disabled', false);
                                $('#load').removeClass('progress-bar-striped active');
                                $('#load').html('Aguarde!');
                            }
                            }, 200);
                            });
                </script>
            </td></tr>
</tbody>
</table>
</form>
        </div> <!-- table-responsive -->
    </div> <!-- row -->
</div> <!-- container -->
</body>
</html>
<?php
//end file
?>