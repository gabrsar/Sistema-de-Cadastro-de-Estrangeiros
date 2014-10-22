<?php

	/* Autor: Victor Hugo Cândido de Oliveira
	 * Formulário para manipular os estrangeiros.
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
	require("simplex/utils.php");

	$usuario = getUsuarioLogado();
	
	$id=-1;
	if(isset($_GET['id'])) {
		$id = sanitizeInt($_GET['id']);
	
		if($id < 0){
			erro("Parâmetro inválido!","index.php?page=estrangeiros");
		}
	}

	$estrangeiro = R::load('estrangeiro', $id);

	$isAdmin 	 = $usuario->permissao == Permissao::getIDPermissao("Administrador");
	$isUsuario = $usuario->permissao == Permissao::getIDPermissao("Usuário");
	if($id == -1) {
		$titulo = "Cadastrar novo estrangeiro";
		
		if(!($isAdmin || $isUsuario)) {
			erro("Você não tem permissão para executar essa ação!",
				"index.php?page=estrangeiros");
		}
	}
	else {
		if($isAdmin || $isUsuario) {
			$titulo = "Editar '$estrangeiro->nome'";
		}
		else {
			$titulo = "Visuzalizar estrangeiro $estrangeiro->nome";
		}
	}

	$estrangeiro = R::load('estrangeiro', $id);

?>

<div id="titulo">
	<a href="index.php?page=estrangeiros" class="voltar">&lt&lt</a>

	<p class="titulo">
		<?php
			echo ($titulo);
		?>
	</p>
</div>

<?php
	$action="";

	if($isUsuario || $isAdmin){
		$action="index.php?page=scriptManipularEstrangeiro&";
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
<div id="wrapper">
	<p>
		<label>Nome completo </label>
		<input type="text" name="nome" value="<?php echo ($estrangeiro->nome); ?>" size="64" required>
	</p>
	<p>
		<label>E-mail* </label>
		<input type="text" name="email" value="<?php echo ($estrangeiro->email); ?>" size="64" required>
	</p>
	<p>
		<label>Passaporte* </label>
		<input type="text" name="passaport" value="<?php echo ($estrangeiro->passaport); ?>" size="64" required>
	</p>
	<p>
		<label>RNE </label>
		<input type="text" name="rne" value="<?php echo ($estrangeiro->rne); ?>" size="64">
	</p>
	<p>
		<label>Atuação* </label>
		<select name="curso" required>
			<?php 
				$selected="";
				foreach(TipoDeCurso::getListaTipoCursos() as $tipo) {
					$selected = $estrangeiro->atuacao == $tipo[0] ? "selected" : "";
					echo('<option value="'.$tipo[0].'" '.$selected.'>'.$tipo[1].'</option>');
				}
			?>
		</select>
	</p>
<!--TODO OPERAÇÃO AO SELECIONAR "OUTROS"////OLHAR RELATORIO DO CAIK -->
	<p>
		<label>País de origem</label>
		<input type="text" name="nome" value="<?php echo($estrangeiro->pais);?>" size="64" required>
	</p>

	<p>
		<label>Instituição de origem*</label>
		<input type="text" name="nome" value="<?php echo($estrangeiro->instituicao);?>" size="64" required>
	</p>

	<p>
		<label>Docente responsável no IBILCE</label>
		<input type="text" name="nome" value="<?php echo($estrangeiro->docente);?>" size="64" required>
	</p>

	<p>
		<label>E-mail do docente responsável no IBILCE</label>
		<input type="text" name="nome" value="<?php echo($estrangeiro->email_docente);?>" size="64" required>
	</p>

	<p>
		<label>Departamento do docente</label>
		<select name="departamento" required>
			<?php 
				$selected="departamento";
				$departamentos = R::findAll('departamento', 'excluido=0');
				foreach($departamentos as $departamento) {
					$selected = $estrangeiro->departamento == $departamento->id ? "selected" : "";
					echo('<option value="'.$departamento->id.'" '.$selected.'>'.$departamento->nome.'</option>');
				}
			?>
		</select>
	</p>

	<p>
		<label>Atividade a ser desenvolvida*</label>
		<textarea name="atividade" value="<?php echo($estrangeiro->atividade);?>" rows="5" cols="40" required></textarea>
		
	</p>

	<p>
		<label>Previsão de chegada*</label>
	

	
		<label>Previsão de saída*</label>
	</p>

	<p>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<label>Enviar foto</label>
			<input type="file" name="foto"><br>
		</form>
	</p>

	<div class="barraBotoes">
		<?php
			if($isUsuario || $isAdmin){
				$botaoSalvar =<<<EOT
				<button>Salvar</button>
EOT;
				$botaoExcluir =<<<EOT
				<button onclick='window.location="index.php?page=scriptManipularEstrangeiro&modo=excluir&id=$id"; return false;'>Excluir</button>
EOT;
				echo $botaoSalvar;

				if($id != -1 )
				{
					echo $botaoExcluir;
				}
			}
		?>
	</div>
</div>
</form>