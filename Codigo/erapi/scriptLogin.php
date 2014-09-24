<?php
	
	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Script de login.
 	 * Baseado em http://blog.erikfigueiredo.com.br/login-php-com-lembrar-de-mim-e-bcrypt/
 	 * 
 	 * Recebe por POST o usuário, senha e opção de lembrar do usuário
 	 */



	$login=sanitizeString($_POST['login']);

	$senha="";

	if(isset($_POST['senha']))
	{
		$senha=$_POST['senha'];
	}
	else
	{
		erro("Senha não informada","index.php?page=login");
	}

	if(validarLogin($login,$senha))
	{
		$_SESSION['last'] = $_SESSION['last']+1;
		$_SESSION['passFORM']="OK!";
		$usuarioLogado=R::findOne('login','login = ?',[$login]);
		$_SESSION['usuarioLogado'] = $usuarioLogado->senha_hash;

		header("location:index.php?page=inicio");
	}
	else
	{
		erro("Usuário ou senha incorreto!","index.php?page=login");
	}


	function validarLogin($login,$senha)
	{
		
		$hash = md5($login.$senha);
		$usuario = R::findOne('usuario','login = ?',[$login]);
		$_SESSION["passDB"]=$usuario->senha_hash;
		$_SESSION["passFORM"]=$hash;

		if(!$usuario)
		{
			return false;
		}


		if($usuario->senha_hash == $hash)
		{
			$_SESSION["passDB"]="OK!";
			return true;
		}
		else
		{
			$_SESSION["passDB"]="FALSE";
			return false;
        }
	}
?>
