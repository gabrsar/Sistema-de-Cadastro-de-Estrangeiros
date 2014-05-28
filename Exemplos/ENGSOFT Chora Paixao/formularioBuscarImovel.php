<?php
require_once("start.php");
validaSessao();
?>

<!DOCTYPE html>
<html>
<head>

<?php require_once("head.php"); ?>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="js/busca_magica.js"></script>
<script type="text/javascript" src="js/selecionar_checkbox.js"></script>


<script type="text/javascript" id="js">
	$(document).ready(function() {
		// call the tablesorter plugin
		$("table").tablesorter()
	});
</script> 

</head>

<body>

	<?php require_once("topo.php"); ?>
    <?php require_once("menu.php"); ?>

	<div class="formulario">
	    
		<div class="painel pesquisa">
            
			<form action="formularioBuscarImovel.php" method="post" onsubmit="busca_magica_form_submit()" >

				<span>
					<input type="text" name="texto" value="Busca Mágica" size="12" id="busca_magica" onfocus="busca_magica_focus()" onblur="busca_magica_blur()" >

					<img src="imagens/buscaInteligentePequeno.png" alt="Utilizar busca inteligente">

					<input type="checkbox" name="buscaInteligente" value="1" checked>

				</span>
				<span>                
					<select name="setor">
                    	<option value="0">Setor</option>
                    	<option value="1">Aluga</option>
                    	<option value="2">Venda</option>
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

                <input type="submit" class="botao_buscar" value="">

            </form>

        </div>
		
		<form action="scriptEnviarParaVistoriaOuVistoriado.php" method="post" name="vistoria">
        
			<div class="painel opcoes">                
				<ul class="imovel">
				<li>
	
				<a class="botao" href="./formularioCadastrarImovel.php">Cadastrar Novo Imóvel</a>

				</li>

				<!-- DESATIVADO - NÃO ESTAMO FAZENDO SERVIÇO DE VISTORIA
				<li>

            	<a class="botao" href="javascript:document.vistoria.submit();" name="vistoriar">Solicitar vistoria</a>
				</li>
				<li>
            	<a class="botao" href="javascript:document.vistoria.submit();" name="vistoriado">Vistoriado</a>
				</li>
				-->
				</ul>
        </div>

        <div class="painel resultados">

		<table class="tableshorting resultados" cellpadding="3px" border="1px" cellspacing="2px">
            <thead class="cabecalho">
				<th>IDM</th>
				<th>A</th>
				<th>V</th>
				<th>Logradouro</th>
				<th>nº</th>
				<th>Q</th>
				<th>L</th>
				<th>Complemento</th>
				<th>Bairro</th>
				<th><img src="imagens/vistoria.png" width="22" height="22" alt="VISTORIAR" ></th> 
			</thead>
            <tbody>
                <?php

                $gab = new GAB();

				$gabBuscaInteligente	= isset($_POST['buscaInteligente'])	?	$_POST['buscaInteligente']	:1;
				$gabTexto				= isset($_POST['texto'])			?	$_POST['texto']				:"";
				$gabSetor				= isset($_POST['setor'])			?	$_POST['setor']				:0;
				$gabExcluidos			= isset($_POST['excluidos'])		?	$_POST['excluidos']			:0;
				$gabLimite				= isset($_POST['limite']) 			? 	$_POST['limite']			:50;		
                $resultado = $gab->buscarImovelParaListar($gabBuscaInteligente,$gabTexto,$gabSetor,$gabExcluidos,$gabLimite);

                $imgOK = '<img src="./imagens/imgOK.png">';
                $qtd = count($resultado);

                foreach ($resultado as $r) {

					echo('<tr class="dados" >');

                    echo('<td> <a href="formularioAlterarImovel.php?id=' . $r->getId() . '">'.$r->getIdm().'</a> </td>');
					
					
                    echo("<td>" . ($r->getAluga() == 1?$imgOK:"") . "</td>");
                    echo("<td>" . ($r->getVenda() == 1?$imgOK:"") . "</td>");

					echo("<td>" . ($r->getLogradouro()) . "</td>");

                    echo("<td>" . $r->getNumero() . "</td>");
                    echo("<td>" . $r->getQuadra() . "</td>");
                    echo("<td>" . $r->getLote() . "</td>");
                    echo("<td>" . $r->getComplemento() . "</td>");
                    echo("<td>" . $r->getBairro() . "</td>");

					echo('<td> <input type="checkbox" name="selecionado[]" value="'.$r->getId().'"</td>');

                    echo("</tr>");

                }
                ?>
            </tbody>
            <tfoot>
                <tr class="rodape">
                    <th colspan="10">Foram encontrados <?php echo $qtd; ?> registros</th>
                </tr>
            </tfoot>
        </table>
	</form>
    </div>
</body>
</html>
