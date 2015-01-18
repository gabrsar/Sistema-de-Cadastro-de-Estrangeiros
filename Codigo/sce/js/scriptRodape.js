
	/* Autor: Carlos Henrique Severino (Caik)
 	 * Script para ajustar o tamanho do rodapé corretamente
 	 * em todas as páginas
 	 * 
 	 */

$(window).resize(function(){
	if(!($("#container_relatorios").length))
	{
		var altura = $('html').height();
		var corpo = parseInt($("#corpo").css("height"));
		if(((altura - corpo) > 130) && (!($("#login").length)))
		{
			altura -= 173;
			$('#corpo').css({"height" : altura + "px"});
		}
		if($("#login").length)
		{
			altura -= 131;
			$('#corpo').css({"height" : altura + "px"});
		}
	}
	else
	{
		var altura = $('html').height();
		var corpo = parseInt($("#corpo").css("height"));
		if((corpo +98) < altura)
		{
			altura -= 143;
			$('#corpo').css({"height" : altura + "px"});
		}
	}
});

$(window).ready(function(){
	if(!($("#container_relatorios").length))
	{
		var altura = $('html').height();
		var corpo = parseInt($("#corpo").css("height"));
		if(((altura - corpo) > 130) && (!($("#login").length)))
		{
			altura -= 173;
			$('#corpo').css({"height" : altura + "px"});
		}
		if($("#login").length)
		{
			altura -= 131;
			$('#corpo').css({"height" : altura + "px"});
		}
	}
	else
	{
		var altura = $('html').height();
		var corpo = parseInt($("#corpo").css("height"));
		if((corpo + 98) < altura)
		{
			altura -= 143;
			$('#corpo').css({"height" : altura + "px"});
		}
	}
});
