<?php

	/* Autor: Victor Hugo Cândido de Oliveira
 	 * Página que exibe todos os estrangeiros cadastrados.
 	 * Permite realização de um novo cadastro de estrangeiro.
 	 */

	require("subformularioEstrangeiros.php");
	require("permissao.php");
?>


<div id="titulo">
	<a href="index.php?page=inicio" class="voltar">&lt&lt</a>
	<p class="titulo">Estrangeiros</p>
</div>

<?php
	$usuario = getUsuarioLogado();
	$admin 	 = $usuario->permissao == Permissao::getIDPermissao("Administrador");
	$usuario = $usuario->permissao == Permissao::getIDPermissao("Usuário");

	if($admin || $usuario)
	{
		$painel = <<<EOT
			<div class="painel">
				<p>Opções:</p>
				<a href="index.php?page=manipularEstrangeiro">Cadastrar novo estrangeiro</a>
			</div>
EOT;

		echo $painel;
	}
?>

<div class="listagem">
	<p class="titulo">Lista de cadastros</p>
		<?php
			mostrarTabelaEstrangeiros();	
		?>
</div>