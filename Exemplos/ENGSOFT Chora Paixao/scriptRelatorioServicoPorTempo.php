<?php
	include('start.php');
	validaSessao();
?>


			
<?php

	$dataInicio = $_POST['dataInicio'];
	$dataFinal = $_POST['dataFinal'];

	$gab = new GAB();


	$dataInicioSQL = formata_data($dataInicio);
	$dataFinalSQL  = formata_data($dataFinal);
	
	$sql = "SELECT s.statusFinal, s.retirada, s.colocacao, s.venda, s.aluga, s.separarChave, s.vistoria, s.foto, e.data ".
	" FROM borsaritbservicos s INNER JOIN borsaritbeventos e ON (e.evento = 13 AND e.idAlteracao = s.id) WHERE ".
	"e.data >= '" . $dataInicioSQL ."' AND e.data <= '". $dataFinalSQL ."';";
	
	$resultado = $gab->executarSql($sql);
	
	$dadosTiposDeServico = array(0,0,0,0,0);
	
	$dadosStatusAtual = array(0,0,0,0,0,0);
	
	$i=0;

	while($resultSet = mysql_fetch_assoc($resultado)) {

		$status = $resultSet['statusFinal'];
		
		$dadosStatusAtual[$status]++;
		
		/*
			0 - Colocação 
			1 - Retirada
			2 - Vistoria
			3 - Foto
			4 - Separação de chaves
		*/

		
		if($resultSet['colocacao'] == 1){
				$tipo=0;
				$dadosTiposDeServico[$tipo]++;
		}	
		
		if($resultSet['retirada'] == 1){
				$tipo=1;
				$dadosTiposDeServico[$tipo]++;
		}
		
		if($resultSet['vistoria'] == 1){
			$tipo=2;
			$dadosTiposDeServico[$tipo]++;
		}
		
		if($resultSet['foto'] == 1){
			$tipo=3;
			$dadosTiposDeServico[$tipo]++;
		}
		
		if($resultSet['separarChave'] == 1){
			$tipo=4;
			$dadosTiposDeServico[$tipo]++;
		}
	
		$i++;
		
	}
	
	
	
?>

<html>
	<head>
		<title>Relatório</title>
	</head>
	
	<body>
		<center>
			<p><h1>Relatório de serviços executados</h1></p>
			<?php echo ("<p><h3>Período de avaliação:".$_POST['dataInicio'] . " á " . $_POST['dataFinal']. " </h3></p>"); ?>
		</center>
		<br/>

		<p>Total de serviços cadastrados: <?php echo $i; ?></p>

		<p>Colocação: <?php echo $dadosTiposDeServico[0]; ?></p>
		

		<p>Retirada: <?php echo $dadosTiposDeServico[1]; ?></p>
		
		<p>Vistoria: <?php echo $dadosTiposDeServico[2] ; ?></p>
		<p>Foto: <?php echo $dadosTiposDeServico[3] ; ?></p>
		<p>Separação de chave: <?php echo $dadosTiposDeServico[4] ; ?></p>

		<p><b>Resumo</b></p>
		<p>Dos <?php echo $i; ?> serviços análisados, atualmente estão:</b></p>
		<p><?php echo $dadosStatusAtual[3]; ?> concluido(s)</p>
		<p><?php echo $dadosStatusAtual[2]; ?> em execução</p>
		<p><?php echo $dadosStatusAtual[1]; ?> agendado(s)</p>
		<p><?php echo $dadosStatusAtual[0]; ?> pendente(s)</p>
		<p><?php echo $dadosStatusAtual[4]; ?> com problema(s)</p>
		<p><?php echo $dadosStatusAtual[5]; ?> outra categoria</p>
		
		






