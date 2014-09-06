<?php

   /*  ______________________________________________________________________
    * |                                                                      |
    * | Página REDIRECT.PHP do site da Contratte Limpeza e Serviços.         |
    * |                                                                      |
    * |   Essa é a página que recebe interpreta o parametro get 'page' e     |
    * | define qual página será exibida apartir dele.                        |
    * |______________________________________________________________________|
    *  ______________________________________________________________________
    * |                                                                      |
    * | Gabriel Henrique Martinez Saraiva - extremez3r0@gmail.com            |
    * | 20/06/2013                                                           |
    * |______________________________________________________________________|
    */


	function obterPagina() {


		//TODO Montar um mecanismo para coletar o resto do get e repassar a página

		// Testa se a variavel de página está definida. Se não estiver abre a página de inicio.
		if(isset($_GET['page']))
		{
			// Se estiver definida ... :)
			$page = strtolower($_GET['page']);

			$ret="";

			// Página principal
			if ($page == "inicio")								$ret="inicio.php";
			else if($page == "pagedepartamento")				$ret="formularioCadastrarDepartamento.php";	
			else if($page == "actioncadastrardepartamento")		$ret="scriptCadastrarDepartamento.php?";
			else if($page == "actionremoverdepartamento")		$ret="scriptRemoverDepartamento.php";
			else 												$ret="inicio.php";
		}
		else
		{
			return "inicio.php";
		}

	}



?>

