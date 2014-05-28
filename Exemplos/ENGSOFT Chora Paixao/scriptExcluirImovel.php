<?php
include('start.php');
validaSessao();
?>
<?php

try {
	$imovel = new Imovel();
	$imovel->setId($_GET['id']);
	$gab = new GAB();
	$gab->excluirImovel($imovel);

        	$evento = new Evento();
	$evento->setUsuario($usuarioLogado);
	$evento->setEvento("EXCLUIR_IMOVEL");
	$evento->setIdAlteracao($imovel->getId());

	$gab->cadastrarEvento($evento);

	header("Location: ./formularioBuscarImovel.php");


}catch (Exception $e) {

	$_SESSION['erro'] = "Erro ao excluir o Imóvel!";
	$_SESSION['erro_motivo'] = "";
	$_SESSION['irPara'] = "./formularioBuscarImovel.php";

	header("Location: ./erro.php");
}
?>
