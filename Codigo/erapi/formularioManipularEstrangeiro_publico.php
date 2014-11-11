<?php

	/* Autor: Victor Hugo Cândido de Oliveira
	 * Formulário público para cadastrar
	 * os estrangeiros.
	 * Essa página faz:
	 *		Cadastro.
	 * 
	 */

	require_once("curso.php");

	// -------------------------------------------------------------------------
	// Monta combobox para seleção de atuação/departamento/curso

	$comboAtuacao = "";
	$comboDepartamento = "";
	$comboCurso = "";
	$departamentos = R::findAll('departamento', 'excluido=0'); //find departamento id=0
	$cursos = R::findAll('curso', 'excluido=0'); //find curso id=0

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
	<p class="titulo">Cadastrar novo estrangeiro</p>
</div>

<div id="wrapper">
	<form action="index.php?page=scriptManipularEstrangeiro&modo=cadastrar" method="post" id="register-form" enctype="multipart/form-data">
		<p>
			<img src="imagens/default.png"  height="192" width="192">
		</p>
		<p>
			<label for="foto">Alterar foto</label>
			<input id="foto" name="foto" type="file">
			<span id='register-form_foto_errorloc' class='erro_validacao'></span>
		</p>
		<p>
			<label for="nome">Nome completo*</label>
			<input type="text" name="nome" size="64" required>
		</p>
		<p>
			<label for="email">E-mail*</label>
			<input type="email" name="email" size="64" required>
			<span id='register-form_email_errorloc' class='erro_validacao'></span>
		</p>
		<p>
			<label for="passaporte">Passaporte*</label>
			<input type="text" name="passaporte" size="64" required>
		</p>
		<p>
			<label for="rne">RNE</label>
			<input type="text" name="rne" size="64">
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
			<label for="curso">Curso</label>
			<select name="curso">
				<?php
					echo($comboCurso);
				?>
			</select>
		</p>
		<p>
			<label for="pais">País de origem*</label>
			<input type="text" name="pais" size="64" required>
		</p>

		<p>
			<label for="instituicao">Instituição de origem*</label>
			<input type="text" name="instituicao" size="64" required>
		</p>

		<p>
			<label for="docente">Docente responsável no IBILCE*</label>
			<input type="text" name="docente" size="64" required>
		</p>

		<p>
			<label for="email_docente">E-mail do docente responsável no IBILCE*</label>
			<input type="email" name="email_docente" size="64" required>
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
			<textarea name="atividade"  rows="7" cols="60" required></textarea>
		</p>

		<p>
			<label>Data de chegada*</label>
			<input ondrop="return false;" type="text" name="ano" id="inicio" size="10" maxlength="10" required readonly>
		</p>

		<p>
			<label>Data de saída*</label>
			<input ondrop="return false;" type="text" name="ano" id="fim" size="10" maxlength="10" required readonly>
		</p>

		<div class="barraBotoes">
			<button id="btn_salvar">Enviar cadastro</button>
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