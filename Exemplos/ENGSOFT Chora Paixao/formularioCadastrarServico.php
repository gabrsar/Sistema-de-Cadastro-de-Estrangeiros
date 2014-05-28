<?php 
require_once("start.php");
validaSessao();
?>

<?php
$idImovel = -1;
if(isset($_GET['idImovel'])) {
    $idImovel = intval($_GET['idImovel']);

    if($idImovel <=0)
    {
    	$_SESSION['erro']="O imóvel fornecido é inválido!";
    	$_SESSION['erro_motivo']="O identificador do imóvel é inválido!";
    	$_SESSION['irPara']="./formularioBuscarServico.php";

    	header("Location: ./erro.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	
	<?php require_once("head.php"); ?>
	<script type="text/javascript" src="js/busca_magica.js"></script>
	<script type="text/javascript" src="js/validador_formulario_servicos.js"></script>

</head>
<body>
	
	<?php require_once("topo.php"); ?>
    <?php require_once("menu.php"); ?>
    
    <div class="formulario">
		<span class="titulo" >
		
		
	
		
		<?php
    	
    	if(!isset($_GET['idImovel']) || intval($_GET['idImovel']) <=0 ) {

    		echo ("Solicitar novo Serviço</span>");
			require_once 'subFormularioBuscarImovelParaCadastroDeServico.php';
        	exit(0);
    	}



		$gab = new GAB();

		$imovel = $gab->buscarImovel($_GET['idImovel']);

		echo ("Solicitar novo Serviço para o Imóvel:</span>");
		?>
		
		<span class="grupo">
			<p>
				<span class="endereco-imovel">
					<?php

					echo($imovel->toString());
					?>
				</span>
				<a class="botao-trocar-imovel" href="formularioCadastrarServico.php" >Trocar imóvel</a>
			</p>
		</span>

		<form id="cadastro" name="cadastrarServico" action="scriptCadastrarServico.php" method="POST">
	
			<input type="hidden" name ="idImovel" value="<?php echo($imovel->getId());?>"/>
							
			<span class="titulo" >O que deve ser feito no imóvel?</span>
			<span class="grupo">
				<p>
					Serviço de placa
                     <select name="servico_placa">
						<option value="0"> Não </option>
						<option class="colocacao" value="1"> Colocação - Aluga</option>
						<option class="colocacao" value="2"> Colocação - Venda </option>
						<option class="colocacao" value="3"> Colocação - Ambos </option>
						<option class="retirada" value="4"> Retirada - Aluga</option>
						<option class="retirada" value="5"> Retirada - Venda</option>
						<option class="retirada" value="6"> Retirada - Ambos</option>
					</select>
				</p>
				<p>
					Separar chaves
					<select name="separar_chave">
						<option value="0"> Não </option>
						<option value="1"> Sim </option>
					</select>
				</p>
				<p>
					Tirar foto
					  <select name="fotos">
						<option value="0"> Não </option>
						<option value="1"> Externa </option>
						<option value="2"> Interna </option>
						<option value="3"> Externa e Iterna </option>
					</select> 
					
				</p>
				<p>
					Vistoria
					<select name="vistoria">
						<option value="0"> Não </option>
						<option value="1"> Sim </option>
					</select> 
				</p>
				
					
				<p>
					Informações auxiliares (Ex: colocar placa dentro da residencia)
					<input type="text" name="outros" class="width-fill" value="" size="60" >
				</p>

				<p>
					Motivo (Ex: placa caiu ou está velha)
					<input type="text" name="problema" class="width-fill" value="" size="60" >
				</p>

					
			</span>

            <span class="grupo suporte-botoes-link">
				<p>
					<a class="botao-link" href="javascript:validar_formulario();">Cadastrar</a>

					<a class="botao-link" href="./formularioBuscarServico.php">Cancelar</a>
				</p>
			</span>
		</form>

    </div>

</body>
</html>

