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
	function mostrarTabelaEstrangeiros($validado = NULL){
				$colunaValidado=false;
				if(!isset($validado)){
					$validadoSQL = "";
					$validadoCont = R::count('estrangeiro');
					$colunaValidado = true;
				}
				else if($validado){
					$validadoSQL = " AND validado=1";
					$validadoCont = R::count('estrangeiro','validado=1');
				}
				else{
					$validadoSQL = " AND validado=0";
					$validadoCont = R::count('estrangeiro','validado=0');
				}

				if($colunaValidado) {
					echo("
						<table>
							<thead>
								<tr>
									<td>Validado</td>
									<td>Data</td>
									<td>Nome</td>
									<td>Curso</td>
									<td>Docente</td>
									<td>País</td>
								</tr>
							</thead>
							<tbody>");
				}
				else {
					echo("
						<table>
							<thead>
								<tr>
									<td>Data</td>
									<td>Nome</td>
									<td>Curso</td>
									<td>Docente</td>
									<td>País</td>
								</tr>
							</thead>
							<tbody>");
				}

				$sql="
					SELECT e.*, c.nome as nome_curso FROM estrangeiro e
			        INNER JOIN curso c
			        ON e.curso=c.id AND c.excluido=0".$validadoSQL."
			        ORDER BY e.id"; // FIXME Ordenar por data de cadastro
			    $rows = R::getAll( $sql );
			    $estrangeiros = R::convertToBeans( 'estrangeiro', $rows );
				
				foreach($estrangeiros as $e) {
					$link="index.php?page=manipularEstrangeiro&id=$e->id";
					$a=<<<EOT
					<a href="$link">$e->nome</a>
EOT;
					echo("<tr>");
					if($colunaValidado) {
						$textoValidado = ($e->validado==1 ? "Validado" : "Não validado");
						echo("<td><p>$textoValidado</p></td>");
					}
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
					echo("</tr>");
				}
				echo("
					</tbody>
					<tfoot>
						<tr><td colspan='6'>Foram encontrados 
							$validadoCont
						registros</td></tr>
					</tfoot>
				</table>");
	}
?>