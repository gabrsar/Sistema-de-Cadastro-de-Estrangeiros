<?php
require_once("start.php");
validaSessao();
?>

<!DOCTYPE html>
<html>
<head>

<?php require_once("head.php"); ?>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="js/selecionar_checkbox.js"></script>
<script type="text/javascript" src="js/busca_magica.js"></script>

<script type="text/javascript" id="js">
	$(document).ready(function() {
		// call the tablesorter plugin
		$("table").tablesorter()
	});
</script>


<script type="text/javascript">


	function acaoImprimir()
	{
		acao = document.getElementsByName("acao")[0];

		acao.value = "imprimir";

		document.form2.submit();

	}
                                                                    
	function acaoConcluir()
	{
		acao = document.getElementsByName("acao")[0];

		acao.value = "concluir";

		document.form2.submit();

	}
                                                                    

</script>


</head> 


<body>
	<?php require_once("topo.php"); ?>
	<?php require_once("menu.php"); ?>
	
	<div class="formulario">
		
		<div id="painelDePesquisa" class="painel pesquisa">
			
			<form action="formularioBuscarServico.php" method="post" onsubmit="busca_magica_form_submit();">
					<span>
						<input type="text" name="texto" value="Busca Mágica" size="12" id="busca_magica" onfocus="busca_magica_focus();" onblur="busca_magica_blur();" >
						<img alt="Utilizar busca inteligente" src="imagens/buscaInteligentePequeno.png" >
						<input type="checkbox" name="buscaInteligente" value="1" checked >
					</span>
					
					
					
					<span>
						<img src="imagens/colocacao.png" alt="C" >
						<input type="checkbox" name="colocacao" value="1" >
					</span>

					<span>
						<img src="imagens/retirada.png" alt="R" >
						<input type="checkbox" name="retirada" value="1">
					</span>

					<span>
						<img src="imagens/foto.png" alt="F" >
						<input type="checkbox" name="foto" value="1">
					</span>

					<span>
						<img src="imagens/vistoria.png" alt="F" >
						<input type="checkbox" name="vistoria" value="1" >
					</span>
			         <span>
						<select name="placa">
							<option value="0">Setor</option>
							<option value="1">Aluga</option>
							<option value="2">Venda</option>
						</select>
					</span> 
					<span>
						<select name="status">
							<option value="-1">Estado</option>
							<option value="0">Pendente</option>
							<option value="1">Agendado</option>
							<option value="2">Em execução</option>
							<option value="3">Concluido</option>
							<option value="4">Problema</option>
							<option value="5">Outros</option>
						</select>
					</span>
					
					
					
					<span>
						<select name="limite">
							<option value="50">Resultados</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="1000">1000</option>
							<option value="99999">Todos</option>
						</select>
					</span>
			    <input type="submit" class="botao_buscar" value="" >

			</form>

		</div>
		
		<form action="scriptImprimirOuConcluirServicos.php" method="post" name="form2">
			<div id="painelDeOpcoes" class="painel opcoes">
			<input type="hidden" name="acao" value = "imprimir" >
			<ul>
				<li>
					<a class="botao" href="formularioCadastrarServico.php">Solicitar novo serviço</a>
				</li>
				
		<?php

			$usuario = $_SESSION['usuarioLogado'];                
			
			if ( $usuario->getPermissao() == 0 || $usuario->getPermissao() == 1 )
			{
				echo('

				<li>
					<a class="botao" href="javascript:acaoConcluir();" name="concluidos">Marcar como concluido</a>
				</li>
 				<li>
					<a href="javascript:acaoImprimir();" class="botao" name="imprimir"> Imprimir relatório de execução</a>
				</li> 
				<li>
					<a href="javascript:selecionar_checkbox();" class="botao">Selecionar todos</a>
				</li>'
				);
			}
			 ?>
			</ul>
	</div>

	<div class="painel resultados">
	<table class="tableshorting resultados" cellpadding="3px" id="tabela" border="1px" cellspacing="2px">
			<thead class="cabecalho">
				<th>ID</th>
				<th>Data</th>
				<th>Idm</th>
				<th><img src="imagens/colocacao.png" alt="C"></th>
				<th><img src="imagens/retirada.png" alt="R"></th>
				<th>A</th>
				<th>V</th>
				<th><img src="imagens/foto.png" alt="F"></th>
				<th><img src="imagens/vistoria.png" alt="Vi"></th>
				<th>Endereço</th>
				<th>Estado Atual</th>
				<th><img src="imagens/imprimir.png"></th>
			</thead>
		</thead>
		<tbody>
			
			
		<?php
		$gabTexto				= isset($_POST['texto'])			?	$_POST['texto']				:"";
		$gabPlaca				= isset($_POST['placa'])			?	$_POST['placa']				:0;
		$gabColocacao			= isset($_POST['colocacao'])		?	$_POST['colocacao']			:0;
		$gabRetirada			= isset($_POST['retirada'])			?	$_POST['retirada']			:0;
		$gabFoto				= isset($_POST['foto'])				?	$_POST['foto']				:0 ;
		$gabVistoria			= isset($_POST['vistoria'])			?	$_POST['vistoria']			:0;
		$gabStatus				= isset($_POST['status'])			?	$_POST['status']			:-1;
		$gabExcluidos			= isset($_POST['excluidos'])		?	$_POST['excluidos']			:0;
		$gabBuscaInteligente	= isset($_POST['buscaInteligente'])	?	$_POST['buscaInteligente']	:1;
		$gabLimite				= isset($_POST['limite'])			?	$_POST['limite']			:50;


		$gab = new GAB();

		$servicos = $gab->buscarServicoParaListarParaTabela(
			$gabTexto,
			$gabPlaca,
			$gabColocacao,
			$gabRetirada,
			$gabFoto,
			$gabVistoria,
			$gabStatus,
			$gabExcluidos,
			$gabBuscaInteligente,
			$gabLimite
		);
			
		$i=0;
		$imgOK = '<img src="./imagens/imgOK.png" >';

		$pendentes = 0;
		$concluidos = 0;
		$executando = 0;

		foreach ($servicos as $s) {



	 		$d = $s->getDataCadastro();
	   		$dataStringArray = explode(" - ",$d);

			$dataString = $dataStringArray[0];
            
			$data = date_create($dataString);

            $hoje = date_create();

			$diferenca = date_diff($data,$hoje)->format("%a");

			$urgencia="";
			if($diferenca >= 3 && $s->getStatusFinalTexto() !="CONCLUIDO")
			{
				$urgencia=' urgencia';
			}

			echo('<tr class="dados'.$urgencia.'">');
			echo("<td>");
			echo('<a href="formularioAlterarServico.php?id=');
			echo($s->getId());
			echo('">'.$s->getId().'</a>');
			echo("</td>");
			
			echo("<td>");
			
			$a_m_d = explode("/",$dataString);
			
			
			if(trim($dataString) != "")
			{
			echo('<span class="oculto">'.$dataString.'</span>');
			echo(trim($a_m_d[2]).'/'.$a_m_d[1]);
			}else
			{
				echo("Não Registrado");
			}
			
			echo("</td>"); 



   		
			echo("<td>");
			echo($s->getImovel()->getIdm());
			echo("</td>");
			echo("<td>");
			echo($s->getColocacao() == 1?$imgOK:"");
			echo("</td>");
			echo("<td>");
			echo($s->getRetirada() == 1?$imgOK:"");
			echo("</td>");
			echo("<td>");
			echo($s->getAluga() == 1?$imgOK:"");
			echo("</td>");
			echo("<td>");
			echo($s->getVenda() == 1?$imgOK:"");
			echo("</td>");
			echo("<td>");

			

			switch($s->getFoto())
			{
				case 0: echo ""; break;
				case 1: echo "INT"; break;
				case 2: echo "EXT"; break;
				case 3: echo "ALL"; break;
				default: echo "ERRO!";

			}

			echo("</td>");
			echo("<td>");
			echo($s->getVistoria() == 1?$imgOK:"");
			echo("</td>");
			echo("<td>");
			echo('<span class="oculto">'.$s->getImovel()->getBairro().'</span>');
			echo($s->getImovel()->toString());
			echo("</td>");
			echo("<td>");

			echo($s->getStatusFinalTexto());

   		 
                                           

			switch($s->getStatusFinalTexto())
			{
				case "PENDENTE":
					$pendentes++;
					break;
				case "CONCLUIDO":
					$concluidos++;
					break;
				case "EXECUÇÃO":
					$executando++;
					break;
			}

			echo("</td>");
			echo("<td>");
			echo('<input type="checkbox" id="gServicoParaImprimir" name="servicoParaImprimir[]" value="'.$s->getId().'" >');
			echo("</td>");
			echo("</tr>");
			$i++;
		}


		echo('</tbody><tfoot><th colspan="13">');
	
    	if ($i>1)
		{
			echo ("Foram encontrados " . $i . " serviços. ");
			echo ($executando . " em execução, ");
			echo ($pendentes . " pendente". ($pendentes>1?"s":"") .", ");
			echo ($concluidos . " concluido". ($concluidos>1?"s":"") .".");
		}
		else if($i==1)
		{
			echo ("Foi encontrado 1 serviço.");
		}
		else
		{
			echo ("Não foram encontrados serviços com as caracteristicas fornecidas.");
		}

		
		?>
		
		</th>


			</tr>
			</tfoot>
	
	</table>
	
</form>
    </div>
</div>

</body>
</html>                       	
