<?php
include('start.php');
validaSessao();
?>
<?php

try {
	$s = new Servico();
	$s->setId($_GET['id']);
	$gab = new GAB();
	$gab->excluirServico($s);

	$evento = new Evento();
	$evento->setUsuario($usuarioLogado);
	$evento->setEvento("EXCLUIR_SERVICO");
	$evento->setIdAlteracao($s->getId());

	$gab->cadastrarEvento($evento);

	header("Location: ./formularioBuscarServico.php");

}catch (Exception $e) {

	$_SESSION['erro']="Houve um erro ao excluir o serviço!";
	$_SESSION['erro_motivo']=$e;
	$_SESSION['irPara'] = "./formularioBuscarServico.php";

	header("Location: ./erro.php");
	

}
?>
