<?php
	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Página inicial que é exibida ao usuário após o login.
 	 * Fornece acesso a todo o sistema.
 	 */

?>
<div id="menu_principal" class="painelHorizontal">
	<ul>
		<li> <a href="index.php?page=novoCadastro">Estrangeiros</a></li>
		<li> <a href="index.php?page=relatorios">Relatórios</a></li>
		<li> <a href="index.php?page=configuracoes">Configurações</a></li>
		<li> <a href="index.php?page=scriptSair">Sair</a></li>
	</ul>
</div>
<div class="listagem">
	<p class="titulo"> Lista de cadastros pendentes </p>
	<table>
		<thead>
			<tr><td>Data</td><td>Nome</td><td>Curso</td><td>Professor</td><td>Pais</td></tr>
		</thead>
		<tbody>
			<?php

			$departamentos = R::find('departamento','excluido=0');
			foreach ($departamentos as $dep) {

				$id=$dep->id;
				$nome=$dep->nome;
				$link="confirmarRemoverDepartamento(\"$nome\",$id)";

				echo ("<tr>");
				echo("<td>");
				echo("<p>...</p>");
				echo("</td>");
				echo("<td>");
				echo("<p>...</p>");
				echo("</td>");
				echo("<td>");
				echo("<p>...</p>");
				echo("</td>");
				echo("<td>");
				echo("<p>...</p>");
				echo("</td>");
				echo("<td>");
				echo("<p>...</p>");
				echo("</td>");
			}
			?>
		</tbody>
		<tfoot>
			<tr><td colspan="5">Foram encontrados 
				<?php echo (R::count('departamento','excluido=0')); ?>
			registros</td></tr>
		</tfoot>
	</table>
</div>

<div class="listagem">
	<p class="titulo"> Lista dos últimos cadastros confirmados </p>
	<table>
		<thead>
			<tr><td>Data</td><td>Nome</td><td>Curso</td><td>Professor</td><td>Pais</td></tr>
		</thead>
		<tbody>
			<?php

			$departamentos = R::find('departamento','excluido=0');
			foreach ($departamentos as $dep) {

				$id=$dep->id;
				$nome=$dep->nome;
				$link="confirmarRemoverDepartamento(\"$nome\",$id)";

				echo ("<tr>");
				echo("<td>");
				echo("<p>...</p>");
				echo("</td>");
				echo("<td>");
				echo("<p>...</p>");
				echo("</td>");
				echo("<td>");
				echo("<p>...</p>");
				echo("</td>");
				echo("<td>");
				echo("<p>...</p>");
				echo("</td>");
				echo("<td>");
				echo("<p>...</p>");
				echo("</td>");
			}
			?>
		</tbody>
		<tfoot>
			<tr><td colspan="5">Foram encontrados 
				<?php echo (R::count('departamento','excluido=0')); ?>
			registros</td></tr>
		</tfoot>
	</table>
</div>