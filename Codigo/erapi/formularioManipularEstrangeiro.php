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
	require_once("simplex/utils.php");

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
	if(!file_exists($foto)) {
		$foto = "imagens/default.png";
	}

	// -------------------------------------------------------------------------
	// Analisa permissão, monta o action e monta combobox para seleção de atuação/departamento/curso

	$action="";
	$action="index.php?page=scriptManipularEstrangeiro&";

	$comboAtuacao = "";
	$comboDepartamento = "";
	$comboCurso = "";
	$departamentos = R::findAll('departamento', 'excluido=0'); //find departamento id=0
	$cursos = R::findAll('curso', 'excluido=0'); //find curso id=0

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
		$comboDepartamento .= "<option id=\"opcao_departamento\" value=\"\" selected></option>";
		foreach($departamentos as $departamento) {
			$comboDepartamento .= "<option id=\"opcao_departamento_$departamento->id\" value=\"$departamento->id\">$departamento->nome</option>";
		}
		// Monta combobox de curso para cadastro
		$comboCurso .= "<option id=\"opcao_curso\" value=\"\" selected></option>";
		foreach($cursos as $curso) {
			$comboCurso .= "<option id=\"opcao_curso_$curso->id\" value=\"$curso->id\">$curso->nome</option>";
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
			$comboDepartamento .= "<option id=\"opcao_departamento_$departamento->id\" value=\"$departamento->id\" $selected>$departamento->nome</option>";
		}
		// Monta combobox de curso para edição/exclusão/visualização
		foreach($cursos as $curso) {
			$selected = $estrangeiro->curso != $curso->id ? "" : "selected";
			$comboCurso .= "<option id=\"opcao_curso_$curso->id\" value=\"$curso->id\" $selected>$curso->nome</option>";
		}
	}
?>

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
		<table>
			<tbody class="tbody_estrangeiro">
				<tr>
					<td>
						<img src="<?php echo($foto);?>"  height="192" width="192">
					</td>
				</tr>
				<tr>
					<td>
						<label for="foto">Alterar foto</label>
					</td>
					<td>
						<input id="foto" name="foto" type="file">
						<span id='register-form_foto_errorloc' class='erro_validacao'></span>
					</td>
				</tr>
				<tr>
					<td>
						<label for="nome">Nome completo*</label>
					</td>
					<td>
						<input type="text" name="nome" value="<?php echo ($estrangeiro->nome); ?>" size="64" required>
					</td>
				</tr>
				<tr>
					<td>
						<label for="email">E-mail*</label>
					</td>
					<td>
						<input type="email" name="email" value="<?php echo ($estrangeiro->email); ?>" size="64" required>
						<span id='register-form_email_errorloc' class='erro_validacao'></span>
					</td>
				</tr>
				<tr>
					<td>
						<label for="passaporte">Passaporte*</label>
					</td>
					<td>
						<input type="text" name="passaporte" value="<?php echo ($estrangeiro->passaporte); ?>" size="64" required>
					</td>
				</tr>
				<tr>
					<td>
						<label for="rne">RNE</label>
					</td>
					<td>
						<input type="text" name="rne" value="<?php echo ($estrangeiro->rne); ?>" size="64">
					</td>
				</tr>
				<tr>
					<td>
						<label for="curso">Atuação*</label>
					</td>
					<td>
						<select name="curso" required>
							<?php
								echo($comboAtuacao);
							?>
						</select>
					</td>
				</tr>
			<!--TODO OPERAÇÃO AO SELECIONAR "OUTROS"////OLHAR RELATORIO DO CAIK -->
				<tr>
					<td>
						<label for="curso">Curso</label>
					</td>
					<td>
						<select name="curso">
							<?php
								echo($comboCurso);
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="pais">País de origem*</label>
					</td>
					<td>
						<input type="text" name="pais" value="<?php echo($estrangeiro->pais);?>" size="64" required>
					</td>
				</tr>

				<tr>
					<td>
						<label for="instituicao">Instituição de origem*</label>
					</td>
					<td>
						<input type="text" name="instituicao" value="<?php echo($estrangeiro->instituicao);?>" size="64" required>
					</td>
				</tr>

				<tr>
					<td>
						<label for="docente">Docente responsável no IBILCE*</label>
					</td>
					<td>
						<input type="text" name="docente" value="<?php echo($estrangeiro->docente);?>" size="64" required>
					</td>
				</tr>

				<tr>
					<td>
						<label for="email_docente">E-mail do docente responsável no IBILCE*</label>
					</td>
					<td>
						<input type="email" name="email_docente" value="<?php echo($estrangeiro->email_docente);?>" size="64" required>
						<span id='register-form_docente_errorloc' class='erro_validacao'></span>
					</td>
				</tr>

				<tr>
					<td>
						<label for="departamento">Departamento do docente*</label>
					</td>
					<td>
						<select name="departamento" required>
							<?php
								echo($comboDepartamento);
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="atividade">Atividade a ser desenvolvida*</label>
					</td>
					<td>
						<textarea name="atividade"  rows="7" cols="60" required><?php echo($estrangeiro->atividade);?></textarea>
					</td>
				</tr>

				<tr>
					<td>
						<label>Data de chegada*</label>
					</td>
					<td>
						<input ondrop="return false;" type="text" name="ano" id="inicio" size="10" maxlength="10" value="<?php echo(dtPadrao($estrangeiro->data_chegada)); ?>" required readonly>
					</td>
				</tr>

				<tr>
					<td>
						<label>Data de saída*</label>
					</td>
					<td>
						<input ondrop="return false;" type="text" name="ano" id="fim" size="10" maxlength="10" value="<?php echo(dtPadrao($estrangeiro->data_saida)); ?>" required readonly>
					</td>
				</tr>

				<div class="barraBotoes">
					<?php
					$checkboxValidado = "";
					$botoes="";
					$botaoSalvar = "<td><button id=\"btn_salvar\">Salvar</button></td>";
					$botaoExcluir = "";

					if($isUsuario || $isAdmin){
						$validado = $estrangeiro->validado==1 ? "checked" : "";
						$checkboxValidado = "<tr><td><label for=\"validado\">Validado</label></td><td><input type=\"checkbox\" id=\"validado\ name=\"validado\" $validado></input></td></tr>";

						if($id > 0 ) {
							$botaoExcluir = "<td><button id=\"btn_excluir\" onclick='window.location=\"index.php?page=scriptManipularEstrangeiro&modo=excluir&id=$id\"; return false;'>Excluir</button></td>";
						}
					}

					echo $checkboxValidado;
					echo("<tr>".$botaoSalvar.$botaoExcluir."</tr>");
					?>
				</div>
			</tbody>
		</table>
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
