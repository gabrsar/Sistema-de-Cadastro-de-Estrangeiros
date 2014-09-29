
	/* Autor: Carlos Henrique Severino (Caik)
 	 * Script para rotinas da página de relatorios:
 	 * Ocultar e desocultar campo "outros", requisição AJAX
 	 * 
 	 */


$(document).ready(function() {
	$('input#modalidade0').click(function() {
		$('input#modalidade7').fadeToggle( "swing", "linear" );
	});
	$('input[type=reset]').click(function() {
		if ($('input#modalidade0').is( ":checked" ))
		{
			$('input#modalidade7').fadeToggle( "swing", "linear" );
		}
	});
	$('input[type=submit]').click(function(event) {
		event.preventDefault();
		var mod1 = $('#modalidade1').prop("checked");
		var mod2 = $('#modalidade2').prop("checked");
		var mod3 = $('#modalidade3').prop("checked");
		var mod4 = $('#modalidade4').prop("checked");
		var mod5 = $('#modalidade5').prop("checked");
		var mod0 = $('#modalidade0').prop("checked");
		var outro = $('#modalidade7').prop("value");
		var curso = $('#curso').prop("value");
		var dep = $('#departamento').prop("value");
		var ano = $('#ano').prop("value");
		//alert("Curso: " + curso + "\nDepartamento: " + departamento + "\nAno: " + ano + "\nPós-Doutorado: " + mod4 + "\nPalestrante: " + mod5 + "\nOutro: " + mod0 + "\nTexto: " + outro);
		$.post('relatoriosEnvio.php', {mod1:mod1, mod2:mod2, mod3:mod3, mod4:mod4, mod5:mod5, mod0:mod0, outro:outro, curso:curso, dep:dep, ano:ano}, function callback(data){
			$("#container_relatorios").html(data);
		});
	});
	$("#back_button").click(function() {
		$('#container_formulario_relatorios').load(function(){
			//event.preventDefault();
			alert("Pagina carregada");
		});
	});
});
