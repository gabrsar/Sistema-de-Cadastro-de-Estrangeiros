
	/* Autor: Carlos Henrique Severino (Caik)
 	 * Script para rotinas da página de relatorios
 	 */

$(document).ready(function() {
		$('input#modalidade6').click(function() {
			$('input#modalidade7').fadeToggle( "swing", "linear" );
		});
		$('input[type=reset]').click(function() {
			if ($('input#modalidade6').is( ":checked" ))
			{
				$('input#modalidade7').fadeToggle( "swing", "linear" );
			}
		});
});

