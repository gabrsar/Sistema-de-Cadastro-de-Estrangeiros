 <?php 
require_once("start.php");
validaSessao();
?>

<?php
	if($usuarioLogado->getPermissao() != 0 )
	{
		$_SESSION["erro"] = "Você não pode cadastrar um usuário!";
		$_SESSION["erro_motivo"] = "Para cadastrar um usuário é necessário ser um administrador. Entre em contato com a Contratte e solicite o cadastramento do novo usuário";
		$_SESSION["irPara"] = "./inicio.php";
		header("Location: ./erro.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	
	<?php require_once("head.php"); ?>
	<script type="text/javascript" src="js/validador_formulario_usuario.js"></script>

</head>
<body>
	
	<?php require_once("topo.php"); ?>
    <?php require_once("menu.php"); ?>
     	
     	
    
    <div class="formulario">
        <span class="titulo" >Cadastro de Usuários</span>

		<form id="cadastro" name="cadastrarUsuario" action="scriptCadastrarUsuario.php" method="POST">
			<span class="grupo">
				<p class="requerido"> Login <input type="text" name="login" value="" size="32" /></p>
				<p class="requerido"> Senha <input type="text" name="senha" value="" size="32" /></p>
				<p class="requerido"> Nome Completo <input  type="text" name="nome" value="" size="32" /></p>
				<p class="requerido"> Permissão 			
					<select name="permissao">
						<option value="2">Imobiliária</option>
						<option value="1">Contratte</option>
						<option value="0">Administrador</option>
						<option value="3">Espectador</option>
					</select>
				</p>

				<p class="requerido"> Setor 			
					<select name="setor">
						<option value="0">Nenhum</option>
						<option value="1">Aluga</option>
						<option value="2">Venda</option>
					</select>
				</p>

			</span>
			
			<span class="grupo suporte-botoes-link">
				<p>
					<a class="botao-link" href="javascript:validarFormulario()">Salvar</a>
					<a class="botao-link" href="./formularioBuscarUsuario.php">Cancelar</a>
				</p>
			</span> 
        </form>
	</div>
</body>
</html>
