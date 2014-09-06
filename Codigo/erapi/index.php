<!DOCTYPE html>
<?php

require("rb/db.php");
rbSetup();

require_once ("./simplex/redirect.php");
$pagina = obterPagina();

?>
<html lang="pt_BR">
	<head>
		<?php
			include ("simplex/head.php");
		?>
	</head>
	<body>
   	<div id="pagina">
			<?php
				include ("simplex/topo.php");
			?>
			<div id="corpo">
				<?php
					require ($pagina);
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
