 <?php
	/* Autor: Carlos Henrique Severino (Caik)
 	 * Aqui é definido a estrutura onde os dados de um estrangeiro é mostrado
 	 * quando selecionado seu nome na página de relatórios
 	 * 
 	 */
	require_once("simplex/utils.php");

	$id=-1;
	if(isset($_GET['id']))
	{	
		$id = intval($_GET['id']);
		if($id < 0)
		{
			erro("Parâmetro inválido!","index.php?page=relatorios");
		}
	}
	$tipos = array(
		1 => "Graduação",
		2 => "Mestrado",
		3 => "Especialização",
		4 => "Doutorado",
		5 => "Pós-Doutorado"
	);

	$value = R::load('estrangeiro', "$id");
	$foto = $value->foto;
	$nome = $value->nome;
	$email = $value->email;
	$passaporte = $value->passaport;
	$rne = $value->rne;
	if($value->atuacao != 0)
		$modalidade = $tipos[$value->atuacao];
	else
		$modalidade = $value->atuacao_outros;
	$pais = $value->pais;
	$instituicao = $value->instituicao;
	$docente = $value->docente;
	$email_docente = $value->email_docente;
	$atividade = $value->atividade;
	$data_chegada = dtPadrao($value->data_chegada);
	$data_saida = dtPadrao($value->data_saida);
	$validado = '';
	$usuario_validador = '';
	if($value->validado != 0)
	{
		$validado = "Sim";
		$usuario = R::load('usuario', "$value->usuario_validador");
		$usuario_validador = $usuario->nome;
	}
	else
		$validado = "Não";
	$departamento = R::load('departamento', "$value->departamento");
	$dep = $departamento->nome;
	$curso_aux = R::load('curso', "$value->curso");
	$curso = $curso_aux->nome;
?>

<div id="titulo" class="center">
	<!-- Vou deixar comentado aqui, vai que mudo de idéia depois, sei lá, mas por enquanto vai ficar sem botão de volta-->
	<!--<a href="index.php?page=relatorios" class="voltar" id="back_button">&lt&lt</a>-->
	<p class="titulo">Dados: <?php echo "<tag class=\"titulo_estrangeiro\">$value->nome</tag>"?></p>
</div>

<div id="container_formulario_estrangeiro">
	<table>
		<tbody>
			<tr><td rowspan="5" class="coluna_1" id="foto_form_estrangeiro"><img ondragstart="return false" src="<?php echo $foto;?>" alt="" title=""/></td><td><b>Nome: </b></td><td><?php echo $nome;?></td></tr>
			<tr><td class="coluna_1"><b>E-mail: </b></td><td><?php echo $email;?></td></tr>
			<tr><td class="coluna_1"><b>País: </b></td><td><?php echo $pais;?></td></tr>
			<tr><td class="coluna_1"><b>Modalidade: </b></td><td><?php echo $modalidade;?></td></tr>
			<tr><td class="coluna_1"><b>Instituição: </b></td><td><?php echo $instituicao;?></td></tr>
			<tr><td class="coluna_1"><b>Passaporte: </b></td><td colspan="2"><?php echo $passaporte;?></td></tr>
			<tr><td class="coluna_1"><b>RNE: </b></td><td colspan="2"><?php echo $rne;?></td></tr>
			<tr><td class="coluna_1"><b>Docente responsável: </b></td><td colspan="2"><?php echo $docente;?></td></tr>
			<tr><td class="coluna_1"><b>E-mail docente responsável: </b></td><td colspan="2"><?php echo $email_docente;?></td></tr>
			<tr><td class="coluna_1"><b>Departamento vinculado: </b></td><td colspan="2"><?php echo $dep;?></td></tr>
			<tr><td class="coluna_1"><b>Curso vinculado: </b></td><td colspan="2"><?php echo $curso;?></td></tr>
			<tr><td class="coluna_1"><b>Data de chegada: </b></td><td colspan="2"><?php echo $data_chegada;?></td></tr>
			<tr><td class="coluna_1"><b>Data de saída: </b></td><td colspan="2"><?php echo $data_saida;?></td></tr>
			<tr><td class="coluna_1"><b>Validado: </b></td><td colspan="2"><?php echo $validado;?></td></tr>
			<?php 
				if($validado == "Sim")
					echo ("<tr><td class=\"coluna_1\"><b>Usuário validador: </b></td><td colspan=\"2\">$usuario_validador</td></tr>");
			?>
			
			<tr><td colspan="3" class="tr_center"><b>Atividade a ser desenvolvida: </b></td></tr>
			<tr><td colspan="3"><?php echo $atividade;?></td></tr>
		</tbody>
	</table>
</div>
