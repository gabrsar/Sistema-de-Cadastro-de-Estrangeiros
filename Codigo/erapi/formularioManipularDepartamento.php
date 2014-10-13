<?php

   
    /* Autor: Gabriel Henrique Martinez Saraiva
	 * Formulário para manipular os departamentos.
	 * Essa página faz:
	 *		Cadastro,
	 *		Edição,
	 *		Exclusão.
	 * 
	 * Parâmetros:
	 *		id (opcional)
	 *			Caso fornecido exibe o registro referente ao ID com opção para 
	 *			alterar e excluir.
	 *			Caso seja omitido o formulário entra no módo de cadastro de um 
	 *			novo registro.
	 */                 

    require("permissao.php");

	$usuario = getUsuarioLogado();

	if($usuario->permissao != Permissao::getIDPermissao("Administrador"))	{
		erro("Você não tem permissão para executar essa ação!",
			"index.php?page=configuracoesDepartamentos");
	}

	$id=-1;
	

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
		// No caso de cadastro essa variavel é "inútil", mas ela simplifica a 
		// programação, pois o conteúdo dela é vazio. Assim evita um monte de 
		// ifs no meio dos htmls.     
		$departamento = R::dispense('departamento');	
	}
	else
	{
		$departamento = R::load('departamento',$id);
	}

?>

<div id="titulo">
	<a href="index.php?page=configuracoesDepartamentos" class="voltar">&lt&lt</a>


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
</div> 

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
		<p>
			<label>Nome do departamento </label>
			<input type="text" name="nome" value="<?php echo ($departamento->nome); ?>" size="64" required>
		</p>

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
