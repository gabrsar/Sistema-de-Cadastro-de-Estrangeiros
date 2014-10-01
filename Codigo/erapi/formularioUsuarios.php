<?php

	/* Autor: Gabriel Henrique Martinez Saraiva
 	 * Página de listagem e acesso ao módulo de usuarios
 	 */
?>
<div id="titulo">
	<a href="index.php?page=configuracoes" class="voltar">&lt&lt</a>
	<p class="titulo">Usuários</p>
</div>

<div class="painel">
	<p> Opções: </p>
	<a href="index.php?page=manipularUsuario">Cadastrar novo usuário</a>
</div>

<div class="listagem">
	<p class="titulo"> Lista dos usuários cadastrados </p>
	<table>
		<thead>
			<tr><td>Nome</td><td>Nível</td></tr>
		</thead>
		<tbody>           
			<?php

			require("permissao.php");
			
			$usuarios=false; // qualquer coisa.
			
			$usuarioLogado=getUsuarioLogado();

			if($usuarioLogado->permissao == Permissao::getIDPermissao("Administrador"))
			{	
				$usuarios = R::find('usuario','excluido=0');
			}
			else
			{
				$usuarios = R::findOne('usuario','login = ?',[$usuarioLogado->login]);
			}
			
			foreach ($usuarios as $usuario) {
				$id=$usuario->id;
				$nome=$usuario->nome;
				$permissao=Permissao::getNomePermissao($usuario->permissao);
				echo ("<tr><td><a href='index.php?page=manipularUsuario&id=$id'>$nome</a></td><td>$permissao</td></tr>\n");
			}
			?>
		</tbody>
		<tfoot>
			<tr><td colspan="2">Foram encontrados 
				<?php echo (R::count('usuario','excluido=0')); ?>
			registros</td></tr>
		</tfoot>
  	</table>
</div>  

