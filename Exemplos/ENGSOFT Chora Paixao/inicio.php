<?php
require_once("start.php");
validaSessao();
?>

<?php


$nomeCookie = "anuncio_" . $usuarioLogado->getLogin();

if(!isset($_COOKIE[$nomeCookie]))
{
	header("Location: ./anuncio.php");
}


        	
        	
        	$gab = new GAB();
?>

<!DOCTYPE html>
<html>
<head>
<?php require_once("head.php"); ?>

 <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.

      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Data de Cadastro');
        data.addColumn('number', 'Quantidade de Serviços Cadastrados de Todos Usuários');
        data.addRows([
        <?php
			
			$sql = "SELECT count(e.id) as servicos,DATE_FORMAT(e.data,'%Y,%m,%d') AS data FROM tbeventos e WHERE e.evento = 12 GROUP BY YEAR(e.data), MONTH(e.data),DAY(e.data)";

				$dadosGrafico="";
				$resultado = $gab->executarSQL($sql);
				$i=0;
                while($registro = mysql_fetch_assoc($resultado)) {

                	$dadosGrafico.="[new Date(".$registro['data']."),".$registro['servicos']."],";

				}

				echo substr($dadosGrafico,0,-1);

				?>
				]);

        // Set chart options
        var options = {'title':'Relação de Serviços por Data',
						'height':400,
						'width':800,
                       'pointSize':5
                       
                       };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>      

</head>
<body>
 

    <?php require_once("topo.php"); ?>
    <?php require_once("menu.php"); ?>

	
	<div class="formulario">

		<p class="titulo">
			Olá <?php echo $usuarioLogado->getNome(); ?>
		</p>

		<span>Lista dos 5 ultimos serviços que você solicitou:</span>

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

		$servicos = $gab->buscarUltimosServicosDeUsuario($usuarioLogado->getId(),5);			
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
			echo($s->getFoto() == 1?$imgOK:"");
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
			echo('<input type="checkbox" id="gServicoParaImprimir" name="serivcoParaImprimir[]" value="'.$s->getId().'" >');
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
		</div>

		<div class="painel grafico">
			<div id="chart_div"></div>
		</div>
    </div>

</body>
</html>
