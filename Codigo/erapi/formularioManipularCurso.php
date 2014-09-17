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
		// No caso de cadastro essa variavel é "inútil", mas ela simplifica a 
		// programação, pois o conteúdo dela é vazio. Assim evita um monte de 
		// ifs no meio dos htmls.
		$curso = R::dispense('curso');	
	}
	else
	{
		$curso = R::load('curso',$id);
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
		echo ("Editar '$curso->nome'");
	}
?>
	</p> 
</div> 

  

	<?php

		$action="index.php?page=scriptManipularCurso&";

		if($id == -1)
		{
			$action.="modo=cadastrar";
		}
		else
		{
			$action.="modo=editar&id=$id";
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
			<button>Salvar</button>

			<!-- Recurso técnico provisório de longo prazo -->
			<button 
				onclick='
					window.location="index.php?page=scriptManipularCurso&modo=excluir&id=<?php echo($id);?>";
					return false;
				'
				<?php if($id==-1) echo ("class='invisivel'"); ?>
			>Excluir</button>
			<!-- Fim do recurso técnico provisório de longo prazo -->

		</div>
	</form>
</div>
