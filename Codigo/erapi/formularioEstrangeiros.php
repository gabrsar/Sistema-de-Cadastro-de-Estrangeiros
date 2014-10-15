<?php

	/* Autor: Victor Hugo Cândido de Oliveira
 	 * Página que exibe todos os estrangeiros cadastrados.
 	 * Permite realização de um novo cadastro de estrangeiro.
 	 */

	require("subformularioEstrangeiros.php");
?>


<div id="titulo">
	<a href="index.php?page=inicio" class="voltar">&lt&lt</a>
	<p class="titulo">Estrangeiros</p>
</div>
<div class="listagem">
	<p class="titulo">Lista de estrangeiros cadastrados</p>
		<?php
			mostrarTabelaEstrangeiros();	
		?>
</div>