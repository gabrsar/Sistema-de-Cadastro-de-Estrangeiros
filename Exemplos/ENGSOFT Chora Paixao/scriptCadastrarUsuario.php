<?php
include('start.php');
validaSessao();
?>
<?php

if($usuarioLogado->getPermissao() == 0)
{
	$novoUsuario = new Usuario();

	$novoUsuario->setLogin($_POST['login']);
	$novoUsuario->setSenha($_POST['senha']);
	$novoUsuario->setNome($_POST['nome']);
	$novoUsuario->setPermissao($_POST['permissao']);
	$novoUsuario->setSetor($_POST['setor']);

	$g = new GAB();

	try {

		$usuarioCadastrado =  $g->cadastrarUsuario($novoUsuario);
	    $evento = new Evento();

	    $evento->setUsuario($usuarioLogado);
	    $evento->setEvento("CADASTRAR_USUARIO");
	    $evento->setIdAlteracao($usuarioCadastrado->getId());

	    $g->cadastrarEvento($evento);

		header("Location: ./formularioBuscarUsuario.php"); 

	}catch (Exception $e) {

 		$_SESSION["erro"] = "Houve um erro ao cadastrar o usuário";
		$_SESSION["erro_motivo"] = "";
		$_SESSION["irPara"] = "./formularioBuscarUsuario.php";
		header("Location: ./erro.php"); 

	}
}
else
{
	$_SESSION["erro"] = "Você não pode cadastrar um usuário!";
  	$_SESSION["erro_motivo"] = "Para cadastrar um usuário é necessário ser um administrador. Entre em contato com a Contratte e solicite o cadastramento do novo usuário";
	$_SESSION["irPara"] = "./inicio.php";
    header("Location: ./erro.php"); 
}
?>
