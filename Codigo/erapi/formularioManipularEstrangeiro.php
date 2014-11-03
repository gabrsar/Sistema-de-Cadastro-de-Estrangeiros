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

	require_once("curso.php");
	require_once("permissao.php");

	// -------------------------------------------------------------------------
	// Monta variável para verificação de permissão

	$usuario	= getUsuarioLogado();
	$isAdmin	= $usuario->permissao == Permissao::getIDPermissao("Administrador");
	$isUsuario	= $usuario->permissao == Permissao::getIDPermissao("Usuário");
	
	$id=0;
	if(isset($_GET['id'])) {
		$id = sanitizeInt($_GET['id']);
	
		if($id < 1){
			erro("Parâmetro inválido!","index.php?page=estrangeiros");
		}
	}

	// -------------------------------------------------------------------------
	// Carrega dados do estrangeiro

	$estrangeiro = R::load('estrangeiro', $id);
	$foto = $estrangeiro->foto;
	if($foto == "") $foto = "imagens/default.png";

	// -------------------------------------------------------------------------
	// Analisa permissão, monta o action e monta combobox para seleção de atuação/departamento

	$action="";
	$action="index.php?page=scriptManipularEstrangeiro&";

	$comboAtuacao = "";
	$comboDepartamento = "";
	$departamentos = R::findAll('departamento', 'excluido=0'); //find departamento id=0

	if($id == 0) {
		$titulo = "Cadastrar novo estrangeiro";
		
		if(!($isAdmin || $isUsuario)) {
			erro("Você não tem permissão para executar essa ação!",
				"index.php?page=estrangeiros");
		}
		else {
			$action.="modo=cadastrar";
		}

		// Monta combobox de atuação para cadastro
		$comboAtuacao .= "<option id=\"opcao_atuacao\" value=\"\" selected></option>";
		foreach(TipoDeCurso::getListaTipoCursos() as $tipo) {
			$comboAtuacao .= "<option id=\"opcao_atuacao_$tipo[0]\" value=\"$tipo[0]\">$tipo[1]</option>";
		}
		// Monta combobox de departamento para cadastro
		$comboDepartamento .= "<option value=\"\" selected></option>";
		foreach($departamentos as $departamento) {
			$comboDepartamento .= "<option value=\"$departamento->id\">$departamento->nome</option>";
		}
	}
	else {
		if($isAdmin || $isUsuario) {
			$titulo = "Editar '$estrangeiro->nome'";
			$action.="modo=editar&id=$id";
		}
		else {
			$titulo = "Visuzalizar estrangeiro $estrangeiro->nome";
		}

		// Monta combobox de atuação para edição/exclusão/visualização
		foreach(TipoDeCurso::getListaTipoCursos() as $tipo) {
			$selected = $estrangeiro->atuacao != $tipo[0] ? "" : "selected";
			$comboAtuacao .= "<option id=\"opcao_atuacao_$tipo[0]\" value=\"$tipo[0]\" $selected>$tipo[1]</option>";
		}
		// Monta combobox de departamento para edição/exclusão/visualização
		foreach($departamentos as $departamento) {
			$selected = $estrangeiro->departamento != $departamento->id ? "" : "selected";
			$comboDepartamento .= "<option value=\"$departamento->id\" $selected>$departamento->nome</option>";
		}
	}
?>

<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script type="text/javascript" src="js/gen_validatorv4.js"></script>
<script>
$(function() {
	$( "#inicio" ).datepicker({
		dateFormat: 'dd/mm/yy',
		autoSize: true,	
		changeMonth: true,
		changeYear: true,
		showOtherMonths: true,
		selectOtherMonths: true,
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
	});
	$( "#fim" ).datepicker({
		dateFormat: 'dd/mm/yy',
		autoSize: true,	
		changeMonth: true,
		changeYear: true,
		showOtherMonths: true,
		selectOtherMonths: true,
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
	});
});
</script>

<div id="titulo">
	<a href="index.php?page=estrangeiros" class="voltar">&lt&lt</a>

	<p class="titulo">
		<?php
		echo ($titulo);
		?>
	</p>
</div>

<div id="wrapper">
	<form action="<?php echo($action);?>" method="post" id="register-form" enctype="multipart/form-data">
		<p>
			<img src="<?php echo($foto);?>"  height="192" width="192">
		</p>
		<p>
			<label for="foto">Alterar foto</label>
			<input id="foto" name="foto" type="file">
			<span id='register-form_foto_errorloc' class='erro_validacao'></span>
		</p>
		<p>
			<label for="nome">Nome completo*</label>
			<input type="text" name="nome" value="<?php echo ($estrangeiro->nome); ?>" size="64" required>
		</p>
		<p>
			<label for="email">E-mail*</label>
			<input type="email" name="email" value="<?php echo ($estrangeiro->email); ?>" size="64" required>
			<span id='register-form_email_errorloc' class='erro_validacao'></span>
		</p>
		<p><!--VERIFICAR TYPO PASSAPORT-->
			<label for="passaporte">Passaporte*</label>
			<input type="text" name="passaporte" value="<?php echo ($estrangeiro->passaport); ?>" size="64" required>
		</p>
		<p>
			<label for="rne">RNE</label>
			<input type="text" name="rne" value="<?php echo ($estrangeiro->rne); ?>" size="64">
		</p>
		<p>
			<label for="curso">Atuação*</label>
			<select name="curso" required>
				<?php
					echo($comboAtuacao);
				?>
			</select>
		</p>
	<!--TODO OPERAÇÃO AO SELECIONAR "OUTROS"////OLHAR RELATORIO DO CAIK -->
		<p>
			<label for="pais">País de origem*</label>
			<input type="text" name="pais" value="<?php echo($estrangeiro->pais);?>" size="64" required>
		</p>

		<p>
			<label for="instituicao">Instituição de origem*</label>
			<input type="text" name="instituicao" value="<?php echo($estrangeiro->instituicao);?>" size="64" required>
		</p>

		<p>
			<label for="docente">Docente responsável no IBILCE*</label>
			<input type="text" name="docente" value="<?php echo($estrangeiro->docente);?>" size="64" required>
		</p>

		<p>
			<label for="email_docente">E-mail do docente responsável no IBILCE*</label>
			<input type="email" name="email_docente" value="<?php echo($estrangeiro->email_docente);?>" size="64" required>
			<span id='register-form_docente_errorloc' class='erro_validacao'></span>
		</p>

		<p>
			<label for="departamento">Departamento do docente*</label>
			<select name="departamento" required>
				<?php
					echo($comboDepartamento);
				?>
			</select>
		</p>
		<p>
			<label for="atividade">Atividade a ser desenvolvida*</label>
			<textarea name="atividade"  rows="7" cols="60" required><?php echo($estrangeiro->atividade);?></textarea>
		</p>

		<p>
			<label>Data de chegada*</label>
			<input ondrop="return false;" type="text" name="ano" id="inicio" size="10" maxlength="10" value="<?php echo($estrangeiro->data_chegada); ?>" required readonly>
		</p>

		<p>
			<label>Data de saída*</label>
			<input ondrop="return false;" type="text" name="ano" id="fim" size="10" maxlength="10" value="<?php echo($estrangeiro->data_saida); ?>" required readonly>
		</p>

		<div class="barraBotoes">
			<?php
			$checkboxValidado = "";
			$botaoSalvar = "<button id=\"btn_salvar\">Salvar</button>";
			$botaoExcluir = "";

			if($isUsuario || $isAdmin){
				$validado = $estrangeiro->validado==1 ? "checked" : "";
				$checkboxValidado = "<p><input type=\"checkbox\" id=\"validado\ name=\"validado\" $validado>Validado</input></p>";

				if($id > 0 ) {
					$botaoExcluir = "<button id=\"btn_excluir\" onclick='window.location=\"index.php?page=scriptManipularEstrangeiro&modo=excluir&id=$id\"; return false;'>Excluir</button>";
				}
			}

			echo $checkboxValidado;
			echo $botaoSalvar;
			echo $botaoExcluir;
			?>
		</div>
	</form>
</div>
<script type='text/javascript'>
	var frmvalidator  = new Validator("register-form");
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("email","email","Digite um email válido");

	frmvalidator.addValidation("email_docente","email","Digite um email válido");
</script>
<script type="text/javascript" src="js/scriptValidaImagem.js"></script>