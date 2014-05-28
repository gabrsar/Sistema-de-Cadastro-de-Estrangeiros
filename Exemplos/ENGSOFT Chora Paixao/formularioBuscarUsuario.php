 <?php
require_once("start.php");
validaSessao();
?>

<!DOCTYPE html>
<html>
<head>

<?php require_once("head.php"); ?>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>

<script type="text/javascript" id="js">
	$(document).ready(function() {
		// call the tablesorter plugin
		$("table").tablesorter()
	});
</script>
</head> 

<body>
	<?php require_once("topo.php"); ?>
	<?php require_once("menu.php"); ?>
	
	<div class="formulario">      
		<div class="painel opcoes">
			<ul>
			<?php

				$usuario = $_SESSION['usuarioLogado'];                
			
				if ( $usuario->getPermissao() == 0 )
				{
					echo('<li><a class="botao" href="formularioCadastrarUsuario.php" >Cadastrar novo usuário</a></li>');
				}
			?>
			</ul>
		</div>
	
	   
		<div class="painel resultados">
	         <table class="tableshorting resultados" cellpadding="3px" cellspacing="0px" border="1px">
                <thead>
                    <tr class="cabecalho">
                        <th>Abrir</th>
                        <th>Nome</th>
                        <th>Permissção</th>
                    </tr>
                </thead>
                <tbody>
                    <?php



                    $gab = new GAB();

                    $resultado = $gab->buscarTodosUsuarios($usuarioLogado);
                    while($linha = mysql_fetch_assoc($resultado)) {
                        $u = new Usuario();
                        $u->setNome($linha['nome']);
                        $u->setId($linha['id']);
                        $u->setPermissao($linha['permissao']);
                        echo ('<td><a href="formularioAlterarUsuario.php?id=' . $u->getId() . '">Visualizar</a></td>');
                        echo ('<td>' . $u->getNome().'</td>');
                        echo ('<td>' . $u->getPermissaoTexto() . '</td>');
                        echo ('</tr>');

                    }


                    ?>
                </tbody>
            </table>
        </div>
	</div>
</body>
</html>
