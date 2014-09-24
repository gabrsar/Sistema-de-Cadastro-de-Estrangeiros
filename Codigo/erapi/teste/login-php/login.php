<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <form action="login.php" method="post" class="form-signin">
                <h2 class="form-signin-heading">Login</h2>
                <input type="text" class="form-control" name="usuario" placeholder="Usuario/Email" required autofocus>
                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                <label class="checkbox">
                    <input type="checkbox" name="lembrar" value="remember-me"> Lembrar de mim
                </label>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                	<span class="glyphicon glyphicon-circle-arrow-right"></span> Acessar!
                </button>
            </form>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
    </body>
</html>