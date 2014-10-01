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
	
	$id=-1;

	if(isset($_GET['id']))
	{
		$id = intval($_GET['id']);
	
		if($id < 0)
		{
			erro("Parâmetro inválido!","index.php?page=configuracoesUsuarios");
		}
	}
	

	$usuarioLogado=getUsuarioLogado();
	if($usuarioLogado->permissao == Permissao::getIDPermissao("Administrador"))
	{

		if($id == -1)
		{
			// No caso de cadastro essa variavel é "inútil", mas ela simplifica a 
			// programação, pois o conteúdo dela é vazio. Assim evita um monte de 
			// ifs no meio dos htmls.
			$usuario = R::dispense('usuario');	
		}
		else
		{
			$usuario = R::load('usuario',$id);
		}
	}
	else if($usuarioLogado->id != $id) // Usuário não é ADMIN e está tentando acessar outro usuário.
	{
		erro("Você não tem autorização para acessar esse usuário!","index.php?page=configuracoesUsuarios");
	}
	else // Usuário normal acessando seu registro
	{
		$usuario = R::load('usuario',$usuarioLogado->id);
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
			<input type="text" name="nome" value="<?php echo ($usuario->login); ?>" size="64" required>
		</p>

		<p>
			<label>Senha </label>
			<?php
				$senha =str_repeat("*",strlen($usuario->senha_hash));
			?>
			<input type="text" name="nome" value="<?php echo $senha ?>" size="64" required>
		</p>

		<p>
			<label>E-mail </label>
			<input type="text" name="nome" value="<?php echo ($usuario->email); ?>" size="64" required>
		</p>

		<p>
			<label>Permissão</label>
			<select name="tipo" required>

			<?php			

				$selected="";
				foreach (Permissao::getListaPermissao() as $tipo) {
					
					$selected = $usuario->tipo == $tipo[0] ? "selected" : "";
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
			<button>Salvar</button>

			<!-- Recurso técnico provisório de longo prazo -->
			<button 
				onclick='
					window.location="index.php?page=scriptManipularUsuario&modo=excluir&id=<?php echo($id);?>";
					return false;
				'
				<?php if($id==-1) echo ("class='invisivel'"); ?>
			>Excluir</button>
			<!-- Fim do Recurso técnico provisório de longo prazo -->

		</div>
	</form>
</div>
