<?php
/* Importações */
require_once("start.php");

/* Empacota usuario com informações do login */
$u = new Usuario();
$u->setLogin($_POST['login']);
$u->setSenha($_POST['senha']);

/* Gerenciador de acesso ao banco */
$gab = new GAB();


/* Valida login do usuario */
if($gab->validarLogin($u)) {

    /* Obtem resto das informações do usuário*/
    $u = $gab->buscarUsuarioPorLogin($u);

    /* Envia usuario para sessão */
    session_start();
    $_SESSION['usuarioLogado'] = $u;
    $_SESSION['sessaoAceita'] = true;

    $evento = new Evento();
    $evento->setUsuario($u);
    $evento->setEvento("LOGIN");
    $evento->setValor($_SERVER['REMOTE_ADDR']);
    $evento->setIdAlteracao(0);

    $gab = new GAB();
    $gab->cadastrarEvento($evento);


    /* Redireciona para o inicio do sistema */
    header("Location: inicio.php");
}else {
    /* Redireciona para o login */
    header("Location: index.php");
}
?>