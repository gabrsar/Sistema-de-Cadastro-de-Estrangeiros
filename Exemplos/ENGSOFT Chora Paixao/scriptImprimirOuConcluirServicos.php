<?php
	include('start.php');
	validaSessao();
?>
<?php
	
	$idServicos = $_POST['servicoParaImprimir'];
	
	require_once("dados.php");  		

	error_reporting(E_ALL);
	ini_set("display_errors", 1);

?>

<?php

	if(!isset($_POST["servicoParaImprimir"]))
	{
		header("Location: ./formularioBuscarServico.php");
		die;
	}
	$idServicos = $_POST["servicoParaImprimir"];
	$permissao = $_SESSION["usuarioLogado"]->getPermissao();
	$gab = new GAB();
	if($_POST["acao"] == "concluir")
	{
		
  		if($permissao == 0 || $permissao == 1)
		{
			foreach($idServicos as $id)
			{
				$s = new Servico();

				$s = $gab->buscarServico($id);
				$s->setStatusFinalTexto("CONCLUIDO");

				$gab->alterarServico($s,$usuarioLogado);



        	} 

		}

	  	header( 'Location:formularioBuscarServico.php' ) ;

		die;

	}

?>
	
<html>
<head>
	<meta>       
		<meta name="author" content="Gabriel H. M. Saraiva">
		<meta charset="UTF-8"> 
		<title>Relatório de Serviços para Execução - <?php echo date("d/m/Y")?></title>
		<link href="temas/temaImprimir.css" rel="stylesheet" type="text/css" />
	</meta>
</head>
<body>
	<p class="titulo"> Relatório de Serviços para Execução - Impresso em <?php echo date("d/m/Y - H:i:s");?> </p>
<table class="tableshorting resultados" cellpadding="3px" id="tabela" border="1px" cellspacing="2px">
		<thead>
			<th>ID</th>
			<th>DATA</th>
			<th width="22">Idm</th>
  			<th><img src="imagens/colocacao.png" alt="C"></th>
			<th><img src="imagens/retirada.png" alt="R"></th> 
			<th width="22">A</th>
			<th width="22">V</th>
            <th><img src="imagens/foto.png" alt="F"></th>
			<th><img src="imagens/vistoria.png" alt="Vi"></th> 
			<th>Informações</th>
			<th>Corretor</th>
			<th>OK</th>
		</thead>
	<tbody>

<?php 
	
	if($_POST['acao'] == "imprimir")
	{
		$i=0;

  		$imgOK = '<img src="./imagens/imgOK.png" />';
		
		// Popula a tabela com os serviços para serem executados.
		foreach($idServicos as $id)
		{
			
			$s = new Servico();

			$s->setId($id);
		
			$s = $gab->buscarServico($id);

			$usuario = $gab->buscarQuemCadastrouServico($id);


			$setor = "";

			if( $usuario->getSetor() == 1 )
			{
				$setor = " [SETOR ALUGA]";
			}
			else if ( $usuario->getSetor() == 2)
			{
				$setor = " [SETOR VENDA]";
			}

			

			$d = $s->getDataCadastro();
			$dataStringArray = explode(" - ",$d);
			$dataString = $dataStringArray[0];
			$data = date_create($dataString);

        	$hoje = date_create();

			$diferenca = date_diff($data,$hoje)->format("%a");

			echo $diferenca;
			$urgencia="";
			if($diferenca >= 3 && $s->getStatusFinalTexto() !="CONCLUIDO")
			{
				$urgencia=' urgencia';
			}

			echo('<tr class="dados' . $urgencia .  '">');
			echo("<td>");
			echo('<a href="formularioAlterarServico.php?id=');
			echo($s->getId());
			echo('">'.$s->getId().'</a>');
			echo("</td>");
			
			echo("<td>");
			
			$a_m_d = explode("/",$dataString);
			
			
			if(trim($dataString) != "")
			{
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
				case 0: echo "";	break;
				case 1: echo "EXT";	break;
				case 2: echo "INT"; break;
				case 3: echo "ALL"; break;
			}

			echo("</td>");
			echo("<td>");
			echo($s->getVistoria() == 1?$imgOK:"");
			echo("</td>");
			echo("<td>");
			echo($s->getImovel()->toStringCompleto());
			echo("<span class=\"imovel-endereco\">");
			if($s->getColocacao() == 1 && $s->getImovel()->getPlaca() == 1)
			{
				echo(", [PLACA TAMANHO ". strtoupper( $s->getImovel()->getTipoDePlacaTexto()) . "]");
			}

			if($s->getOutros() != "")
			{
				echo(", [INF_AUX: " . $s->getOutros() . "]");
			}
        	
        	if($s->getProblema() != "")
			{
				echo(", [MOTIVO: " . $s->getProblema() . "]");
			}

			echo( $setor);

			echo("</span>");
			echo("</td>");
 			echo("<td>");
			echo($s->getImovel()->getCorretor());
			echo("</td>");
    		echo("<td>");
			echo("</td>");
			echo("</tr>");
			$i++;

			// Altera o status dos serviços para execução

			if($permissao == 0 || $permissao == 1)
			{
				$s->setStatusFinal(2);
				$gab->alterarServico($s,$usuarioLogado);
        	}
		}
	}
?>
</table>
</body>
</html>

