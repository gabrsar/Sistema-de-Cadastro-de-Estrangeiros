<?php

/* Autor: Gabriel Henrique Martinez Saraiva
 * Data: 11/09/2014
 *
 * Página de controle de links.
 *
 * Com base na variavel $_GET['page'] retorna a página a ser importada na index com o conteúdo a ser exibido.
 */	


/* Lista de todas as possiveis redireções*/


function obterPagina() {

	$LINKS = array(
		"login"								=>		"login.php",
		"scriptLogin"						=>		"scriptLogin.php",
		"scriptSair"						=>		"scriptSair.php",
		
		"inicio" 							=> 		"inicio.php",

		"erro"								=>		"erro.php",
		"sucesso"							=>		"sucesso.php",

		// Página Inicial
		"fichas"		 					=> 		"formularioFichas.php",
		"relatorios"	 					=> 		"formularioRelatorios.php",
		"configuracoes" 					=> 		"formularioConfiguracoes.php",
		"estrangeiros"						=>		"formularioEstrangeiros.php",
		
		//Relatórios
		"formularioRelatoriosEstrangeiro"	=>		"formularioRelatoriosEstrangeiro.php",
		
		// Configurações
		"configuracoesDepartamentos"		=> 		"formularioDepartamento.php",
		"configuracoesCursos" 				=> 		"formularioCursos.php",
		"configuracoesUsuarios" 			=> 		"formularioUsuarios.php",

		// Departamentos
		"scriptManipularDepartamento"		=>		"scriptManipularDepartamento.php",
		"manipularDepartamento"				=>		"formularioManipularDepartamento.php",

		// Cursos
		"scriptManipularCurso"				=>		"scriptManipularCurso.php",
		"manipularCurso"					=>		"formularioManipularCurso.php",

		// Usuários
		"scriptManipularUsuario"			=>		"scriptManipularUsuario.php",
		"manipularUsuario"					=>		"formularioManipularUsuario.php",

		// Estrangeiros
		"scriptManipularEstrangeiro"		=>		"scriptManipularEstrangeiro.php",
		"manipularEstrangeiro"				=>		"formularioManipularEstrangeiro.php"
	);

	$pagina="inicio.php";
	
	if(isset($_GET['page']))
	{
		$paginaSolicitada = $_GET['page'];

		if (isset($LINKS[ $paginaSolicitada ]))
		{
			return $LINKS[$paginaSolicitada];
		}
		else
		{
			return "404.php";
		}
	}
	return "inicio.php";
}
?>
