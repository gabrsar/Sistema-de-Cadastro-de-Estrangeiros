<?php

	/* Autor: Gabriel Henrique Martinez Saraiva
	 * Formulário para manipular os usuarios.
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


	

	$id="";
	if(isset($_GET['id']))
	{
		$id=sanitizeInt($_GET['id']);
		if($id < 0)
		{
			erro("Parâmetros incorretos!","index.php?page=configuracoesUsuarios");
		}
	}
	else
	{
		$id=-1;
	}
	
	if(!Permissao::usuarioPodeAcessarID($id))
	{
		erro("Você não pode executar essa ação!","index.php?page=configuracoesUsuarios");
	}

	$usuario=null;	
	if($id == -1)
	{
		$usuario = R::dispense('usuario');	
	}
	else
	{
		$usuario = R::load('usuario',$id);
	}
?>

<div id="titulo">
	<a href="index.php?page=configuracoesUsuarios" class="voltar">&lt&lt</a>
  	<p class="titulo">
	<?php
		if($id==-1){
			echo ("Cadastrar novo usuario");
		}else
		{
			echo ("Editar '$usuario->nome'");
		}
	?>
	</p> 
</div> 

<div>
  	<?php

		$action="index.php?page=scriptManipularUsuario&";

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
			<label>Nome</label>
			<input type="text" name="nome" value="<?php echo ($usuario->nome); ?>" size="64" required>
		</p>

		<p>
			<label>Login </label>
			<input type="text" name="login" value="<?php echo ($usuario->login); ?>" size="64" required>
		</p>

		<p>
			<label>Senha </label>
			<input type="password" name="senha" value="<?php echo ($usuario->senha_hash); ?>" size="64" required>
		</p>

		<p>
			<label>E-mail </label>
			<input type="text" name="email" value="<?php echo ($usuario->email); ?>" size="64" required>
		</p>

		<p>
			<label>Permissão</label>
			<select name="permissao" required>

			<?php			

				$selected="";
				foreach (Permissao::getListaPermissao() as $tipo) {
				
					$selected = $usuario->permissao == $tipo[0] ? "selected" : "";
					echo ('<option value="'.$tipo[0].'" '. $selected.'>'.$tipo[1].'</option>');

				}
			?>

			</select>
		</p>

		<p>
			<label>Data de cadastro</label>
			<span><?php echo $usuario->data_cadastro; ?></span>
		</p>

		<div class="barraBotoes">
	<?php
	
		$botaoSalvar =<<<EOT
		<button>Salvar</button>
EOT;
	
		echo $botaoSalvar;

		if(getUsuarioLogado()->permissao == Permissao::getIDPermissao("Administrador")){
	
			$botaoExcluir = <<< EOT
			<button onclick='window.location="index.php?page=scriptManipularUsuario&modo=excluir&id=$id"; return false;'>Excluir</button>
EOT;
	
			if($id != -1 )
			{
				echo $botaoExcluir;
			}
		}
	?>
	</div>
	</form>
</div>
