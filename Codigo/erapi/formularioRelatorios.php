<?php
	/* Autor: Carlos Henrique Severino (Caik)
 	 * Essa pagina define as opções que o usuário tem para gerar um relatório
 	 * e reserva um espaço (div container_relatorios) onde sera posteriormente gerado um HTML
 	 * por meio de uma requisição AJAX
 	 * 
 	 */
?>

<div id="titulo">
	<a href="index.php?page=inicio" class="voltar">&lt&lt</a>
	<p class="titulo">Relatórios</p>
</div>

<div id="container_formulario_relatorios">
	<form id="formulario_relatorios" method="post" action="">
		<fieldset>
			<legend><h2>Modalidade </h2></legend>
			<p><input type="checkbox" name="modalidade1" id="modalidade1" value="Graduação"> Graduação</p>
			<p><input type="checkbox" name="modalidade2" id="modalidade2" value="Mestrado"> Mestrado</p>
			<p><input type="checkbox" name="modalidade3" id="modalidade3" value="Especialização"> Especialização</p>
			<p><input type="checkbox" name="modalidade4" id="modalidade4" value="Doutorado"> Doutorado</p>
			<p><input type="checkbox" name="modalidade5" id="modalidade5" value="Pós-Doutorado"> Pós-Doutorado</p>
			<p><input type="checkbox" name="modalidade0" id="modalidade0" value="Outro"> Outro</p>
			<p><input type="text" name="modalidade7" id="modalidade7" size="30" class="invisivel"></p>
		</fieldset>
		<fieldset>
			<legend><h2>Curso </h2></legend>
			<p><input type="text" name="curso" id="curso" size="20"></p>
		</fieldset>
		<fieldset>
			<legend><h2>Departamento </h2></legend>
			<p><input type="text" name="departamento" id="departamento" size="20"></p>
		</fieldset>
		<fieldset>
			<legend><h2>Ano </h2></legend>
			<p><input type="text" name="ano" id="ano" size="4" maxlength="4"></p>
		</fieldset>
			<input type="reset" name="limpar" id="limpar" value="Limpar campos" />
			<input type="submit" name="enviar" id="enviar" value="Criar relatório" />
		
	</form>	
</div>

<div id="container_relatorios" class="listagem"></div> 
