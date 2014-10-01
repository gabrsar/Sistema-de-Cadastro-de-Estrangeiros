<?php

	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Página de listagem e acesso ao módulo de Departamentos
 	 */
?>

<div id="titulo">
	<a href="index.php?page=configuracoes" class="voltar">&lt&lt</a>
	<p class="titulo">Departamentos</p>
</div>

<?php

require("permissao.php");

$usuario = getUsuarioLogado();

if($usuario->permissao == $PERMISSOES["ADMINISTRADOR"])
{
	echo ('<div class="painel">');
	echo ('<p> Opções: </p>');
	echo ('<a href="index.php?page=manipularDepartamento">');
	echo ('Cadastrar novo departamento</a>');
	echo ('</div>');
}
?>


<div class="listagem">
	<p class="titulo"> Lista dos departamentos cadastrados </p>
	<table>
		<thead>
			<tr><td>Nome</td></tr>
		</thead>
		<tbody>
			<?php

			$departamentos = R::find('departamento','excluido=0');
			foreach ($departamentos as $dep) {

				$id=$dep->id;
				$nome=$dep->nome;

				echo ("<tr><td><a href='index.php?page=manipularDepartamento&id=$id'>$nome</a></td></tr>\n");
			}
			?>
		</tbody>
		<tfoot>
			<tr><td>Foram encontrados 
				<?php echo (R::count('departamento','excluido=0')); ?>
			registros</td></tr>
		</tfoot>
	</table>
</div>


