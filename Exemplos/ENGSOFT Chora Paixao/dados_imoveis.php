<?php
 class Imovel {
 
// Propiedades do imóvel =====================================================
private $aluga 					= NULL; // Flag para indicar se o imóvel pertence ao setor de aluga
private $autorizacao 			= NULL; // Indicador se o imóvel necessita de uma autorização para foto ou placa
private $bairro 				= NULL;
private $complemento 			= NULL;
private $condominioFechado 		= NULL; // Indicador se o imóvel está em um condominio fechado. Define o horario que o serviço deve ser executado
private $contato 				= NULL; // Proprietário da casa
private $corretor	 			= NULL; // Corretor responsável pelo imóvel
private $idm 					= NULL; // Identificador utilizado pela imobiliaria.
private $id 					= NULL; // Identificador utilizado no sistema. (REAL)
private $localizacao 			= NULL;
private $logradouro 			= NULL; // Ex: Av. José Cesarini, R. Carlos Gomes
private $loteamento 			= NULL;
private $lote 					= NULL; // Idem /\. Deve ser permitido apenas UM lote e quadra por imóvel!
private $mapa 					= NULL; // Indicador se é necessário ou não pegar o mapa na imobiliaria para chegar ao local.
private $numeroDaChave 			= NULL; // Caso seja necessário chave para o imóvel, o número da mesma.
private $numero 				= NULL; // Número do imóvel. Caso não possua número receberá um S/N
private $outros 				= NULL; // Outras informações relevantes para realizações dos serviços nos imóveis.
private $placa 					= NULL; // Indicador se o imóvel pode receber placa ou não. (Alguns propietários não querem placas no seu imóvel)
private $quadra 				= NULL; // Em caso de terrenos sem número é necessário especificar um lote e quadra
private $terreno 				= NULL;
private $tipoDePlaca 			= NULL; // Indicador do tipo de placa que o imóvel deve receber.
private $urlFoto				= NULL; // Url para a foto do imóvel
private $venda 					= NULL; // Flag para indicar se o imóvel pertence ao setor de venda
// ============================================================================

// Funções Get/Set =========================================================
public function getAluga() 							{ return $this->aluga; }
public function getAutorizacao() 					{ return $this->autorizacao; }
public function getBairro() 						{ return $this->bairro; }
public function getIdm() 							{ return $this->idm; }
public function getComplemento()                    { return $this->complemento; }
public function getCondominioFechado() 				{ return $this->condominioFechado; }
public function getContato() 						{ return $this->contato; }
public function getCorretor() 						{ return $this->corretor; }
public function getId() 							{ return $this->id; }
public function getLocalizacao() 					{ return $this->localizacao; }
public function getLogradouro() 					{ return $this->logradouro; }
public function getLoteamento() 					{ return $this->loteamento; }
public function getLote() 							{ return $this->lote; }
public function getMapa() 							{ return $this->mapa; }
public function getNumeroDaChave() 					{ return $this->numeroDaChave; }
public function getNumero() 						{ return $this->numero; }
public function getOutros() 						{ return $this->outros; }
public function getPlaca() 							{ return $this->placa; }
public function getQuadra() 						{ return $this->quadra; }
public function getTerreno() 						{ return $this->terreno; }
public function getTipoDePlaca() 					{ return $this->tipoDePlaca; }
public function getTipoDePlacaTexto()				{

    switch($this->getTipoDePlaca())
    {
				case 0: return "Nenhuma";
				case 1: return "Pequena";
				case 2: return "Normal";
				case 3: return "Grande";
				case 4: return "Banner";
				case 5: return "Outro";
				default: return "TIPO DE PLACA INVÁLIDO!";
	}
}

public function getUrlFoto() 						{ return $this->urlFoto; }
public function getVenda() 							{ return $this->venda; }

public function setAluga($aluga) 					{ $this->aluga = $aluga; }
public function setAutorizacao($autorizacao) 		{ $this->autorizacao = $autorizacao; }
public function setBairro($bairro) 					{ $this->bairro = $bairro; }
public function setIdm($idm) 							{  $this->idm = $idm; }
public function setComplemento($complemento )       { $this->complemento = $complemento; }
public function setCondominioFechado($condominioFechado) { $this->condominioFechado = $condominioFechado; }
public function setContato($contato) 				{ $this->contato = $contato; }
public function setCorretor($corretor) 				{ $this->corretor = $corretor; }
public function setId($id) 							{ $this->id = $id; }
public function setLocalizacao($localizacao) 		{ $this->localizacao = $localizacao; }
public function setLogradouro($logradouro) 			{ $this->logradouro = $logradouro; }
public function setLoteamento($loteamento) 			{ $this->loteamento = $loteamento; }
public function setLote($lote) 						{ $this->lote = $lote; }
public function setMapa($mapa) 						{ $this->mapa = $mapa; }
public function setNumeroDaChave($numeroDaChave) 	{ $this->numeroDaChave = $numeroDaChave; }
public function setNumero($numero) 					{ $this->numero = $numero; }
public function setOutros($outros) 					{ $this->outros = $outros; }
public function setPlaca($placa) 					{ $this->placa = $placa; }
public function setQuadra($quadra) 					{ $this->quadra = $quadra; }
public function setTerreno($terreno) 				{ $this->terreno = $terreno; }
public function setTipoDePlaca($tipoDePlaca) 		{ $this->tipoDePlaca = $tipoDePlaca; }
public function setUrlFoto($urlFoto)				{ $this->urlFoto = $urlFoto; }
public function setVenda($venda) 					{ $this->venda = $venda; }
// Final dos Get/Set =========================================================



public function toString()
{
    $texto="";
	if($this->getLogradouro() != "")
	{
		$texto .= $this->getLogradouro() . ", ";
	}

	if($this->getNumero() != "")
	{
		$texto .= "Nº " . $this->getNumero() . ", ";
	}

	if($this->getLote() != "")
	{
		$texto .= "L:" . $this->getLote() . ", ";
	}

	if($this->getQuadra() != "")
	{
		$texto .= "Q:" . $this->getQuadra() . ", ";
	}

	if($this->getComplemento() != "")
	{
		$texto .= $this->getComplemento() . ", ";
	}

	if($this->getLocalizacao() != "")
	{
		$texto .= $this->getLocalizacao() . ", ";
	}

	if($this->getLoteamento() != "")
	{
		$texto .= $this->getLoteamento() . ", ";
	}
    
	if($this->getBairro() != "")
	{
		$texto .= $this->getBairro() . ", ";
	}

	return substr($texto,0,-2);
}
public function toStringCompleto() {

	$texto="<span class=\"imovel-endereco\">";

	//dump($this);
    $texto.="<span class=\"imovel-endereco-importante\">";
	if($this->getLogradouro() != "")
	{
		$texto .= $this->getLogradouro() . ", ";
	}

	if($this->getNumero() != "")
	{
		$texto .= "Nº " . $this->getNumero() . ", ";
	}

	if($this->getLote() != "")
	{
		$texto .= "L:" . $this->getLote() . ", ";
	}

	if($this->getQuadra() != "")
	{
		$texto .= "Q:" . $this->getQuadra() . ", ";
	}

	if($this->getComplemento() != "")
	{
		$texto .= $this->getComplemento() . ", ";
	}

	if($this->getLocalizacao() != "")
	{
		$texto .= $this->getLocalizacao() . ", ";
	}

	if($this->getLoteamento() != "")
	{
		$texto .= $this->getLoteamento() . ", ";
	}
    
	if($this->getBairro() != "")
	{
		$texto .= $this->getBairro() . ", ";
	}

	$texto .= "</span>";

	if($this->getMapa() == 1 )
	{
		$texto .= " [MAPA], ";
	} 

	if($this->getAutorizacao() == 1)
	{
		$texto .= " [AUTORIZAÇÃO], ";
	}

	if($this->getCondominioFechado() == 1) 
	{
		$texto .= " [CONDOMINIO FECHADO], ";
	}

	if($this->getNumeroDaChave() != "" )
	{
		$texto .= "[CHAVE Nº " . $this->getNumeroDaChave() . "], ";
	}
	
	if($this->getOutros() != "" )
	{
		$texto .= "[OBS: " . $this->getOutros() . "], ";

	}
	
	if($this->getTerreno() == 1)
	{
		$texto .= "[TERRENO], ";
	}
 
	if($this->getContato() != "")
	{
		$texto .= "[CONTATO: " . $this->getContato() . "], ";
	}
     
	$texto = substr($texto,0,-2);

	$texto.= "</span>";

	return $texto;
	

}
public static function empacotarImovelPorResultSet($resultSet) {

	$i = new Imovel();
	
	$i->setAluga($resultSet['aluga']);
	$i->setAutorizacao($resultSet['autorizacao']);
	$i->setBairro($resultSet['bairro']);
	$i->setIdm($resultSet['idm']);
	$i->setComplemento($resultSet['complemento']);
	$i->setCondominioFechado($resultSet['condominioFechado']);
	$i->setContato($resultSet['contato']);
	$i->setCorretor($resultSet['corretor']);
	$i->setId($resultSet['id']);
	$i->setLocalizacao($resultSet['localizacao']);
	$i->setLogradouro($resultSet['logradouro']);
	$i->setLoteamento($resultSet['loteamento']);
	$i->setLote($resultSet['lote']);
	$i->setMapa($resultSet['mapa']);
	$i->setNumeroDaChave($resultSet['numeroDaChave']);
	$i->setNumero($resultSet['numero']);
	$i->setOutros($resultSet['outros']);
	$i->setPlaca($resultSet['placa']);
	$i->setQuadra($resultSet['quadra']);
	$i->setTerreno($resultSet['terreno']);
	$i->setTipoDePlaca($resultSet['tipoDePlaca']);
	$i->setUrlFoto($resultSet['urlFoto']);
	$i->setVenda($resultSet['venda']);

	return $i;
}

}
?>
