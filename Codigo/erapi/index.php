<!DOCTYPE html>
<?php

require("simplex/scriptMaster.php");

require_once ("./simplex/redirect.php");
$pagina = obterPagina();

?>
<html lang="pt_BR">
	<head>
		<?php
			include ("simplex/head.php");
		?>

		<script src="js/jquery-latest.js"></script>
		
	</head>
	<body>
   	<div id="pagina">
			<?php
				include ("simplex/topo.php");
			?>
			<div id="corpo">
				<?php
					if(file_exists($pagina))
					{
						require ($pagina);
					}
					else
					{
						echo "Não foi possivel abrir o arquivo $pagina";
					}
				?>
	    	</div>
			<?php
				include ("simplex/rodape.php");
			?>
		</div>

	    <?php
//			include("clicky.php");
//			include("analyticstracking.php");
//			include("mouseflow.php");
		?>
 
	</body>
</html>
