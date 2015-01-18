<?php
/* Autor: Gabriel Henrique Martinez Saraiva
 * Essa página exibe mensagens de erro e encaminha o usuário para outra 
 * página. 
 * 
 * Os parametros necessários são passados por $_SESSION por praticidade de 
 * programação com o uso de mensagens que contenham &, ?, ...
 * 
 *
 * Paramêtros: 
 *		$_SESSION['erroMensagem']
 *			Mensagem a ser exibida
 *		$_SESSION['erroGoto']
 *			Página que o link "Continuar" irá levar o usuário
 */
?>

<div id="erro">
	<p class="mensagem">
		A página que você procura não existe. <br>
		Por favor, verifique se o endereço está correto...
	</p>

	<form>
		<button onclick='window.location="<?php echo($_SESSION['erroGoto']);?>"'>Continuar</button>
	</form>
</div>


