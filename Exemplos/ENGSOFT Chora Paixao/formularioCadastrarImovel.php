<?php
require_once("start.php");
validaSessao();
?>
<!DOCTYPE html>
<html>
<head>

	<?php require_once("head.php"); ?>
	<script type="text/javascript" src="js/validador_formulario_imovel.js"></script>

</head>

<body>

	<?php require_once("topo.php"); ?>
    <?php require_once("menu.php"); ?>

	<div class="formulario">
	
	<span class="titulo" >Cadastro de novo imóvel</span>
    
	<form id="cadastro" name="cadastrarImovel" action="scriptCadastrarImovel.php" method="POST">
	
	
	<span class="grupo">
		<p class="requerido">
			IDM
			<input type="text" name="idm" class="right-align"  onkeypress="mascara(this,soNumeros)" >
			</p>
			</span>
				
	<span class="grupo">
		<a name="#setor"></a>
		<p class="requerido">A qual setor esse imóvel está vinculado?
		<select name="setor">
            <option value ="0" >Aluga</option>
            <option value ="1" >Venda</option>
            <option value ="2" >Ambos</option>
        </select>
		</p>
		 <p class="requerido">
		Corretor
		<input type="text"  name="corretor" size="60"  >
	</p>
	
	<p>
		Contato no Imóvel
		<input type="text" name="contato" size="60"  >
	</p> 

	</span>

	<span class="grupo">
		<p>
			É permitido colocar placa nesse imóvel?
			<select name="placa">
				<option value ="1" >Sim</option>
				<option value ="0" >Não</option>
			</select> 
		</p>
		<p>
			Qual tipo de placa deve ser utilizado?
			<select name="tipoDePlaca">
				<option value ="2" >Normal</option>
				<option value ="1" >Pequena</option>
				<option value ="3" >Grande</option>
				<option value ="4" >Banner</option>
				<option value ="0" >Nenhuma</option>
				<option value ="5" >Outro</option>
			</select>
		</p>
	</span>
					
	<span class="grupo">

		<p class="requerido">
			Logradouro
			<select class="" name="classe_logradouro">
				<option>Rua</option>
				<option>Avenida</option>
				<option>Alameda</option>
				<option>Estrada</option>
				<option>Rodovia</option>
				<option>Via</option>
				<option>Outro</option>
			</select>
			<input type="text" class="clear-float width-fill" name="logradouro" >
		</p>

		<p>
			Número
			<input type="text" name="numero" size="4" value="" >
		</p>
        <p>
			Complemento
			<input type="text" name="complemento" value="" size="60">
		</p>
		<p>
			Quadra
			<input type="text" name="quadra" value="" >
		</p>
		<p>
			Lote
			<input type="text" name="lote" value="" size="5">
		</p>
		
		<p>
			Localização
			<input type="text" size="60"  name="localizacao" value="" >
		</p>
		<p>
			Bairro
			<input type="text"  name="bairro" size="60" value="" >
		</p>
		<p> 
			Loteamento
			<input type="text"  size="60"  name="loteamento" value="" >
		</p>
						
		</span>

		<span class="grupo">

		<p>
			Esse imóvel é um Terreno?
		   <select name="terreno">
				<option value ="0" >Não</option>
				<option value ="1" >Sim</option>
			</select>
		</p>
		<p>
			É necessário um mapa para encontrá-lo?
			<select name="mapa">
				<option value ="0" >Não</option>
				<option value ="1" >Sim</option>
			</select> 
		</p>
		
		<p>
			Esse imóvel está em um condominio fechado?
			<select name="condominioFechado">
				<option value ="0" >Não</option>
				<option value ="1" >Sim</option>
			</select> 

		</p>
		<p>
			É nescessário uma pegar autorização para ir até o imóvel?
 			<select name="autorizacao">
				<option value ="0" >Não</option>
				<option value ="1" >Sim</option>
			</select> 
		</p>
		<p>
			Número das chaves (caso necessário)
			<input type="text" name="numeroDaChave" size="5" value="" >
		</p>
		<p>
			Observações
			<textarea name="outros" rows="4" class="width-fill" cols="60"></textarea>
		</p>
	</span>

	<span class="grupo suporte-botoes-link">
		<p>	
			<a class="botao-link" href="javascript:validarFormulario();">Cadastrar</a>
		
			<a class="botao-link" href="./formularioBuscarImovel.php">Cancelar!</a>
		</p>
	</span> 

            </form>
        </div>
    </body>
</html>
