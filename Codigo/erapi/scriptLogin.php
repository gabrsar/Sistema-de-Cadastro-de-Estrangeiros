<?php
	
	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Script de login.
 	 * Baseado em http://blog.erikfigueiredo.com.br/login-php-com-lembrar-de-mim-e-bcrypt/
 	 * 
 	 * Recebe por POST o usuário, senha
 	 */


	// Função que valida o login, recebe duas strings, LOGIN e SENHA, 
	// e retorna um booleano. VERDADEIRO = aceito. FALSO = incorreto.
	function validarLogin($login,$senha)
	{
		$hash = md5($login.$senha);
		$usuario = R::findOne('usuario','login = ?',[$login]);

		if($usuario)
		{
			if($usuario->senha_hash == $hash)
			{
				return true;
			}
		}
		
		return false;
	}



	/* Início do script */
	require("rb/db.php");
	require("simplex/sanitize.php");
	rbSetup();

	$login = sanitizeString($_POST['login']);

	$senha = "";

	session_start();

	if(isset($_POST['senha']))
	{
		$senha=$_POST['senha'];
	}
	else
	{
		$_SESSION['erroDeLogin'] = "Senha não informada!";
		header("location:login.php");
	}

	if(validarLogin($login,$senha))
	{
		$usuarioLogado = R::findOne('usuario','login = ?',[$login]);
		$_SESSION['usuarioLogado'] = $usuarioLogado;
		
		header("location:index.php?page=inicio");
	}
	else
	{
		$_SESSION['erroDeLogin'] = "Usuário e senha inválido!";
		header("location:login.php");
	}

?>
