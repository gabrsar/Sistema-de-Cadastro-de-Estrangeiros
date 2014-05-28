<?php
include('start.php');
validaSessao();
?>

<?php  require_once("dados.php");  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $titulo; ?></title>
        <link href="temas/tema1.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php require_once("topo.php"); ?>
        <?php require_once("menu.php"); ?>

        <div class="formulario">
            <?php

            try {
                $usuario = new Usuario();
                $usuario->setId($_GET['id']);
                $gab = new GAB();
                $gab->excluirUsuario($usuario);

                $evento = new Evento();
                $evento->setUsuario($usuarioLogado);
                $evento->setEvento("EXCLUIR_USUARIO");
                $evento->setIdAlteracao($usuario->getId());

                $gab->cadastrarEvento($evento);
                echo ("Usuário excluido com sucesso");

            }catch (Exception $e) {

                echo $e->getMessage();

            }
            ?>
            <br /> <br /> <a href="inicio.php">Voltar</a>
        </div>
    </body>
</html>