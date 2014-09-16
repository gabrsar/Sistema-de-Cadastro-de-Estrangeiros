<div class="painel">
	<a href="index.php?page=manipularCurso">Cadastrar novo curso</a>
</div>

<div class="listagem">
	<p class="titulo">Cursos cadastrados</p>
	<table>
		<thead>
			<tr><td>Curso</td><td>Tipo</td></tr>
		</thead>
		<tbody>
			<?php

			require("curso.php");

			$cursos = R::find('curso','excluido=0');
			foreach ($cursos as $curso) {

				$id=$curso->id;
				$nome=$curso->nome;
				$tipo=obterTipoDoCursoPeloCodigo($curso->tipo);

				$link="confirmarRemoverCurso(\"$nome\",$id)";

				echo ("<tr><td><a href='index.php?page=manipularCurso&id=$id'>$nome</a></td><td>$tipo</td></tr>\n");
			}
			?>
		</tbody>
		<tfoot>
			<tr><td colspan="2">Foram encontrados 
				<?php echo (R::count('curso','excluido=0')); ?>
			registros</td></tr>
		</tfoot>
	</table>
</div>


