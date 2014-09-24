<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!-- Static navbar -->
        <div class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Sistema de login</a>
            </div>
          </div>
        </div>
    
    
        <div class="container">
    
          <!-- Main component for a primary marketing message or call to action -->
          <div class="jumbotron">
            <h1>Cadastre-se!</h1>
            <p>Preencha seus dados abaixo para se cadastrar no sistema.</p>
            <p>
            <form action="cadastrar.php" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputNome" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                   		<input type="text" class="form-control" id="inputNome" name="nome" placeholder="Nome">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                   		<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUsuario" class="col-sm-2 control-label">Usuário</label>
                    <div class="col-sm-10">
                   		<input type="text" class="form-control" id="inputUsuario" name="usuario" placeholder="Usuário">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSenha" class="col-sm-2 control-label">Senha</label>
                    <div class="col-sm-10">
                   		<input type="password" class="form-control" id="inputSenha" name="senha" placeholder="Senha">
                    </div>
                </div>
                <button class="btn btn-lg btn-danger btn-block" type="submit">
                	<span class="glyphicon glyphicon-circle-arrow-right"></span> Cadastrar!
                </button>
            </form>
            </p>
          </div>
    
        </div> <!-- /container -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
    </body>
</html>