<?php
	/* Autor: Gabriel Henrique Martinez Saraiva
	 * Pagina em que o usuário faz login.
	 *
	 * Essa página é a única que fica fora do index.php,
	 * isso acontece para evitar que seja necessário carregar o banco de dados
	 * aqui dentro. E também para simplificar o script de redirecionamento e 
	 * login, não tendo que tratar esse caso que o usuário ainda não está logado
	 * .
 	 */
?>

<!DOCTYPE html>
<html lang="pt_BR">
	<head>
		<?php
			include ("simplex/head.php");
		?>
		<script src="js/jquery-latest.js"></script>
	</head>
	<body>
   	<div id="pagina">
			<?php
				include ("simplex/topo.php");
			?>
			<div id="corpo">
				<div id="login">
					<form action="scriptLogin.php" method="post">

						<?php

							session_start();
							
							if(isset($_SESSION['erroDeLogin']))
							{
								echo ("<p class='erroDeLogin'>");
								echo ($_SESSION['erroDeLogin']);
								echo ("</p>");
							}
						?>
						<p><label>Usuário</label><input type="text" name="login"></p>
						<p><label>Senha</label><input type="password" name="senha"></p>
						<div class="botoesLogin">
							<button>Entrar</button>
						</div>
					</form>
				</div>
	    	</div>
		</div>
	</body>
</html>
