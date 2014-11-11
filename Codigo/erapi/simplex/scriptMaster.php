<?php

	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * ScriptMaster - Script que carrega o banco de dados, utilidades  e faz a 
 	 * validação do login do usuários.
 	 */

	require("rb/db.php");
    require("utils.php");
	require("sanitize.php");


	// Configura e inicia o RedBean
	rbSetup();
	
	session_start();

	function validaSession() {
		/* Faz a validação se o usuário está logado ou não */
		if (!isset($_SESSION['usuarioLogado']))
		{
			$_SESSION['erroDeLogin']="Por favor, faça login para continuar.";
			header("location:login.php");
		}
	}
			

?>
