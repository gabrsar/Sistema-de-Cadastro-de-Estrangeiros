<?php
require_once("start.php");
require_once("dados.php");
?>
<!DOCTYPE>
<html>
<head>

<?php require_once("head.php"); ?>

</head>

<body>

	<?php require_once("topo.php"); ?>
    <?php require_once("menu.php"); ?>
    
    <div id="erro">

		<p id="titulo"> <?php echo $_SESSION['erro']; ?> </p>
		<p id="motivo"> <?php echo $_SESSION['erro_motivo']; ?> </p>

		<a href="<?php echo $_SESSION['irPara']; ?>">Continuar</a>
	</div>


    </body>
</html>
