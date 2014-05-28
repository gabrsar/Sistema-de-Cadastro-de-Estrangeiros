<?php
require_once("start.php");
session_start();


$u = $_SESSION['usuarioLogado'];
$sessaoAceita = $_SESSION['sessaoAceita'];

if($sessaoAceita){
	$evento = new Evento();
	$evento->setUsuario($u);
	$evento->setEvento("LOGOFF");
	$evento->setValor($_SERVER['REMOTE_ADDR']);
	$evento->setIdAlteracao(0);
	$gab = new GAB();
    $gab->cadastrarEvento($evento);
}
session_destroy();
header("Location: index.php");

?>