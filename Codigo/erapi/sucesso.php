<?php
/* Autor: Gabriel Henrique Martinez Saraiva
 * Essa página exibe mensagens de sucesso e encaminha o usuário para outra 
 * página. 
 * 
 * Os parametros necessários são passados por $_SESSION por praticidade de 
 * programação com o uso de mensagens que contenham &, ?, ...
 * 
 *
 * Paramêtros: 
 *		$_SESSION['sucessoMensagem']
 *			Mensagem a ser exibida
 *		$_SESSION['sucessoGoto']
 *			Página que o link "Continuar" irá levar o usuário
 */
?>

<div id="sucesso">
	<p class="mensagem">
		<?php echo $_SESSION['sucessoMensagem'];?>
	</p>
</div>	
<button 
	onclick='
		window.location="<?php echo($_SESSION['sucessoGoto']);?>";
		return false;
	'
>Continuar</button>





