<?php require_once("start.php");
validaSessao();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $titulo; ?></title>
        <link href="temas/tema1.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-latest.js"></script>
        <script type="text/javascript" src="js/jquery.corner.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
        <script type="text/javascript" id="js">
		$(document).ready(function() {
            // call the tablesorter plugin
            $("table").tablesorter({
                widgets: ['zebra']
            })
        });
        </script>
    </head>
    <body>
        <?php require_once("topo.php"); ?>
        <?php require_once("menu.php"); ?>
        
        

        <div class="formulario"><span class="titulo">Relatórios - Serviço executados</span>
            <fieldset id="painelDePesquisa"><legend>Parametros</legend>	
			
				<form action="scriptRelatorioServicoPorTempo.php" method="POST">
				
				<p>Faixa de pesquisa</p>
				<p> Data inicial <input type="text" size="10" name="dataInicio" /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Data final <input type="text" size="10"  name="dataFinal" /></p>
				<p> <input type="submit" value="Gerar" /> </p>
				
			</fieldset>
		</div>
    </body>
</html>

									