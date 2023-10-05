$(function(){
    $("#busca").keyup(function(){
        var busca = $(this).val();
        if(busca != ''){
            var dados = {
                palavra : busca
            }
            // Retorna para a chamada
            $.post('ajax_buscaEntrada-nome.php', dados, function(retorna){
                // chama o item pela classe
                $(".resultado").html(retorna);
            });
        }
    });
});