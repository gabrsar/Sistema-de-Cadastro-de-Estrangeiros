<?php

include('start.php');
validaSessao();
?>
<?php

$usuarioNovo = new Usuario();
$usuarioNovo->setLogin($_POST['login']);
$usuarioNovo->setSenha($_POST['senha']);
$usuarioNovo->setNome($_POST['nome']);

$usuarioNovo->setSetor($_POST['setor']);
$usuarioNovo->setPermissao($_POST['permissao']);
$usuarioNovo->setId($_POST['id']);

$gab = new GAB();
try {
    $usuarioAlterado = $gab->alterarUsuario($usuarioNovo, $usuarioLogado);

    $evento = new Evento();
    $evento->setUsuario($usuarioLogado);
    $evento->setEvento("ALTERAR_USUARIO");
    $evento->setIdAlteracao($usuarioAlterado->getId());

    $gab->cadastrarEvento($evento);

    header("Location: ./formularioBuscarUsuario.php");
} catch (Exception $e) {

    $_SESSION["erro"] = "Houve um erro ao cadastrar o usuário";
    $_SESSION["erro_motivo"] = "";
    $_SESSION["irPara"] = "./formularioBuscarUsuario.php";
    header("Location: ./erro.php");
}
?> 
