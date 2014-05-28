<!DOCTYPE html>
<html>
    <head>
        <?php require_once("head.php"); ?>

        <script src="js/login.js"></script>

    </head>
    <body>

        <?php require_once("topo.php"); ?>

        <div id="inicio">
            <div  id="login">
                <form action="scriptRealizarLogin.php" method="POST">
                    <p>
                        <span>Usuário:</span>
                        <input type="text" name="login" value="" maxlength="32"  />
                    </p>

                    <p>
                        <span>Senha:</span>
                        <input type="password" name="senha" value="" maxlength="32" />
                    </p>

                    <input type="submit" value="Entrar" />

                </form>
            </div>
    </body>
</html>
