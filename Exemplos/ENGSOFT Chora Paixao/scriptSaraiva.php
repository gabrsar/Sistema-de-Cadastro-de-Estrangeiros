<?php

require_once("start.php");

$gab = new GAB();
$servico = new Servico();
$servico->setId($_POST['id']);
$servico = ($gab->buscarServico($servico));


//$servico->setStatusFinal($_POST['statusFinal']);
$servico->setStatusFinal(3);
$gab = new GAB();
try {
    $servicoAlterado = $gab->alterarServico($servico);

    $evento = new Evento();
    $evento->setUsuario($usuarioLogado);
    $evento->setEvento("ALTERAR_SERVICO");
    $evento->setIdAlteracao($servicoAlterado->getId());

    $gab->cadastrarEvento($evento);

    header("Location: formularioBuscarServico.php");

}catch (Exception $e) {
    echo ($e->getMessage());
}

?>