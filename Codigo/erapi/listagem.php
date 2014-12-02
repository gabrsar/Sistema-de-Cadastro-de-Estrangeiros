<!DOCTYPE html>
<?php
	/* Autor: Victor Hugo Cândido de Oliveira
	 * Página de listagem de estrangeiros	 *
	 */

	require_once("rb/db.php");
	require("subformularioEstrangeiros.php");

	// Configura e inicia o RedBean
	rbSetup();
?>

<html lang="pt_BR">

	<head>
		<title>Sistema de Controle de Estrangeiros</title>

		<!-- Meta tags -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<!-- Temas CSS -->
		<link href="temas/tema.css" rel="stylesheet" type="text/css" />
		<link href="temas/jquery-ui.min.css" rel="stylesheet" type="text/css" />
		<link href="temas/jquery-ui.structure.min.css" rel="stylesheet" type="text/css" />
		<link href="temas/jquery-ui.theme.min.css" rel="stylesheet" type="text/css" />

		<!-- JQUERY -->
		<script src="js/jquery-latest.js"></script>
		<script src="js/scriptRodape.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/jquery.tablesorter.js"></script>
		<script> 
			$(document).ready(function() { 
				$(".tabela").tablesorter();
			} ); 
		</script>
	</head>

	<body>
		<div id="pagina">
			<div id="topo">
				<a href=""><h1>Sistema de Controle de Estrangeiros</h1></a>
			</div>

			<div id="corpo">
				<div id="titulo">
					<p class="titulo">Lista de cadastros</p>
				</div>

				<div class="listagem">
					<p class="titulo">Lista de cadastros</p>
					<?php
						mostrarTabelaEstrangeiros(true);	
					?>
				</div>
			</div>
			<div id="rodape">
				<p> Sistema de Controle de Estrangeiros - ERAPI - STAEPE </p>
			</div>
		</div>
	</body>
</html>