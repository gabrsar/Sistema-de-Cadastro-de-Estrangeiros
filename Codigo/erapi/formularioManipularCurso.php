<?php

	/* Autor: Gabriel Henrique Martinez Saraiva
	 * Formulário para manipular os cursos.
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

	require("curso.php");
	require("permissao.php");

	$usuario = getUsuarioLogado();
	
	$id=-1;

	if(isset($_GET['id']))
	{
		$id = intval($_GET['id']);
	
		if($id < 0)
		{
			erro("Parâmetro inválido!","index.php?page=configuracoesCursos");
		}
	}
	

	if($id == -1)
	{
		
		// Apenas administrador pode cadastrar um novo curso
		if($usuario->permissao != Permissao::getIDPermissao("Administrador"))	{
			erro("Você não tem permissão para executar essa ação!",
				"index.php?page=configuracoesCursos");
		}


		// No caso de cadastro essa variavel é "inútil", mas ela simplifica a 
		// programação, pois o conteúdo dela é vazio. Assim evita um monte de 
		// ifs no meio dos htmls.
		$curso = R::dispense('curso');	
	}
	else
	{
		$curso = R::load('curso',$id);
		if($curso->excluido == true)
		{
			erro("Esse curso foi excluído!","index.php?page=configuracoesCursos");
		}
	}

?>

<div id="titulo">
	<a href="index.php?page=configuracoesCursos" class="voltar">&lt&lt</a>


  	<p class="titulo">
	<?php
		if($id==-1){
			echo ("Cadastrar novo curso");
		}else
		{
			if($usuario->permissao == Permissao::getIDPermissao("Administrador")){
				echo ("Editar '$curso->nome'");
			}
			else
			{
				echo ("Visuzalizar curso de $curso->nome");
			}

			
		}
	?>
	</p> 
</div> 

  
<?php

	$action="";

	if($usuario->permissao == Permissao::getIDPermissao("Administrador")){

		$action="index.php?page=scriptManipularCurso&";
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
		<label>Nome do curso </label>
		<input type="text" name="nome" value="<?php echo ($curso->nome); ?>" size="64" required>
	</p>

	<p>
		<label>Tipo</label>
		<select name="tipo" required>
	</p>
	<?php			


		$selected="";
		foreach (TipoDeCurso::getListaTipoCursos() as $tipo) {
			
			$selected = $curso->tipo == $tipo[0] ? "selected" : "";
			echo ('<option value="'.$tipo[0].'" '. $selected.'>'.$tipo[1].'</option>');

		}
	?>

	</select>

	<div class="barraBotoes">
	<?php
			
		if($usuario->permissao == Permissao::getIDPermissao("Administrador")){
			$botaoSalvar =<<<EOT
			<button>Salvar</button>
EOT;
			$botaoExcluir =<<<EOT
			<button onclick='window.location="index.php?page=scriptManipularCurso&modo=excluir&id=$id"; return false;'>Excluir</button>
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