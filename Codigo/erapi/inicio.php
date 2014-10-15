<?php
	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Página inicial que é exibida ao usuário após o login.
 	 * Fornece acesso a todo o sistema.
 	 */

	require("subformularioTabela.php");
?>
<div id="menu_principal" class="painelHorizontal">
	<ul>
		<li> <a href="index.php?page=estrangeiros">Estrangeiros</a></li>
		<li> <a href="index.php?page=relatorios">Relatórios</a></li>
		<li> <a href="index.php?page=configuracoes">Configurações</a></li>
		<li> <a href="index.php?page=scriptSair">Sair</a></li>
	</ul>
</div>
<div class="listagem">
	<p class="titulo"> Lista de cadastros pendentes </p>
	<?php
		mostrarTabelaEstrangeiros(false);	
	?>
</div>

<div class="listagem">
	<p class="titulo"> Lista dos últimos cadastros confirmados </p>
	<?php
		mostrarTabelaEstrangeiros(true);	
	?>
</div>