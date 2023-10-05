$(function(){
	//Pesquisar as empresas sem refresh na página
	$("#pesquisaemp").keyup(function(){
		
		var pesquisa = $(this).val();
		
		//Verificar se há algo digitado
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa
			}		
			$.post('buscaemp.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				$(".resultadoemp").html(retorna);
			});
		}else{
			$(".resultadoemp").html('');
		}		
	});
});