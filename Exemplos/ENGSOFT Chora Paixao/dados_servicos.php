 <?php 
 class Servico {

// Propriedades dos Serviços =================================================
private $aluga                               = NULL;
private $colocacao                           = NULL;
private $dataCadastro                        = NULL;
private $dataUltimaAlteracao                 = NULL;
private $descricao 	                         = NULL;
private $foto                                = NULL;
private $funcionario                         = NULL;
private $idImovel                            = NULL;
private $id                                  = NULL;
private $imovel                              = NULL;
private $observacoes                         = NULL;
private $outros                              = NULL;
private $problema                            = NULL;
private $providencia                         = NULL;
private $retirada                            = NULL;
private $separarChave                        = NULL;
private $statusFinal                         = NULL;
private $venda                               = NULL;
private $vistoria                            = NULL;
// ===========================================================================
   
// Inicio Get/Set ============================================================ 
public function getAluga()                { return $this->aluga; }
public function getColocacao()            { return $this->colocacao; }
public function getDescricao()            { return $this->descricao; }
public function getFoto()                 { return $this->foto; }
public function getFuncionario()          { return $this->funcionario; }
public function getIdImovel()             { return $this->idImovel; }
public function getId()                   { return $this->id; }
public function getImovel()               { return $this->imovel; }
public function getObservacoes()          { return $this->observacoes; }
public function getOutros()               { return $this->outros; }
public function getProblema()             { return $this->problema; }
public function getProvidencia()          { return $this->providencia; }
public function getRetirada()             { return $this->retirada; }
public function getSepararChave()         { return $this->separarChave; }
public function getStatusFinal()          { return $this->statusFinal; }
public function getVenda()                { return $this->venda; }
public function getVistoria()             { return $this->vistoria; }

public function getStatusFinalTexto() {
	switch ($this->getStatusFinal()) {
		case 0:return "PENDENTE";
		case 1:return "AGENDADO";
		case 2:return "EXECUÇÃO";
		case 3:return "CONCLUIDO";
		case 4:return "PROBLEMA";
		case 5:return "OUTROS";
	}
}
 
public function setAluga($aluga)               { $this->aluga = $aluga; }
public function setColocacao($colocacao)       { $this->colocacao = $colocacao; }
public function setDescricao($descricao)       { $this->descricao = $descricao; }
public function setFoto($foto)                 { $this->foto = $foto; }
public function setFuncionario($funcionario)   { $this->funcionario = $funcionario; }
public function setId($id)                     { $this->id = $id; }
public function setIdImovel($idm)              { $this->idImovel = $idm; }
public function setImovel($imovel)             { $this->imovel = $imovel; }
public function setObservacoes($observacoes)   { $this->observacoes = $observacoes; }
public function setOutros($outros)             { $this->outros = $outros; }
public function setProblema($problema)         { $this->problema = $problema; }
public function setProvidencia($providencia)   { $this->providencia = $providencia; }
public function setRetirada($retirada)         { $this->retirada = $retirada; }
public function setSepararChave($separarChave) { $this->separarChave = $separarChave; }
public function setStatusFinal($statusFinal)   { $this->statusFinal = $statusFinal; }
public function setVenda($venda)               { $this->venda = $venda; }
public function setVistoria($vistoria)         { $this->vistoria = $vistoria; }

public function setStatusFinalTexto($texto) {
	switch ($texto) {
		case "PENDENTE":	$this->setStatusFinal(0);break;
		case "AGENDADO":	$this->setStatusFinal(1);break;
		case "EXECUÇÃO":	$this->setStatusFinal(2);break;
		case "CONCLUIDO":	$this->setStatusFinal(3);break;
		case "PROBLEMA":	$this->setStatusFinal(4);break;
		case "OUTROS":		$this->setStatusFinal(5);break;
	}
} 
//public function getDataUltimaAlteracao() {  //????  //}


public function getDataCadastro() {
  
	$gab = new GAB();
//	return "1/2/3 - 12:34:56";
	return $gab->buscarDataDeCadastroDeServico($this->getId());
} 
// ============================================================================

public function toString() {

	$str = "";
	$placa="";
	
	$str .= "BO".$this->getImovel()->getIdm()." ";
	
	if($this->getAluga()==1) {
		$placa .= " ALUGA ";
	}

	if($this->getVenda()==1) {
		$placa .= " VENDA ";
	}

	if($this->getColocacao() == 1) {
		$str .= " (COLOCAÇÃO";
		$str .= $placa;
		$str .= ")";
	}

	if($this->getRetirada() == 1) {
		$str .= "(RETIRADA)";
		$str .= $placa;
		$str .= ")";
	}

	if($this->getFoto() == 1) {
		$str .= "(FOTO)";
	}

	if($this->getSepararChave() == 1) {
		$str .= "(CHAVE)";
	}
   
	return $str;
}

public static function empacotarServicoPorResultSet($resultSet) {

	$gab = new GAB();

	$servico = new Servico();
	$servico->setAluga($resultSet['aluga']);
	$servico->setIdImovel($resultSet['idImovel']);
	$servico->setColocacao($resultSet['colocacao']);
	$servico->setDescricao($resultSet['descricao']);
	$servico->setFoto($resultSet['foto']);
	$servico->setFuncionario($resultSet['funcionario']);
	$servico->setId($resultSet['id']);
	$servico->setObservacoes($resultSet['observacoes']);
	$servico->setOutros($resultSet['outros']);
	$servico->setProblema($resultSet['problema']);
	$servico->setProvidencia($resultSet['providencia']);
	$servico->setRetirada($resultSet['retirada']);
	$servico->setSepararChave($resultSet['separarChave']);
	$servico->setStatusFinal($resultSet['statusFinal']);
	$servico->setVenda($resultSet['venda']);
	$servico->setVistoria($resultSet['vistoria']);

	$i = new Imovel();
	
	$i->setId($servico->getIdImovel());
	$servico->setImovel($gab->buscarImovel($i->getId()));

	return $servico;
}
 
}
?>
