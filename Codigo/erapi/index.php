<!DOCTYPE html>
<?php

	/* Autor: Gabriel Henrique Martinez Saraiva
 	 *
 	 * Página principal do sistema.
 	 *
 	 * Essa página é quem exibe tudo.
 	 *
 	 * As outras páginas serão incluidas dentro dessa,
 	 * o esqueleto do sistema fica todo aqui. E os outros arquivos ficam 
 	 * encarregados exclusivamente de ter só seu conteúdo, sem esqueleto do 
 	 * site.
 	 */

// Chamada principal ao script que carrega o RB e outros módulos importantes
require("simplex/scriptMaster.php");

// Carrega o redirecionador
require_once ("./simplex/redirect.php");
// Nome do arquivo a ser exibido pela index.
$pagina = obterPagina();

// Verifica se a página requisitada é a página pública

// XGH BEGINS HERE

$euPosso=array("erro.php","sucesso.php","formularioManipularEstrangeiro_publico.php");

if(!in_array($pagina, $euPosso))
{
	validaSession();
}

// XGH ENDS HERE!
?>
<html lang="pt_BR">
	<head>

		<?php
			include ("simplex/head.php");
		?>
		
	</head>
	<body>
   		<div id="pagina">
			<?php
				include ("simplex/topo.php");
			?>
			<div id="corpo">
				<?php
					if(file_exists($pagina))
					{
						require ($pagina);
					}
					else
					{
						echo "Não foi possivel abrir o arquivo $pagina";
					}
				?>
	    	</div>
			<?php
				include ("simplex/rodape.php");
			?>
		</div>
	</body>
</html>
