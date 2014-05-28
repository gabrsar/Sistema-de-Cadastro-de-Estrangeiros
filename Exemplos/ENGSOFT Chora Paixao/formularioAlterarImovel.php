<?php
require_once("start.php");
validaSessao();
?>

<?php
if(!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] <=0)
{
	$_SESSION['erro']="Não foi possivel encontrar o imóvel";
	$_SESSION['erro_motivo']="Não foi passado um identificador válido";
	$_SESSION['irPara'] = "./formularioBuscarImovel.php";
	header("Location:  ./erro.php");
}

$gab = new GAB();

$i = $gab->buscarImovel($_GET['id']);

if($i->getId() != $_GET['id'])
{
    $_SESSION['erro']="Não foi possivel encontrar o imóvel";
	$_SESSION['erro_motivo']="Não foi passado um identificador válido";
	$_SESSION['irPara'] = "./formularioBuscarImovel.php";
	header("Location:  ./erro.php"); 
}
?>

<!DOCTYPE html>
<html>
<head>

	<?php require_once("head.php");  ?> 
	<script type="text/javascript" src="js/validador_formulario_imovel.js" ></script>

</head>

<body>

	<?php require_once("topo.php");  ?> 
	<?php require_once("menu.php");  ?> 

	<div class="formulario">
	
	<span class="ancoras">
		<a href="#servicos">Servicos</a>
		<a href="#eventos">Eventos</a>
    </span>
	
	<a name="informacoes"></a>
	<span class="titulo" >Informações do Imóvel <?php echo($i->getIdm());?> </span>


		<form id="cadastro" name="cadastrarImovel" action="scriptAlterarImovel.php" method="POST">

			<input type="hidden" name="id" value="<?php echo($i->getId());?>">

			<span class="grupo">
				<p class="requerido">
					IDM
					<input type="text" name="idm" class="right-align"  onkeypress="mascara(this,soNumeros)" value="<?php echo $i->getIdm(); ?>" >
				</p>
			</span>

			<span class="grupo">
				<p class="requerido">
					A qual setor esse imóvel está vinculado ? 
					<select name="setor">
						<?php 

						$a="";$b="";$c="";
						if($i->getAluga() && $i->getVenda())
	                    {                         
	                        $c="selected";        
	                    }                         
	                    else if($i->getAluga())   
	                    {                         
	                        $a="selected";        
	                    }                         
	                    else                      
	                    {                         
	                        $b="selected";        
	                    }                         
                                                    
	                    ?>                         
						<option value ="0" <?php echo $a;  ?> >Aluga</option>
						<option value ="1" <?php echo $b;  ?> >Venda</option>
						<option value ="2" <?php echo $c;  ?> >Ambos</option>
                    </select>                                           
				</p>
				
				<p class="requerido">
					Corretor
					<input type="text"  name="corretor" size="60" value="<?php echo $i->getCorretor();  ?>"  >
				</p>
				<p>
					Contato no Imóvel
					<input type="text" name="contato" size="60"  value="<?php echo $i->getContato();  ?>">
				</p> 
			</span>
			
			<span class="grupo">
				<p>
					É permitido colocar placa nesse imóvel ? 
					<select name="placa">
						<?php
						
						$a="";$b="";
						if($i->getPlaca())
						{
							$a="selected";
						}
						else
						{
							$b="selected";
						}
						
						?> 

						<option value ="1" <?php echo $a;  ?> >Sim</option>
						<option value ="0" <?php echo $b;  ?> >Não</option>
					</select> 
				</p>
				
				<p>
					Qual tipo de placa deve ser utilizado ?  (Caso seja "outro", especifique em "Observações")
					<select name="tipoDePlaca">
						<option value ="0" <?php echo($i->getTipoDePlaca() == 0 ? "selected" : "");  ?> >Nenhuma</option>
						<option value ="1" <?php echo($i->getTipoDePlaca() == 1 ? "selected" : "");  ?> >Pequena</option>
						<option value ="2" <?php echo($i->getTipoDePlaca() == 2 ? "selected" : "");  ?> >Normal</option>
						<option value ="3" <?php echo($i->getTipoDePlaca() == 3 ? "selected" : "");  ?> >Grande</option>
						<option value ="4" <?php echo($i->getTipoDePlaca() == 4 ? "selected" : "");  ?> >Banner</option>
						<option value ="5" <?php echo($i->getTipoDePlaca() == 5 ? "selected" : "");  ?> >Outro</option>
					</select>
				</p>
			</span>
			
			<span class="grupo">
			
				<p class="requerido">
					Logradouro 
					
					<?php 
					
					// uahuahuah agora o pau come huahauh quem mandou querer fazer bonitinho  : /
					
					$s = explode(" ",$i->getLogradouro());
					
					$classe = $s[0];
					$logradouro = substr($i->getLogradouro(),strlen($classe)+1);
					
					$f=0;
					
					?> 

					<select class="" name="classe_logradouro">
						<option <?php echo($classe == "Rua"			 ? "selected" : "");$f=1;  ?> >Rua</option>
						<option <?php echo($classe == "Avenida"		 ? "selected" : "");$f=1;  ?> >Avenida</option>
						<option <?php echo($classe == "Alameda"		 ? "selected" : "");$f=1;  ?> >Alameda</option>
						<option <?php echo($classe == "Estrada"		 ? "selected" : "");$f=1;  ?> >Estrada</option>
						<option <?php echo($classe == "Rodovia"		 ? "selected" : "");$f=1;  ?> >Rodovia</option>
						<option <?php echo($classe == "Via"			 ? "selected" : "");$f=1;  ?> >Via</option>
						<option <?php echo($f==0 ? "selected" : ""); ?> 								>Outro</option>
					</select>
					
					<input type="text" class="clear-float width-fill" name="logradouro" value="<?php echo $logradouro;  ?>" >
				</p>
				
				<p>
					Número
					<input type="text" name="numero" size="4" value="<?php echo $i->getNumero();  ?>" >
				</p>
				
				<p>
					Complemento
					<input type="text" name="complemento" value="<?php echo $i->getComplemento();  ?>" size="60">
				</p>
				
				<p>
					Quadra
					<input type="text" name="quadra" value="<?php echo $i->getQuadra();  ?>" >
				</p>
				
				<p>
					Lote
					<input type="text" name="lote" value="<?php echo $i->getLote(); ?>" size="5">
				</p>
				
				<p>
					Localização
					<input type="text" size="60"  name="localizacao" value="<?php echo $i->getLocalizacao();  ?>" >
				</p>
				
				<p>
					Bairro
					<input type="text"  name="bairro" size="60" value="<?php echo $i->getBairro();  ?>" >
				</p>
				
				<p>
					Loteamento
					<input type="text"  size="60"  name="loteamento" value="<?php echo $i->getLoteamento();  ?>" >
				</p>
			</span>
			
			<span class="grupo">
				<p>
					Esse imóvel é um Terreno ? 
					<select name="terreno">
						<option value ="0" <?php echo($i->getTerreno() == 0  ?  "selected"  :  ""); ?>  >Não</option>
						<option value ="1" <?php echo($i->getTerreno() == 1  ?  "selected"  :  ""); ?>  >Sim</option>
					</select>
				</p>
				
				<p>
					É necessário um mapa para encontrá-lo ? 
					<select name="mapa">
						<option value ="0" <?php echo($i->getMapa() == 0  ?  "selected"  :  ""); ?> >Não</option>
						<option value ="1" <?php echo($i->getMapa() == 1  ?  "selected"  :  ""); ?> >Sim</option>
					</select>
				</p>
				
				<p>
					Esse imóvel está em um condominio fechado ?
					<select name="condominioFechado">
						<option value ="0" <?php echo($i->getCondominioFechado() == 0  ?  "selected"  :  ""); ?> >Não</option>
						<option value ="1" <?php echo($i->getCondominioFechado() == 1  ?  "selected"  :  ""); ?> >Sim</option>
					</select>
				</p>
				
				<p>
					É nescessário uma pegar autorização para ir até o imóvel ? 
					<select name="autorizacao">
						<option value ="0" <?php echo($i->getAutorizacao() == 0  ?  "selected"  :  ""); ?> >Não</option>
						<option value ="1" <?php echo($i->getAutorizacao() == 1  ?  "selected"  :  ""); ?> >Sim</option>
					</select>
				</p>
				
				<p>
					Número das chaves (caso necessário)
					<input type="text" name="numeroDaChave" size="5" value="<?php echo($i->getNumeroDaChave());?>" >
				</p>
				
				<p>
					Observações
					<textarea name="outros" rows="4" class="width-fill" cols="60"><?php echo($i->getOutros());?> </textarea>
				</p>
			</span>
			
			<span class="grupo suporte-botoes-link">
			<p>
					<a class="botao-link" href="javascript:validarFormulario();">Salvar</a>
					
					<a class="botao-link" href="./formularioAlterarImovel.php?id= <?php echo($i->getId()); ?>">Cancelar</a>
			</p>
			</span>
		</form>
	</div>


    <div class="formulario">     

		<span class="ancoras">
			<a href="#informacoes">Informações</a>
			<a href="#eventos">Eventos</a>
	    </span>
	
		<a id="servicos"></a>
		<span class="titulo">Serviços do Imóvel <?php echo($i->getIdm()); ?> </span>

		<span class="grupo suporte-botoes-link">
			<p>
				<a class="botao-link" href="./formularioCadastrarServico.php?idImovel=<?php echo($i->getId()); ?>">Solicitar novo serviço</a>
			</p>
		</span> 

		<span class="grupo">
			<table class="tableshorting resultados" cellpadding="3px" border="1px" cellspacing="2px">
				<thead>
                	<th>ID</th>
					<th>Data</th>
					<th><img src="imagens/colocacao.png" alt="C"></th>
					<th><img src="imagens/retirada.png" alt="R"></th>
					<th>A</th>
					<th>V</th>
					<th><img src="imagens/foto.png" alt="F"></th>
					<th><img src="imagens/vistoria.png" alt="Vi"></th>
					<th>Estado atual</th>
				</thead>
				<tbody>
				
				<?php /* Busca e preenche os serviços realizados no imóvel em questão */
				
				
				$servicos = $gab->buscarServicosDeImovel($i->getId());
				
				$imgOK = '<img src="./imagens/imgOK.png" />';
				
				$j=0;
				
				foreach($servicos as $s) {
					echo("<tr>");
		 				echo('<td> <a href="formularioAlterarServico.php?id=' . $s->getId() . '">' . $s->getId() . '</a> </td>');
						echo("<td>" . $s->getDataCadastro()  . "</td>" );
						echo("<td>" . ($s->getColocacao() == 1 ? $imgOK : "") . "</td>" );
						echo("<td>" . ($s->getRetirada() == 1 ? $imgOK : "") . "</td>");
						echo("<td>" . ($s->getAluga() == 1 ? $imgOK : "") . "</td>");
						echo("<td>" . ($s->getVenda() == 1 ? $imgOK : "") . "</td>");
						echo("<td>" . ($s->getFoto() == 1 ? $imgOK : "") . "</td>");
						echo("<td>" . ($s->getVistoria() == 1 ? $imgOK : "") . "</td>");
						echo("<td>" . ($s->getStatusFinalTexto()) . "</td>");
					echo("</tr>");
					$i++;	
				}

				if($j==0)
				{
					echo('<td colspan="9" align="center"> Nenhum serviço foi solicitado nesse imóvel </td>');
				}
				echo ('</tbody><tfoot><tr class="rodape"><th colspan="9">Número de serviços encontrados : ' . $j  . '</th>');
				?>
			</tbody>
		</table>
	</div>                        




   <span class="ancoras">
		<a href="#informacoes">Informações</a>
		<a href="#servicos">Servicos</a>
    </span>              
	<div class="formulario">
		<a id="eventos"></a>	
		<span class="titulo">Relatório de eventos do imóvel</span>

		<table class="tablesorting resultados" cellpadding="3px" border="1px" cellspacing="2px">
			<thead>
				<th>Usuário</th>
				<th>Evento</th>
				<th>Alvo</th>
				<th>Data</th>
				<th>Valor</th>
			</thead>
		<tbody>
		
		<?php
		$eventos = $gab->buscarEventosDeImovel($i->getId());
		
		$contador=0;
    
		foreach($eventos as $e) {
		    echo ("<tr>");
		    echo ("<td>" . $e->getUsuario()->getNome() . "</td>");
		    echo ("<td>" . $e->getEventoTexto() . "</td>");

			echo ("<td>");
			switch ($e->getEvento()) {


        		case 8  : 
        		case 9  : 
        		case 10 : 
        		case 11 :
					
					echo('<a href="#informacoes" >' . $i->getIdm() . '</a>');

            		break;
				
				case 12 : 
        		case 13 : 
        		case 14 : 
        		case 15 : 
					
            		$servico = $gab->buscarServico($e->getIdAlteracao());

					echo('<a href="./formularioAlterarServicos?id=' . $servico->getId() . '">' . $servico->getId() . '</a>');            		
					

				default:

					$_SESSION['erro'] = 'Foi encontrado uma inconsistencia na base de dados!';
					$_SESSION['erro_motivo'] = 'Entre em contato com a Contratte imediatamente e informe o seguinte erro: INCONSISTENCIA NA LISTA DE EVENTOS DE IMÓVEL';
					$_SESSION['irPara'] = 'http://www.contratte.com.br/contato';

					echo ('<script type="text/javascript"> window.location = "./erro.php" </script>');

				break;
    		}


    echo ("<td>".date("d/m/Y - H:i:s",strtotime($e->getData()))."</td>");
    echo ("<td>".$e->getValor()."</td>");
    echo ("</tr>");

	$contador++;
}
echo ('</tbody><tfoot><tr class="rodape"><th colspan="5">Número de eventos encontrados:' . $contador  . '</th>');


?> 
			</tbody>

		</table>

	</div>
	<span class="grupo suporte-botoes-link">
		<p>
			<a class="botao-link" href="./scriptExcluirImovel.php?id= <?php echo($i->getId()); ?>">Excluir!</a>
		</p>
	</span>



</body>
</html>

