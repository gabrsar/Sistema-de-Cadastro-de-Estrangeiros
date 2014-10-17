
	/* Autor: Carlos Henrique Severino (Caik)
 	 * Script para rotinas da página de relatorios:
 	 * Ocultar e desocultar campo "outros", requisição AJAX
 	 * 
 	 */


$(document).ready(function() {
	$('input#atuacao0').click(function() {
		$('input#atuacao7').fadeToggle( "swing", "linear" );
		var largura = parseInt($('#form_modalidade').css("height"));
		if((largura > 120) && ($('input#atuacao0').is( ":checked" )))
		{
			$('#form_curso').css({"height" : largura + "px"});
			if($.browser.mozilla)
			{
				$('#fieldset_modalidade').css({"min-width" : "243px"});
			}
		}
		else
		{
			$('#form_curso').css({"height": "116px"});
			if($.browser.mozilla)
			{
				$('#fieldset_modalidade').css({"min-width" : "132px"});
			}
		}
	});
	$('input[type=reset]').click(function() {
		if ($('input#atuacao0').is( ":checked" ))
		{
			$('input#atuacao7').fadeToggle( "swing", "linear" );
			$('#form_curso').css({"height": "116px"});
			if($.browser.mozilla)
			{
				$('#fieldset_modalidade').css({"min-width" : "132px"});
			}
		}
	});
	$('input[type=submit]').click(function(event) {
		event.preventDefault();
		$('#corpo').css({"height" : "auto"});
		var atuacao = $('#formulario_relatorios input[name=atuacao]').serialize();
		var atuacao_alone = $('#atuacao0').prop("checked");
		var atuacao_outros = $('#atuacao7').prop("value");
		var curso = $('#formulario_relatorios input[name=curso]').serialize();
		var dep = $('#formulario_relatorios input[name=departamento]').serialize();
		var inicio = $('#inicio').prop("value");
		var fim = $('#fim').prop("value");
		$.post('relatoriosEnvio.php', {atuacao:atuacao, atuacao_alone:atuacao_alone, atuacao_outros:atuacao_outros, curso:curso, dep:dep, inicio:inicio, fim:fim}, function callback(data){
			$("#container_relatorios").html(data);
		});
		$('html, body').animate({scrollTop: $("#container_relatorios").offset().top}, 1500);
	});
});
