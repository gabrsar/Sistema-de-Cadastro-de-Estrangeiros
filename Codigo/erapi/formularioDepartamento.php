<div class="painel">
	<a href="index.php?page=manipularDepartamento">Cadastrar novo departamento</a>
</div>

<div class="listagem">
	<p class="titulo">Departamentos cadastrados</p>
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
				$link="confirmarRemoverDepartamento(\"$nome\",$id)";

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


