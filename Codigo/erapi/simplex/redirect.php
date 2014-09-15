<?php

/* Autor: Gabriel Henrique Martinez Saraiva
 * Data: 11/09/2014
 * Página de controle de links.
 * Com base na variavel $_GET['page'] retorna a página a ser importada na index com o conteúdo a ser exibido.
 * Também faz uma cópia da variavel $_GET em $GET para poder ser acessado de dentro da página carregada.]
 */	
   
	function obterPagina() {


		$links = array(

			"inicio" 							=> 		"inicio.php",

			"erro"								=>		"erro.php",
			"sucesso"							=>		"sucesso.php",

			// Página Inicial
			"fichas"		 					=> 		"formularioFichas.php",
			"relatórios"	 					=> 		"formularioRelatorios.php",
			"configuracoes" 					=> 		"formularioConfiguracoes.php",

			// Configurações
			"configuracoesDepartamentos"		=> 		"formularioDepartamento.php",
			"configuracoesCursos" 				=> 		"formularioCursos.php",
			"configuracoesUsuarios" 			=> 		"formularioUsuarios.php",


			// Departamentos
			"scriptManipularDepartamento"		=>		"scriptManipularDepartamento.php",
			"manipularDepartamento"				=>		"formularioManipularDepartamento.php"
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