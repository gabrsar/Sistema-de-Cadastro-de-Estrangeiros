<?php

	$id=-1; // -1 - Cadastrar, >0 = editar
	

	if(isset($_GET['id']))
	{
		$id = intval($_GET['id']);
	
		if($id < 0)
		{
			header("location:index.php");
		}
	}

	
	if($id == -1)
	{
		$departamento = R::dispense('departamento');	
	}
	else
	{
		$departamento = R::load('departamento',$id);
	}

?>

<script src="js/validarDepartamento.js"></script>

<div class="formulario">

	<p class="titulo">
		<?php
		if($id==-1){
			echo ("Cadastrar novo departamento");
		}else
		{
			echo ("Editar '$departamento->nome'");
		}
		?>
	</p>

	<?php

		$action="index.php?page=scriptManipularDepartamento&";

		if($id == -1)
		{
			$action.="modo=cadastrar";
		}
		else
		{
			$action.="modo=editar&id=$id";
		}
	?>

	<form action="<?php echo($action);?>" method="post" id="register-form">
		<label>Nome do departamento </label>
		<input type="text" name="nome" value="<?php echo ($departamento->nome); ?>" size="64" required></p>

		<div class="barraBotoes">
			<button>Salvar</button>

			<button 
				onclick='
					window.location="index.php?page=scriptManipularDepartamento&modo=excluir&id=<?php echo($id);?>";
					return false;
				'
				<?php if($id==-1) echo ("class='invisivel'"); ?>
			>Excluir</button>
		</div>
	</form>
</div>