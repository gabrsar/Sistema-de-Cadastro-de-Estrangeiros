<?php
	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Página inicial que é exibida ao usuário após o login.
 	 * Fornece acesso a todo o sistema.
 	 */

	require_once("subformularioEstrangeiros.php");
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
		// Estrangeiros não validados
		mostrarTabelaEstrangeiros(false);	
	?>
</div>

<div class="listagem">
	<p class="titulo"> Lista dos últimos cadastros confirmados </p>
	<?php
		// Estrangeiros validados
		mostrarTabelaEstrangeiros(true);	
	?>
</div>