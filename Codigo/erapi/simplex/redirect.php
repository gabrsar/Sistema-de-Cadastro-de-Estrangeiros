<?php

/* Autor: Gabriel Henrique Martinez Saraiva
 * Data: 11/09/2014
 *
 * Página de controle de links.
 *
 * Com base na variavel $_GET['page'] retorna a página a ser importada na index com o conteúdo a ser exibido.
 */	

function obterPagina() {

	$links = array(
		// FIXME - Remover isso.
		"fake"								=>		"fakeUsers.php",

		"login"								=>		"login.php",
		"scriptLogin"						=>		"scriptLogin.php",
		"inicio" 							=> 		"inicio.php",

		"erro"								=>		"erro.php",
		"sucesso"							=>		"sucesso.php",

		// Página Inicial
		"fichas"		 					=> 		"formularioFichas.php",
		"relatorios"	 					=> 		"formularioRelatorios.php",
		"configuracoes" 					=> 		"formularioConfiguracoes.php",
		
		// Relatórios
		"relatoriosAlunoTempo"		 		=> 		"relatorioAlunoTempo.php",
		"relatoriosPessoaDepartamento"	 	=> 		"relatorioPessoaDepartamento.php",
		"relatoriosPessoaPais" 				=> 		"relatorioPessoaPais.php",
		"relatoriosPersonalizado" 			=> 		"relatorioPersonalizados.php",

		// Configurações
		"configuracoesDepartamentos"		=> 		"formularioDepartamento.php",
		"configuracoesCursos" 				=> 		"formularioCursos.php",
		"configuracoesUsuarios" 			=> 		"formularioUsuarios.php",

		// Departamentos
		"scriptManipularDepartamento"		=>		"scriptManipularDepartamento.php",
		"manipularDepartamento"				=>		"formularioManipularDepartamento.php",

		// Cursos
		"scriptManipularCurso"				=>		"scriptManipularCurso.php",
		"manipularCurso"					=>		"formularioManipularCurso.php"
	);

	$ret="";
	$page="inicio";
	
	// Testa se a variavel de página está definida. Se não estiver abre a página de inicio.
	if(isset($_GET['page']))
	{
		if(isset($links[$page]))
		{
			$page=$_GET['page'];	
		}
	}
	return $links[$page];
}
?>
