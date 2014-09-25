<?php

	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Página de listagem e acesso ao módulo de cursos
 	 */
?>
<div id="titulo">
	<a href="index.php?page=configuracoes" class="voltar">&lt&lt</a>
	<p class="titulo">Cursos</p>
</div>

<div class="painel">
	<p> Opções: </p>
	<a href="index.php?page=manipularCurso">Cadastrar novo curso</a>
</div>

<div class="listagem">
	<p class="titulo"> Lista dos cusrsos cadastrados </p>
	<table>
		<thead>
			<tr><td>Nome</td><td>Nível</td></tr>
		</thead>
		<tbody>           
			<?php

			require("curso.php");

			$cursos = R::find('curso','excluido=0');
			foreach ($cursos as $curso) {

				$id=$curso->id;
				$nome=$curso->nome;
				$tipo=TipoDeCurso::getNomeTipoCurso($curso->tipo);

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

