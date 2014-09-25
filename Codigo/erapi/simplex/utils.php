<?php

	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Arquivo com funções genéricas
 	 */

	function erro($mensagem, $encaminhar)
	{

		$_SESSION['erroMensagem']=$mensagem;
		$_SESSION['erroGoto']=$encaminhar;

		header("location:index.php?page=erro");
	}

	function sucesso($mensagem,$encaminhar)
	{

		$_SESSION['sucessoMensagem']=$mensagem;
		$_SESSION['sucessoGoto']=$encaminhar;
		
		header("location:index.php?page=sucesso");
	}

	function getUsuarioLogado()
	{
		if(isset($_SESSION['usuarioLogado']))
		{
			return $_SESSION['usuarioLogado'];
		}
		else
		{
			erro("SEM USUÁRIO LOGADO","index.php");
			return NULL;
		}
	}

?>
