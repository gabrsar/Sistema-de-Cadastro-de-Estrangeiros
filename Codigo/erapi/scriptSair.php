<?php
	
	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Script para deslogr o usuário.
 	 * 
 	 * Remove  o usuáro da sessão.
 	 */


	if(isset($_SESSION['usuarioLogado']))
	{
		unset($_SESSION['usuarioLogado']);

	}

	header("location:login.php");


?>
