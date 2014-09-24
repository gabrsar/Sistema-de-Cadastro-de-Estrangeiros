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

	/* Faz a validação se o usuário está logado ou não */

	var_dump($_SESSION);


	if(isset($_SESSION["usuarioLogado"]))
	{
                    $_SESSION['ACEITOU!']="ACEITOU!";
	}
	else
	{
		if($_SERVER["QUERY_STRING"] != "page=login")
		{
			header("location:index.php?page=login");
		}
	}

?>
