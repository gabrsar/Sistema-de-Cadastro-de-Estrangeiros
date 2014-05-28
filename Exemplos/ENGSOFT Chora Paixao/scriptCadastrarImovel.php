<?php
require_once( "start.php" );
validaSessao();
?>
<?php

//Depois ir para... em caso de erro.

$_SESSION['irPara']="./formularioCadastrarImovel.php";

$imovel = new Imovel();

$imovel->setPlaca(isset($_POST['placa'])?$_POST['placa']:'0');
$imovel->setTipoDePlaca(isset($_POST['tipoDePlaca'])?$_POST['tipoDePlaca']:'');
$imovel->setTerreno(isset($_POST['terreno'])?$_POST['terreno']:'');
$imovel->setMapa(isset($_POST['mapa'])?$_POST['mapa']:'');
$imovel->setCondominioFechado(isset($_POST['condominioFechado'])?$_POST['condominioFechado']:'');
$imovel->setAutorizacao(isset($_POST['autorizacao'])?$_POST['autorizacao']:'');
$imovel->setNumeroDaChave(isset($_POST['numeroDaChave'])?$_POST['numeroDaChave']:'');


$imovel->setIdm(isset($_POST['idm'])?$_POST['idm']:'');
$imovel->setCorretor(isset($_POST['corretor'])?$_POST['corretor']:'');
$imovel->setContato(isset($_POST['contato'])?$_POST['contato']:'');


if($_POST['classe_logradouro'] != "Outro")
{
	$logradouro = $_POST['classe_logradouro'] . " " . $_POST['logradouro'];
}
else
{	
	$logradouro = $_POST['logradouro'];
}

$imovel->setLogradouro($logradouro);

$imovel->setNumero(isset($_POST['numero'])?$_POST['numero']:'');
$imovel->setComplemento(isset($_POST['complemento'])?$_POST['complemento']:'');
$imovel->setQuadra(isset($_POST['quadra'])?$_POST['quadra']:'');
$imovel->setLote(isset($_POST['lote'])?$_POST['lote']:'');
$imovel->setLocalizacao(isset($_POST['localizacao'])?$_POST['localizacao']:'');
$imovel->setBairro(isset($_POST['bairro'])?$_POST['bairro']:'');
$imovel->setLoteamento(isset($_POST['loteamento'])?$_POST['loteamento']:'');

if($_POST['setor'] == 0)
{
	$imovel->setAluga(1);
	$imovel->setVenda(0);
}
else if($_POST['setor'] == 1)
{
	$imovel->setAluga(0);
	$imovel->setVenda(1);
}
else
{
	$imovel->setAluga(1);
	$imovel->setVenda(1);
}

$imovel->setOutros(isset($_POST['outros'])?$_POST['outros']:'');
$imovel->setUrlFoto("");


$gab = new GAB(  );
try {

    $novoImovel = $gab->cadastrarImovel( $imovel );
	
	if( $novoImovel->getId() >= 0 ){
	
		$evento = new Evento();
		$evento->setUsuario( $usuarioLogado );
		$evento->setEvento( "CADASTRAR_IMOVEL" );
		$evento->setIdAlteracao( $novoImovel->getId());
		
		$gab->cadastrarEvento( $evento );
		header(  'Location: ./formularioCadastrarServico.php?idImovel='.$novoImovel->getId());

	}



}catch ( Exception $e ) {


}

?>	
