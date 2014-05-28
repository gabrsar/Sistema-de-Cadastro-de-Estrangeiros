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

	<div id="sucesso">
	
		<p class="mensagem"><?php echo $_SESSION['mensagem'];?></p>

		
    </div>
    <div class="suporte-botoes-link margin-top">
	<a class="botao-link.sucesso" href="<?php echo $_SESSION['irPara']; ?>">Continuar</a>
		</div>
</body>
</html>
