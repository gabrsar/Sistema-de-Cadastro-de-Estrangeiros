<!DOCTYPE html>
<?php
	/* Autor: Victor Hugo Cândido de Oliveira
	 * Formulário público para cadastrar
	 * os estrangeiros.
	 * Essa página faz:
	 *		Cadastro.
	 * 
	 */

	header('Content-Type: text/html; charset=utf-8');
	require_once("rb/db.php");
	require_once("simplex/utils.php");
	require_once("simplex/sanitize.php");
	require_once("curso.php");
	require_once("atuacao.php");

	// Configura e inicia o RedBean
	rbSetup();

	// -------------------------------------------------------------------------
	// Monta combobox para seleção de atuação/departamento/curso

	$comboAtuacao = "";
	$comboDepartamento = "";
	$comboCurso = "";
	$departamentos = R::findAll('departamento', 'excluido=0'); //find departamento id=0
	$cursos = R::findAll('curso', 'excluido=0'); //find curso id=0

	// Monta combobox de atuação para cadastro
	$comboAtuacao .= "<option id=\"opcao_atuacao\" selected></option>";
	foreach(Atuacao::getListaAtuacoes() as $tipo) {
		$comboAtuacao .= "<option id=\"opcao_atuacao_$tipo[0]\" value=\"$tipo[0]\">$tipo[1]</option>";
	}
	// Monta combobox de departamento para cadastro
	$comboDepartamento .= "<option id=\"opcao_departamento\" selected></option>";
	foreach($departamentos as $departamento) {
		$comboDepartamento .= "<option id=\"opcao_departamento_$departamento->id\" value=\"$departamento->id\">$departamento->nome</option>";
	}
	// Monta combobox de curso para cadastro
	$comboCurso .= "<option id=\"opcao_curso\" selected></option>";
	foreach($cursos as $curso) {
		$comboCurso .= "<option id=\"opcao_curso_$curso->id\" value=\"$curso->id\">$curso->nome</option>";
	}
?>



<html lang="pt_BR">

	<head>
		<title>Sistema de Controle de Estrangeiros</title>

		<!-- Meta tags -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<!-- Temas CSS -->
		<link href="temas/tema.css" rel="stylesheet" type="text/css" />
		<link href="temas/jquery-ui.min.css" rel="stylesheet" type="text/css" />
		<link href="temas/jquery-ui.structure.min.css" rel="stylesheet" type="text/css" />
		<link href="temas/jquery-ui.theme.min.css" rel="stylesheet" type="text/css" />

		<!-- JQUERY -->
		<script src="js/jquery-latest.js"></script>
		<script src="js/scriptRodape.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/gen_validatorv4.js"></script>
	</head>

	<body>
		<script>
		$(function() {
			var dp = {
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
			};
			$( "#chegada" ).datepicker(dp);
			$( "#saida" ).datepicker(dp);
		});
		</script>
		<div id="topo">
			<a href=""><h1>Sistema de Controle de Estrangeiros</h1></a>
		</div>

		<div id="corpo">
			<div id="titulo">
				<p class="titulo">Cadastrar novo estrangeiro</p>
			</div>

			<div id="wrapper">
				<form action="index.php?page=scriptManipularEstrangeiro&modo=cadastrar" method="post" id="register-form" enctype="multipart/form-data">

					<table>
						<tbody class="tbody_estrangeiro">
							<tr>
								<td>
									<img class='img_estrangeiro' src="imagens/default.png">
								</td>
								<td>
									<input id="foto" name="foto" type="file">
								</td>
							</tr>
							<tr>
								<td>
									<label for="nome">Nome completo*</label>
								</td>
								<td>
									<input type="text" name="nome" size="64" required>
								</td>
							</tr>
							<tr>
								<td>
									<label for="email">E-mail*</label>
								</td>
								<td>
									<input type="email" name="email" size="64" required>
									<div id='register-form_email_errorloc' class='erro_validacao'></div>
								</td>
							</tr>
							<tr>
								<td>
									<label for="passaporte">Passaporte*</label>
								</td>
								<td>
									<input type="text" name="passaporte" size="64" required>
								</td>
							</tr>
							<tr>
								<td>
									<label for="rne">RNE</label>
								</td>
								<td>
									<input type="text" name="rne" size="64">
								</td>
							</tr>
							<tr>
								<td>
									<label for="atuacao">Atuação*</label>
								</td>
								<td>
									<select id="atuacao" name="atuacao" required>
										<?php
											echo($comboAtuacao);
										?>
									</select>
									<div id="atuacao_outro">										
										<input type="text" name="atuacao_outro" size="30"></input>
										<div id='register-form_atuacao_outro_errorloc' class='erro_validacao'></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<label for="curso">Curso*</label>
								</td>
								<td>
									<select name="curso" required>
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
									<input type="text" name="pais" size="64" required>
								</td>
							</tr>

							<tr>
								<td>
									<label for="instituicao">Instituição de origem*</label>
								</td>
								<td>
									<input type="text" name="instituicao" size="64" required>
								</td>
							</tr>

							<tr>
								<td>
									<label for="docente">Docente responsável no IBILCE*</label>
								</td>
								<td>
									<input type="text" name="docente" size="64" required>
								</td>
							</tr>

							<tr>
								<td>
									<label for="email_docente">E-mail do docente responsável no IBILCE*</label>
								</td>
								<td>
									<input type="email" name="email_docente" size="64" required>
									<div id='register-form_email_docente_errorloc' class='erro_validacao'></div>
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
									<textarea name="atividade"  rows="7" cols="60" required></textarea>
								</td>
							</tr>

							<tr>
								<td>
									<label for="data_chegada">Data de chegada*</label>
								</td>
								<td>
									<input ondrop="return false;" type="text" name="data_chegada" id="chegada" size="10" maxlength="10" required readonly>
									<div id='register-form_data_chegada_errorloc' class='erro_validacao'></div>
								</td>
							</tr>

							<tr>
								<td>
									<label for="data_saida">Data de saída*</label>
								</td>
								<td>
									<input ondrop="return false;" type="text" name="data_saida" id="saida" size="10" maxlength="10" required readonly>
									<div id='register-form_data_saida_errorloc' class='erro_validacao'></div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="barraBotoes">
										<button id="btn_salvar">Enviar cadastro</button>
									</div>
								</td>
								<td id='register-form_errorloc' class='error_strings'></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
		<script type='text/javascript'>
			var frmvalidator  = new Validator("register-form");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();
			
			frmvalidator.addValidation("data_saida","req","Digite uma data de saída");
			frmvalidator.addValidation("data_chegada","req","Digite uma data de chegada");

			frmvalidator.addValidation("email_docente","email","Digite um email válido");

			frmvalidator.addValidation("atuacao_outro", "req", "Digite a atuação", "VWZ_IsListItemSelected(document.forms['register-form'].elements['atuacao'],'7')");

			frmvalidator.addValidation("email","email","Digite um email válido");
		</script>
		<script type="text/javascript" src="js/scriptSelectOutro.js"></script>
		<script type="text/javascript" src="js/scriptValidaImagem.js"></script>

		<div id="rodape">
			<p> Sistema de Controle de Estrangeiros - ERAPI - STAEPE </p>
		</div>
	</body>
</html>
