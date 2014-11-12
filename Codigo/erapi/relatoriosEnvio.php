<?php
	/* Autor: Carlos Henrique Severino (Caik)
 	 * Essa página é responsável pela consulta no banco de dados
 	 * e geração do HTML que será mostrado como resultado na página de relatórios
 	 * 
 	 */

	date_default_timezone_set('America/Sao_Paulo');
	require("rb/db.php");
	require("simplex/utils.php");
	rbSetup();
	$sql_atuacao = '';
	$sql_curso = '';
	$sql_dep = '';
	$sql_ano = '';
	$sql_final = '';
	$atuacao_alone = $_POST['atuacao_alone'];
	$atuacao_outros = $_POST['atuacao_outros'];
	$ano_inicio = $_POST['inicio'];
	$ano_fim =  $_POST['fim'];
	if($ano_inicio != '')
		$ano_inicio = preg_replace("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", "$3-$2-$1", $ano_inicio);
	if($ano_fim != '')
	{
		$ano_fim = preg_replace("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", "$3-$2-$1", $ano_fim);
	}
	if($_POST['atuacao'] != '')
		$sql_atuacao .= '(';
	$sql_atuacao .= preg_replace("/(atuacao=[0-5])(&)/", "$1 OR ", $_POST['atuacao']);
	if($atuacao_alone == 'true')
	{
		if($atuacao_outros != '')
		{
			if($sql_atuacao != '')
				$sql_atuacao .= ' OR ';
			$sql_atuacao .= "atuacao_outros LIKE '%" . $atuacao_outros . "%' OR atuacao_outros LIKE '%" . strtolower($atuacao_outros) . "%'";
		}
		else
		{
			if($sql_atuacao != '')
				$sql_atuacao .= ' OR ';
			$sql_atuacao .= "atuacao=0";
		}
	}
	if($sql_atuacao != '')
		$sql_atuacao .= ')';
	if($sql_atuacao != '')
		$sql_final .= $sql_atuacao;
		
	if($_POST['curso'] != '')
		$sql_curso .= '(';
	$sql_curso .= preg_replace("/(curso=[0-9]+)(&)/", "$1 OR ", $_POST['curso']);
	if($sql_curso != '')
		$sql_curso .= ')';
	if($sql_curso != '')
	{
		if($sql_final == '')
			$sql_final .= $sql_curso;
		else
			$sql_final .= " AND $sql_curso";
	}
	
	if($_POST['dep'] != '')
		$sql_dep .= '(';
	$sql_dep .= preg_replace("/(departamento=[0-9]+)(&)/", "$1 OR ", $_POST['dep']);
	if($sql_dep != '')
		$sql_dep .= ')';
	if($sql_dep != '')
	{
		if($sql_final == '')
			$sql_final .= $sql_dep;
		else
			$sql_final .= " AND $sql_dep";
	}
	if(($ano_inicio != '') || ($ano_fim != ''))
		$sql_ano .= '(';
		
	if(($ano_inicio != '') && ($ano_fim != ''))
	{
		if($ano_inicio == $ano_fim)
			$sql_ano .= "data_chegada = '$ano_inicio'";
		else
			$sql_ano .= "data_chegada >= '$ano_inicio' AND data_chegada <= '$ano_fim'";
	}
	else
	{	
		if($ano_inicio != '')
			$sql_ano .= "data_chegada >= '$ano_inicio'";
		else
		{
			if($ano_fim != '')
				$sql_ano .= "data_chegada <= '$ano_fim'";
		}
	}
	if($sql_ano != '')
		$sql_ano .= ')';
	if($sql_ano != '')
	{
		if($sql_final == '')
			$sql_final .= $sql_ano;
		else
			$sql_final .= " AND $sql_ano";
	}
?>
<table class="tablesorter tabela">
	<thead>
		<tr><th>Nome</th><th>País de origem</th><th>Modalidade</th><th>Curso</th><th>Status</th><th colspan="3">Período</th></tr>
	</thead>
	<tbody class="tbody_alternada">
		<?php
		$tipos = array(
			1 => "Graduação",
			2 => "Mestrado",
			3 => "Especialização",
			4 => "Doutorado",
			5 => "Pós-Doutorado"
		);

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
			echo ("<tr><td><a href='index.php?page=formularioRelatoriosEstrangeiro&id=$id' target=\"_blank\">$nome</a></td><td>$pais</td><td>$modalidade</td><td>$nome_curso</td><td>$status</td><td class=\"data_tabela data_tabela_esquerda\">$data_chegada</td><td class=\"data_tabela\">-&emsp;</td><td class=\"data_tabela\">$data_saida</td></tr>\n");
		}		
		?>
	</tbody>
	<tfoot>
		<tr><td colspan="8">Foram encontrados <?php echo (R::count('estrangeiro',"$sql_final")); ?> registros</td></tr>
	</tfoot>
</table>
