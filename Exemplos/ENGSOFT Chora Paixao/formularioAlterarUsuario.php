<?php 
require_once("start.php");
validaSessao();
?>

<?php

	$id = (int) $_GET["id"];
	$usuario;

	if($usuarioLogado->getPermissao() != 0 && $usuarioLogado->getId() != $id)
	{
		$_SESSION["erro"] = "Você não pode acessar esse usuário!";
		$_SESSION["erro_motivo"] = "Esse incidente será reportado ao administrador de sistema. Seu IP e Conta foram gravados.";
		$_SESSION["irPara"] = "./inicio.php";
		header("Location: ./erro.php");
	}
	
	
	$gab = new GAB();
	$usuario = $gab->buscarUsuario($id);

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
        <span class="titulo" ><?php echo($usuario->getNome());?></span>

		<form id="alterar" name="cadastrarUsuario" action="scriptAlterarUsuario.php" method="POST">

			<input type="hidden" value="<?php echo($usuario->getId()); ?>" name="id">
			<span class="grupo">
				<p class="requerido"> Login <input type="text" name="login" value="<?php echo($usuario->getLogin());?>" size="32" /></p>
				<p class="requerido"> Senha <input type="text" name="senha" value="<?php echo($usuario->getSenha());?>" size="32" /></p>
				<p class="requerido"> Nome Completo <input  type="text" name="nome" value="<?php echo($usuario->getNome());?>" size="32" /></p>
				<p class="requerido"> Permissão 			
					<select name="permissao">
						<option <?php echo($usuario->getPermissao() == 2?"selected":"");?> value="2">Imobiliária</option>
						<option <?php echo($usuario->getPermissao() == 1?"selected":"");?> value="1">Contratte</option>
						<option <?php echo($usuario->getPermissao() == 0?"selected":"");?> value="0">Administrador</option>
						<option <?php echo($usuario->getPermissao() == 3?"selected":"");?> value="3">Espectador</option>
					</select>
				</p>

				<p class="requerido"> Setor 			
					<select name="setor">
						<option <?php echo($usuario->getSetor() == 0?"selected":"");?> value="0">Nenhum</option>
						<option <?php echo($usuario->getSetor() == 1?"selected":"");?> value="1">Aluga</option>
						<option <?php echo($usuario->getSetor() == 2?"selected":"");?> value="2">Venda</option>
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
