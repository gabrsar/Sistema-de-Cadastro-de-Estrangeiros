<script>
function confirmarRemoverDepartamento(nome,id)
{
	var remover = confirm("Deseja remover o departamento " + nome +"?");
	if(remover == true )
	{
        window.location="scriptRemoverDepartamento.php?id="+id;
	}   
}
</script>

<div>
	<p> Departamentos Cadastrados </p>
	<table>
		<thead>
			<tr><td>Nome</td></tr>
		</thead>
		<tbody>
			<?php

			$departamentos = R::findAll('departamento');

			foreach ($departamentos as $dep) {

				$id=$dep->id;
				$nome=$dep->nome;
				$link="confirmarRemoverDepartamento(\"$nome\",$id)";

				echo ("<tr><td>$nome</td><td>
				<button type='button' onclick='$link'>
					Remover 
				</button> </td></tr>\n");
			}
			?>
		</tbody>
		<tfoot>
			<tr><td>Foram encontrados 
				<?php echo (R::count('departamento')); ?>
			registros</td></tr>
		</tfoot>
	</table>
</div>

<div>
	<p> Cadastrar novo departamento </p>
	<form action="index.php?page=scriptCadastrarDepartamento" method="post">
		<input type="text" name="nome" />
		<input type="submit" value="Cadastrar!" />
	</form>
</div>
