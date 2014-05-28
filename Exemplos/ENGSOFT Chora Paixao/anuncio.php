<?php
require_once("start.php");
validaSessao();
?>

<?php

$gab = new GAB();

setcookie('anuncio_'.$usuarioLogado->getLogin(),'ok',time()+60*60*24*365,"/");

?>


<!DOCTYPE html>
<html>
<head>
<?php require_once("head.php"); ?>

</head>
<body>
 

    

	<div class="anuncio">

		<p class="titulo">
			Seja bem vindo ao novo Sistema de Controle de Serviços (SCS).
		</p>

		<p><b> <?php echo $usuarioLogado->getNome(); ?></b>, para poder utilizar o sistema sem problemas, por favor, leia essa página. </p>
		<p>
			Esse novo sistema foi desenvolvido com base no antigo que já existia, com o intuito de resolver alguns problemas e se adequar mais precisamente a nossa tarefa: Controlar de forma eficiente e prática o serviço de colocação e retirada de placas e fotos nos imóveis.
		</p>
		<p>	Embora esse novo sistema seja bem parecido com o anterior existem alguns pontos a serem considerados para o bom funcionamento do mesmo:
			<ul>
				<li> O termo B.O. utilizado para identificar um imóvel, no sistema agora será chamado de IDM.
				</li>

				<li> De acordo com a transição que a imobiliária está presenciando em seus sistemas, o SCS, agora suporta o cadastro um ou mais imóveis com o mesmo IDM. Isso foi feito para suportar o cadastro de imóveis do antigo sistema e os do novo sistema.
				</li>

				<li> Com base em uma extensa análise na antiga base de dados foi verificado que alguns campos nos registros de Imóveis e Serviços eram desnecessários, e assim foram removidos para tornar o uso do sistema mais simplificado e dinâmico, caso exista alguma dúvida de onde inserir alguma informação que julgue relevante entre em contato com a Contratte.
				</li>

				<li> O sistema agora efetua a validação dos dados inseridos e caso encontre algum erro, irá informar com uma mensagem de alerta ou de erro. Por favor, leia com atenção essas mensagens e caso seja necessário entre em contato com a Contratte informando o erro.
				</li>

				<li> A partir de agora TODOS os imóveis só podem ser cadastrados se for informado quem é seu CORRETOR.
				</li>

				<li> Por ultimo e não menos importante. Para utilizar o sistema de forma adequada e eficiente é necessário utilizar um navegador atualizado, como o Mozilla Firefox, Google Chrome , Internet Explorer 7 ou superior em uma tela resolução igual ou superior a 1024x786. Se não souber se seu computador atende esses requisitos, por favor, chame o responsável pela TI.
				</li>

			</ul>
		</p>

		<p> Concluindo: Esse sistema é fruto de mais de 120 horas de trabalho em análise, desenvolvimento e testes. Assim, nós da Contratte esperamos que aproveite o novo sistema e que ele seja de grande auxílio no desenvolvimento de suas atividades.</p>

		<p><b>Gabriel H. M. Saraiva</b><br>Desenvolvedor</p>

<br><br><br>
	<p>
	<a href="./inicio.php">Li o aviso. Prosseguir para o Sistema</a>
	</p>

	</div>
</body>
</html>
