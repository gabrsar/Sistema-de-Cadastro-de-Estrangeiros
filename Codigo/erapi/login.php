<?php

	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Pagina em que o usuário faz login.
 	 *
 	 * #FIXME - Preciso corrigir o sistema de redirecionamento para que essa 
 	 * página possa fazer login.
 	 */

echo $_SESSION['passDB'];
echo "<br>";
echo $_SESSION['passFORM'];
?>

<div id="login">
<h4> EXECUTE O SCRIPT fakeUsers.php PARA CRIAR OS USUÁRIOS </h4>
	<form action="index.php?page=scriptLogin" method="post">
		<p><label>Usuário</label><input type="text" name="login"></p>
		<p><label>Senha</label><input type="password" name="senha"></p>
		<div class="botoesLogin">
			<button>Entrar</button>
		</div>
	</form>
</div>
