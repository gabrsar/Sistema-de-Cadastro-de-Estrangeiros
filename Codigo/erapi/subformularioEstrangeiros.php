<?php

	/* Autor: Victor Hugo Cândido de Oliveira
 	 * Módulo para exibição da tabela de estrangeiros cadastrados.
 	 * Permite listar:
 	 *	-Todos os estrangeiros
 	 *	-Estrangeiros validados
 	 *	-Estrangeiros não validados
 	 */

	/* Parâmetro é opcional.
	 * Se for passado, lista todos os estrangeiros
	 * Se não for, adiciona restrições necessárias relacionadas à validação do cadastro
	 */
	function mostrarTabelaEstrangeiros($validado){
				echo("
				<table>
					<thead>
						<tr><td>Data</td><td>Nome</td><td>Curso</td><td>Docente</td><td>País</td></tr>
					</thead>
					<tbody>");

				if(!isset($validado)){
					$validadoSQL = "";
					$validadoCont = R::count('estrangeiro');
				}
				else if($validado){
					$validadoSQL = " AND validado=1";
					$validadoCont = R::count('estrangeiro','validado=1');
				}
				else{
					$validadoSQL = " AND validado=0";
					$validadoCont = R::count('estrangeiro','validado=0');
				}

				$sql="
					SELECT e.*, c.nome as nome_curso FROM estrangeiro e
			        INNER JOIN curso c
			        ON e.curso=c.id AND c.excluido=0".$validadoSQL."
			        ORDER BY e.id"; // FIXME Ordenar por data de cadastro
			    $rows = R::getAll( $sql );
			    $estrangeiros = R::convertToBeans( 'estrangeiro', $rows );
				
				foreach($estrangeiros as $e) {
					$link="index.php?page=manipularEstrangeiro&id=->id";
					$a=<<<EOT
					<a href="$link">$e->nome</a>
EOT;
					echo("<tr>");
					echo("<td>");
					echo("<p>...</p>");
					echo("</td>");
					echo("<td>");
					echo("<p>$a</p>");
					echo("</td>");
					echo("<td>");
					echo("<p>$e->nome_curso</p>");
					echo("</td>");
					echo("<td>");
					echo("<p>$e->docente</p>");
					echo("</td>");
					echo("<td>");
					echo("<p>$e->pais</p>");
					echo("</td>");
				}
				echo("</tbody>
						<tfoot>
							<tr><td colspan='5'>Foram encontrados 
								echo ".$validadoCont."
							registros</td></tr>
						</tfoot>
					</table>");
	}
?>