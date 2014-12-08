/* Autor: Victor Hugo Cândido de Oliveira
 * Script que mostra/esconde campo de atuações nos formulários de estrangeiros
 *
 *
 * Atualiza quando há mudança no valor do select #atuacao
 * 	Se "Outro" estiver selecionado -> mostra div #atuacao_outros
 * 	Senão -> esconde div #atuacao_outros
 */


$( window ).load( function() {
	$("#atuacao")
	.change( function() {
		// Ambas as soluções são válidas
		// Usar .val() pode gerar problemas se o array em atuacao.php for modificado
		$("#atuacao option:selected").text() != "Outro" ? $("#atuacao_outro").hide() : $("#atuacao_outro").show();
		//$("#atuacao option:selected").val() != "7" ? $("#atuacao_outro").hide() : $("#atuacao_outro").show();
	})
	.change(); // Ativa o evento em caso de reload
});