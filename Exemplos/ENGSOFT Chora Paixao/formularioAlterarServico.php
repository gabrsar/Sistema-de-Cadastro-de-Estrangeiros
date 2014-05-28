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
    	
    	if(!isset($_GET['id']) || intval($_GET['id']) <=0 ) {

    		$_SESSION['erro'] = "Serviço não encontrado!";
    		$_SESSION['erro_motivo'] = "O parametro passado está incorreto.";
    		$_SESSION['irPara'] = "./formularioBuscarServico.php";

    		header("Location: erro.php");
    	}


		$gab = new GAB();


		$s = $gab->buscarServico(intval($_GET['id']));

		

 



		echo ("Serviço solicitado para o Imóvel:</span>");
		?>
		
		<span class="grupo">
			<p>
				<span class="endereco-imovel">
					<?php

					echo($s->getImovel()->toString());
					?>
				</span>
			</p>
		</span>

		<form id="cadastro" name="cadastrarServico" action="scriptAlterarServico.php" method="POST">
         <span class="grupo">
			<p>
				Solicitado em: 
				<?php 
				$data_hora = explode(" - ",$s->getDataCadastro());
				$data = $data_hora[0];
				$hora = $data_hora[1];

				$dma = explode("/",$data);
				$dia = $dma[2];
				$mes = $dma[1];
				$ano = $dma[0];

				echo $dia ."/".$mes."/".$ano . " as " . $hora;
				?>
			</p>

			<p> Estado atual do serviço  
				<select name="status">
        
					<option <?php echo(($s->getStatusFinal() == 0)?"selected":""); ?>  value="0" > PENDENTE </option>
					<option <?php echo(($s->getStatusFinal() == 1)?"selected":""); ?>  value="1" > AGENDADO </option>
					<option <?php echo(($s->getStatusFinal() == 2)?"selected":""); ?>  value="2" > EXECUÇÃO </option>
					<option <?php echo(($s->getStatusFinal() == 3)?"selected":""); ?>  value="3" > CONCLUIDO </option>
					<option <?php echo(($s->getStatusFinal() == 4)?"selected":""); ?>  value="4" > PROBLEMA </option>
					<option <?php echo(($s->getStatusFinal() == 5)?"selected":""); ?>  value="5" > OUTROS </option> 
				</select>
			</p>
				
		</span> 
      
			<input type="hidden" name ="id" value="<?php echo($s->getId());?>" >
			<input type="hidden" name ="idImovel"  value="<?php echo($s->getImovel()->getId());?>">
							
			<span class="titulo" >O que deve ser feito no imóvel?</span>
			<span class="grupo">
				<p>
					Serviço de placa
                     <select name="servico_placa">


                     <?php
                        $s0="";
						$s1="";
						$s2="";
						$s3="";
						$s4="";
						$s5="";
						$s6="";
						$se = "selected";

						if($s->getColocacao() == 1)
						{
							if($s->getAluga() == 1 && $s->getVenda() == 0)
							{
								$s1 = $se;
							}
							else if($s->getAluga() == 0 && $s->getVenda() == 1)
							{
								$s2 = $se;
							}
 							else if($s->getAluga() == 1 && $s->getVenda() == 1)
 							{
 								$s3 = $se;
 							}
 						}
 						else if($s->getRetirada() == 1)
 						{
                            if($s->getAluga() == 1 && $s->getVenda() == 0)
							{
								$s4 = $se;
							}
							else if($s->getAluga() == 0 && $s->getVenda() == 1)
							{
								$s5 = $se;
							}
 							else if($s->getAluga() == 1 && $s->getVenda() == 1)
 							{
 								$s6 = $se;
 							}
 						}
 						else
 						{
 							$s0 = $se;
 						}
						?>

						<option <?php echo $s0; ?> value="0"> Não </option>
						<option <?php echo $s1; ?> class="colocacao" value="1"> Colocação - Aluga</option>
						<option <?php echo $s2; ?> class="colocacao" value="2"> Colocação - Venda </option>
						<option <?php echo $s3; ?> class="colocacao" value="3"> Colocação - Ambos </option>
						<option <?php echo $s4; ?> class="retirada" value="4"> Retirada - Aluga</option>
						<option <?php echo $s5; ?> class="retirada" value="5"> Retirada - Venda</option>
						<option <?php echo $s6; ?> class="retirada" value="6"> Retirada - Ambos</option>
					</select>
				</p>
				<p>
					Separar chaves
					<select name="separar_chave">

						<option <?php echo (($s->getSepararChave() == 0)?"selected":""); ?> value="0"> Não </option>
						<option <?php echo (($s->getSepararChave() == 1)?"selected":""); ?> value="1"> Sim </option>
					</select>
				</p>
				<p>
					Tirar foto
					  <select name="fotos">
						<option <?php echo (($s->getFoto() == 0)?"selected":""); ?> value="0"> Não </option>
						<option <?php echo (($s->getFoto() == 1)?"selected":""); ?>  value="1"> Externa </option>
						<option <?php echo (($s->getFoto() == 2)?"selected":""); ?>  value="2"> Interna </option>
						<option <?php echo (($s->getFoto() == 3)?"selected":""); ?>  value="3"> Externa e Iterna </option>
					</select> 
					
				</p>
				<p>
					Vistoria
					<select name="vistoria">
						<option <?php echo (($s->getVistoria() == 0)?"selected":""); ?> value="0"> Não </option>
						<option <?php echo (($s->getVistoria() == 1)?"selected":""); ?> value="1"> Sim </option>
					</select> 
				</p>
				
					
				<p>
					Informações auxiliares (Ex: colocar placa dentro da residencia)
					<input type="text" name="outros" class="width-fill" value="<?php echo $s->getOutros(); ?>" size="60" >
				</p>

				<p>
					Motivo (Ex: placa caiu ou está velha)
					<input type="text" name="problema" class="width-fill" value="<?php echo $s->getProblema(); ?>" size="60" >
				</p>

					
			</span>

            <span class="grupo suporte-botoes-link">
				<p>
					<a class="botao-link" href="javascript:validar_formulario();">Salvar</a>
					<a class="botao-link" href="./formularioBuscarServico.php">Cancelar</a>
					<a class="botao-link" href="./scriptExcluirServico.php?id=<?php echo $s->getId();?>">Excluir</a>
				</p>
			</span>
		</form>

    </div>

</body>
</html>
