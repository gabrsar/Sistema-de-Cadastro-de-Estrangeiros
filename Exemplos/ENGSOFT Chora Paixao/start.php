<?php
error_reporting(E_ALL | E_WARNING | E_STRICT);

require_once('dados.php');

session_start();

$usuarioLogado = $_SESSION['usuarioLogado'];

function validaSessao() {
    
    if (isset($_SESSION['sessaoAceita']) & $_SESSION['sessaoAceita'] == true) {
        return true;
    }
    else {

        header("Location: index.php");
    }
}
?>
