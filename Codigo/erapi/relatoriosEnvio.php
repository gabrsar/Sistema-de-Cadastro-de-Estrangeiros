<?php
	/* Autor: Carlos Henrique Severino (Caik)
 	 * Essa página é responsável pela consulta no banco de dados
 	 * e geração do HTML que será mostrado como resultado na página de relatórios
 	 * 
 	 */

	require("rb/db.php");
	rbSetup();
	$dados = array(
		1 => $_POST['mod1'],
		2 => $_POST['mod2'],
		3 => $_POST['mod3'],
		4 => $_POST['mod4'],
		5 => $_POST['mod5'],
		0 => $_POST['mod0'],
		'outro' => $_POST['outro'],
		'curso' => $_POST['curso'],
		'dep' => $_POST['dep'],
		'ano' => $_POST['ano']
	);
	$sql_atuacao = '';
	$sql_curso = '';
	$sql_dep = '';
	$sql_ano = '';
	$sql_final = '';
	$aux = 0;
	for($i = 1; $i <=5; $i++)
	{
		if($dados[$i] == 'true')
		{
			if($aux == 0)
				$sql_atuacao .= "(atuacao=" . $i . ' ';
			else
				$sql_atuacao .= 'OR atuacao=' . $i . ' ';
			$aux = 1;
		}
	}
	if($dados[0] == 'true')
	{
		if($aux == 0)
			$sql_atuacao .= "(atuacao_outros LIKE '%" . $dados['outro'] . "%' OR atuacao_outros LIKE '%" . strtolower($dados['outro']) . "%'";
		else
			$sql_atuacao .= " OR atuacao_outros LIKE '%" . $dados['outro'] . "%' OR atuacao_outros LIKE '%" . strtolower($dados['outro']) . "%'";
		$aux = 1;
	}
	if($sql_atuacao != '')
		$sql_atuacao .= ')';
	$sql_final .= $sql_atuacao;
	//ARRUMAR CURSO, E DEP
	$aux = 0;
	if($dados['curso'] != '')
	{
		$sql_aux = "(nome LIKE '%" . $dados['curso'] . "%' OR nome LIKE '%" . strtolower($dados['curso']) . "%')";
		$cursos_aux = R::find('curso', "$sql_aux");
		foreach($cursos_aux as $value)
		{
			if($aux == 0)
				$sql_curso .= "(curso=" . $value->id . ' ';
			else
				$sql_curso .= 'OR curso=' . $value->id . ' ';
			$aux = 1;
		}
	}
	if($sql_curso != '')
	{
		$sql_curso .= ')';
		if($sql_final == '')
			$sql_final .= $sql_curso;
		else
			$sql_final .= ' AND ' . $sql_curso;
	}
	$aux = 0;
	if($dados['dep'] != '')
	{
		$sql_aux = "(nome LIKE '%" . $dados['dep'] . "%' OR nome LIKE '%" . strtolower($dados['dep']) . "%')";
		$dep_aux = R::find('departamento', "$sql_aux");
		foreach($dep_aux as $value)
		{
			if($aux == 0)
				$sql_dep .= "(departamento=" . $value->id . ' ';
			else
				$sql_dep .= 'OR departamento=' . $value->id . ' ';
			$aux = 1;
		}
	}
	if($sql_dep != '')
	{
		$sql_dep .= ')';
		if($sql_final == '')
			$sql_final .= $sql_dep;
		else
			$sql_final .= ' AND ' . $sql_dep;
	}
	$aux = 0;
	if($dados['ano'] != '')
	{
		if($aux == 0)
			$sql_ano .= "data_chegada LIKE '" . $dados['ano'] . "%'";
		else
			$sql_ano .= " AND data_chegada LIKE '" . $dados['ano'] . "%'";
		$aux = 1;
	}
	if($sql_ano != '')
	{
		if($sql_final == '')
			$sql_final .= $sql_ano;
		else
			$sql_final .= ' AND ' . $sql_ano;
	}
?>
<table>
	<thead>
		<tr><td>Nome</td><td>País de origem</td><td>Modalidade</td><td>Curso</td><td>Status</td><td colspan="3">Período</td></tr>
	</thead>
	<tbody>
		<?php
		$tipos = array(
			1 => "Graduação",
			2 => "Mestrado",
			3 => "Especialização",
			4 => "Doutorado",
			5 => "Pós-Doutorado"
		);
		function dtPadrao($data) 
		{
			$data = trim($data);
			if (strlen($data) < 10)
			{
				$rs = "";
			}
			else
			{
				$arr_data = explode(" ",$data);
				$data_db = $arr_data[0];
				$arr_data = explode("-",$data_db);
				$data_form = $arr_data[2]."/".$arr_data[1]."/".$arr_data[0];
				$rs = $data_form;
			}
			return $rs;
		}
		$estrangeiros = R::find('estrangeiro',"$sql_final");
		foreach ($estrangeiros as $estrangeiro) 
		{
			$id = $estrangeiro->id;
			$nome = $estrangeiro->nome;
			$pais = $estrangeiro->pais;
			if($estrangeiro->atuacao != 0)
				$modalidade = $tipos[$estrangeiro->atuacao];
			else
				$modalidade = $estrangeiro->atuacao_outros;
			$curso = R::load( 'curso', "$estrangeiro->curso");
			$nome_curso = $curso->nome;
			$data_chegada = dtPadrao($estrangeiro->data_chegada);
			$data_saida = dtPadrao($estrangeiro->data_saida);
			$data_atual = new DateTime();
			$data_final = new DateTime($estrangeiro->data_saida);
			if($data_atual > $data_final)
				$status = "Finalizado";
			else
				$status = "Em andamento";
			//$link="confirmarRemoverCurso(\"$nome\",$id)";

			echo ("<tr><td>$nome</td><td>$pais</td><td>$modalidade</td><td>$nome_curso</td><td>$status</td><td class=\"data_tabela data_tabela_esquerda\">$data_chegada</td><td class=\"data_tabela\">-&emsp;</td><td class=\"data_tabela\">$data_saida</td></tr>\n");
		}		
		?>
	</tbody>
	<tfoot>
		<tr><td colspan="8">Foram encontrados <?php echo (R::count('estrangeiro',"$sql_final")); ?> registros</td></tr>
	</tfoot>
</table>
