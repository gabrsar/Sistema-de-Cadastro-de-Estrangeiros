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
	require_once("simplex/utils.php");

	function mostrarTabelaEstrangeiros($validado = NULL){
				$colunaValidado=false;
				if(!isset($validado)){
					$validadoSQL = "";
					$colunaValidado = true;
				}
				else if($validado){
					$validadoSQL = " AND validado=1";
				}
				else{
					$validadoSQL = " AND validado=0";
				}

				if($colunaValidado) {
					echo("
						<table class=\"tablesorter tabela\">
							<thead>
								<tr>
									<th>Validado</th>
									<th>Data de cadastro</th>
									<th>Nome</th>
									<th>Curso</th>
									<th>Docente</th>
									<th>País</th>
								</tr>
							</thead>
							<tbody class=\"tbody_alternada\">");
				}
				else {
					echo("
						<table class=\"tablesorter tabela\">
							<thead>
								<tr>
									<th>Data de cadastro</th>
									<th>Nome</th>
									<th>Curso</th>
									<th>Docente</th>
									<th>País</th>
								</tr>
							</thead>
							<tbody class=\"tbody_alternada\">");
				}

				$sql="
					SELECT e.*, c.nome as nome_curso FROM estrangeiro e
					INNER JOIN curso c
					ON e.curso=c.id AND e.excluido=0 AND c.excluido=0".$validadoSQL."
					ORDER BY e.id";
				$rows = R::getAll( $sql );
				$validadoCont = count($rows);
				$estrangeiros = R::convertToBeans( 'estrangeiro', $rows );
				
				foreach($estrangeiros as $e) {
					$link = "index.php?page=manipularEstrangeiro&id=$e->id";
					$a = "<a href=\"$link\">$e->nome</a>";

					echo("<tr>");
					if($colunaValidado) {
						$textoValidado = ($e->validado==1 ? "Validado" : "Não validado");
						echo("<td><p>$textoValidado</p></td>");
					}
					echo("<td>");
					echo("<p>".dtPadrao($e->data_cadastro)."</p>");
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
