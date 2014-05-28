<?php
require_once 'start.php';
validaSessao();

/* CAPTURA A ACAO */
$acao = $_GET['acao'];

/* CAPTURA O ALVO */
$avlo = $_GET['alvo'];


switch ($acao) {
    case "servico_cadastrar":

        $formulario = "scriptCadastrar";
        

        break;

    default:
        break;
}

?>
