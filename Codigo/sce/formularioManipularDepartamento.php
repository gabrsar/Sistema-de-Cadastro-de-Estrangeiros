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

		// Apenas administrador pode cadastrar um novo departamento
		if($usuario->permissao != Permissao::getIDPermissao("Administrador"))	{
			erro("Você não tem permissão para executar essa ação!",
				"index.php?page=configuracoesDepartamentos");
		}


		// No caso de cadastro essa variavel é "inútil", mas ela simplifica a 
		// programação, pois o conteúdo dela é vazio. Assim evita um monte de 
		// ifs no meio dos htmls.     
		$departamento = R::dispense('departamento');	
	}
	else
	{
		$departamento = R::load('departamento',$id);
		if($departamento->excluido == true)
		{
			erro("Esse departamento foi excluido!","index.php?page=configuracoesDepartamentos");
		}
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
			if($usuario->permissao == Permissao::getIDPermissao("Administrador")){
				echo ("Editar '$departamento->nome'");
			}
			else
			{
				echo ("Visualizar $departamento->nome");	
			}


		}
	?>
	</p> 
</div> 


<?php

	$action="";
	
	if($usuario->permissao == Permissao::getIDPermissao("Administrador")){
	
		$action="index.php?page=scriptManipularDepartamento&";
		if($id == -1)
		{
			$action.="modo=cadastrar";
		}
		else
		{
			$action.="modo=editar&id=$id";
		}
	}
	
?>

<form action="<?php echo($action);?>" method="post" id="register-form">
	<p>
		<label>Nome do departamento </label>
		<input type="text" name="nome" value="<?php echo ($departamento->nome); ?>" size="64" required>
	</p>

	<div class="barraBotoes">
	<?php
			
		if($usuario->permissao == Permissao::getIDPermissao("Administrador")){
			$botaoSalvar =<<<EOT
			<button>Salvar</button>
EOT;
			$botaoExcluir =<<<EOT
			<button onclick='window.location="index.php?page=scriptManipularDepartamento&modo=excluir&id=$id"; return false;'>Excluir</button>
EOT;
			echo $botaoSalvar;

			if($id != -1 )
			{
				echo $botaoExcluir;
			}
		}
	?>
	</div>
</form>