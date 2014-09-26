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
			<p><input type="checkbox" name="modalidade3" id="modalidade3" value="Doutorado"> Doutorado</p>
			<p><input type="checkbox" name="modalidade4" id="modalidade4" value="Pós-Doutorado"> Pós-Doutorado</p>
			<p><input type="checkbox" name="modalidade5" id="modalidade5" value="Palestrante"> Palestrante</p>
			<p><input type="checkbox" name="modalidade6" id="modalidade6" value="Outro"> Outro</p>
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
			<input type="reset" name="limpar" value="Limpar campos" />
			<input type="submit" name="enviar" value="Criar relatório" />
		
	</form>	
</div>

<div id="container_relatorios" class="listagem">
	<table>
		<thead>
			<tr><td>Nome</td><td>País de origem</td><td>Modalidade</td><td>Curso</td><td>Status</td><td>Período</td></tr>
		</thead>
		<tbody>           
			<?php echo ("<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>\n"); ?>
			<?php echo ("<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td></tr>\n"); ?>
		</tbody>
		<tfoot>
			<tr><td colspan="6">Foram encontrados 
				<?php echo (R::count('curso','excluido=0')); ?>
			registros</td></tr>
		</tfoot>
	</table>
</div> 
