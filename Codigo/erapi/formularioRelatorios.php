<?php
	/* Autor: Carlos Henrique Severino (Caik)
 	 * Essa pagina define as opções que o usuário tem para gerar um relatório
 	 * e reserva um espaço (div container_relatorios) onde sera posteriormente gerado um HTML
 	 * por meio de uma requisição AJAX
 	 * 
 	 */
?>
<script>
    var b = document.documentElement;
      b.setAttribute('data-useragent',  navigator.userAgent);
      b.setAttribute('data-platform', navigator.platform );
      b.className += ((!!('ontouchstart' in window) || !!('onmsgesturechange' in window))?' touch':'');
</script>
<div id="titulo">
	<a href="index.php?page=inicio" class="voltar">&lt&lt</a>
	<p class="titulo">Relatórios</p>
</div>

<div id="container_formulario_relatorios">
	<form id="formulario_relatorios" method="post" action="">
		<div id="formulario_superior">
			<fieldset id="fieldset_modalidade">
				<legend><h2>Modalidade </h2></legend>
				<div id="form_modalidade">
					<p><input type="checkbox" name="atuacao" id="atuacao1" value="1"> Graduação</p>
					<p><input type="checkbox" name="atuacao" id="atuacao2" value="2"> Mestrado</p>
					<p><input type="checkbox" name="atuacao" id="atuacao3" value="3"> Especialização</p>
					<p><input type="checkbox" name="atuacao" id="atuacao4" value="4"> Doutorado</p>
					<p><input type="checkbox" name="atuacao" id="atuacao5" value="5"> Pós-Doutorado</p>
					<p><input type="checkbox" name="atuacao0" id="atuacao0" value="0"> Outro</p>
					<p><input type="text" name="atuacao_outros" id="atuacao7" size="30" class="invisivel"></p>
				</div>
			</fieldset>
			<fieldset id="fieldset_curso">
				<legend id="legend_curso"><h2>Curso </h2></legend>
				<div id="form_curso" class="check-select-multiple">
					<?php 
						$cursos = R::find('curso','excluido=0');
						foreach($cursos as $curso)
						{
							echo ("<p><input type=\"checkbox\" name=\"curso\" value=\"$curso->id\" id=\"curso$curso->id\"> $curso->nome</p>");
						}
					?>
				</div>
				
			</fieldset>
		</div>
		<div id="formulario_meio">
			<fieldset id="fieldset_dep">
				<legend id="legend_departamento"><h2>Departamento </h2></legend>
				<div id="form_dep" class="check-select-multiple">
					<?php 
						$departamentos = R::find('departamento','excluido=0');
						foreach($departamentos as $dep)
						{
							echo ("<p><input type=\"checkbox\" name=\"departamento\" value=\"$dep->id\" id=\"dep$dep->id\"> $dep->nome</p>");
						}
					?>
				</div>
			</fieldset>
			<fieldset id="fieldset_periodo">
				<legend id="legend_periodo"><h2>Período </h2></legend>
				<p id="periodo_first_child">Início: <input type="text" name="ano" id="inicio" size="4" maxlength="4"></p>
				<p id="periodo_second_child">Fim: <input type="text" name="ano" id="fim" size="4" maxlength="4"></p>
			</fieldset>
		</div>
		<div id="formulario_inferior">
			<input type="reset" name="limpar" id="limpar" value="Limpar campos" />
			<input type="submit" name="enviar" id="enviar" value="Criar relatório" />
		</div>
		
	</form>	
</div>

<div id="container_relatorios" class="listagem"></div> 
