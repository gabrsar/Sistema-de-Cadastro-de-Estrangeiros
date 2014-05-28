<?php

class GAB {


    private $usuario = "engsoft";
    private $senha = "#xorapaixao";
    private $enderecoDoBanco = "www.contratte.com.br";
    private $banco = "sistema_engenharia_software";

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getEnderecoDoBanco() {
        return $this->enderecoDoBanco;
    }

    public function setEnderecoDoBanco($enderecoDoBanco) {
        $this->enderecoDoBanco = $enderecoDoBanco;
    }

    public function getBanco() {
        return $this->banco;
    }

    public function setBanco($banco) {
        $this->banco = $banco;
    }


	public function cadastrarEvento($evento) {

        $insert = "INSERT INTO tbeventos VALUES(null,%s,%s,%s,%s,%s);";

        $insertSql = sprintf($insert,
                $evento->getUsuario()->getId(),
                $evento->getEvento(),
                $evento->getIdAlteracao(),
                date ("'Y-m-d H:i:s'"),
                limparTextoParaSQL($evento->getValor())
        		);


        try {
            $this->executarSQL($insertSql);
        }catch (Exception $e) {
            echo "ERRO AO CADASTRAR EVENTO!";
        }

    }

    public function cadastrarServico($s,$usuario) {

        if ($usuario->getPermissao()>1) {

            $s->setObservacoes("");
            $s->setProvidencia("");
            $s->setStatusFinal(0);
            $s->setFuncionario("");
        }

        $sql="INSERT INTO tbservicos VALUES(null,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,0);";
        $insertSql = sprintf($sql,
                limparTexto($s->getIdImovel()),
                (int)($s->getColocacao()),
                (int)($s->getRetirada()),
                (int)($s->getAluga()),
                (int)($s->getVenda()),
                (int)($s->getSepararChave()),
                (int)($s->getFoto()),
                limparTextoParaSQL($s->getDescricao() ),
                limparTextoParaSQL($s->getOutros() ),
                (int)($s->getVistoria()),
                limparTextoParaSQL($s->getProblema() ),
                limparTextoParaSQL($s->getProvidencia() ),
                (int)($s->getStatusFinal()),
                limparTextoParaSQL($s->getFuncionario() ),
                limparTextoParaSQL($s->getObservacoes() )
        		);

        $sucesso = false;
        $sucesso = $this->executarSQL($insertSql);

        if ($sucesso) {

            //Cadastrar Evento

            //Devolve imóvel cadastrado.
            $s->setId(mysql_insert_id());

            return $this->buscarServico($s->getId());


        }else {
            throw new Exception("Não foi possivel cadastrar o serviço.");
        }


    }

    public function cadastrarImovel($imovel) {

		// Faz as validações

        if(!($imovel->getAluga() || $imovel->getVenda())) {
            throw new Exception("Erro ao cadastrar o Imóvel! O imóvel não está disponivel para venda nem para locação.");
        }

		if(trim($imovel->getCorretor()) == "")
		{
			throw new Exception("Erro ao cadastrar o Imóvel! O nome do corretor não foi definido.");
		}

		if(trim($imovel->getLogradouro()) == "")
		{
			throw new Exception("Erro ao cadastrar o Imóvel! Não foi especificado corretamente o endereço do mesmo.");
		}


		$sql = "INSERT INTO tbimoveis";
		$c = "(";
		$v = "(";

		$c.= "idm,"; 					$v.= 		$imovel->getIdm()				 	. ", ";
		$c.= "aluga,";					$v.= 		$imovel->getAluga()				 	. ", ";
		$c.= "venda,";					$v.= 		$imovel->getVenda()				 	. ", ";
		$c.= "placa,";					$v.= 		$imovel->getPlaca()					. ", ";
		$c.= "tipodeplaca,";			$v.= 		$imovel->getTipoDePlaca()			. ", ";
		$c.= "contato,";				$v.= "'" . 	$imovel->getContato()			."'". ", ";
		$c.= "logradouro,";				$v.= "'" .	$imovel->getLogradouro()		."'". ", ";
		$c.= "numero,";					$v.= "'" .  $imovel->getNumero()			."'". ", ";
		$c.= "quadra,";					$v.= "'" .  $imovel->getQuadra()			."'". ", ";
		$c.= "lote,";					$v.= "'" .  $imovel->getLote()				."'". ", ";
		$c.= "complemento,";			$v.= "'" .  $imovel->getComplemento()		."'". ", ";
		$c.= "localizacao,";			$v.= "'" .  $imovel->getLocalizacao()		."'". ", ";
		$c.= "bairro,";					$v.= "'" .  $imovel->getBairro()			."'". ", ";
		$c.= "loteamento,";				$v.= "'" .  $imovel->getLoteamento()		."'". ", ";
		$c.= "terreno,";				$v.= "'" .  $imovel->getTerreno()			."'". ", ";
		$c.= "mapa,";					$v.= 		$imovel->getMapa()					. ", ";
		$c.= "condominiofechado,";		$v.= 		$imovel->getCondominioFechado()		. ", ";
		$c.= "autorizacao,";			$v.= 		$imovel->getAutorizacao()			. ", ";
		$c.= "numerodachave,";			$v.= "'" .  $imovel->getNumeroDaChave()		."'". ", ";
		$c.= "corretor,";				$v.= "'" .  $imovel->getCorretor()			."'". ", ";
		$c.= "urlFoto,";				$v.= "'" .  $imovel->getUrlFoto()			."'". ", ";
		$c.= "outros,";					$v.= "'" .  $imovel->getOutros()			."'". ", ";
		$c.= "excluido"	;				$v.= 0;

		$c.=")";
		$v.=");";


		$sql = $sql . $c . " VALUES " . $v;

        $sucesso= false;
        $sucesso = $this->executarSQL($sql);

        if ($sucesso) {

            //Devolve imóvel cadastrado.
            $imovel->setId(mysql_insert_id());

            return $this->buscarImovel($imovel->getId());

        }else {
            throw new Exception("Não foi possivel cadastrar o imóvel. Motivo:\n[" . mysql_error()."]\n" );
        }

    }

	function buscarEventosDeImovel($imovelId) {

        $wI = "evento >= 8 AND evento <=11 AND idAlteracao = ". $imovelId;
        $select = "SELECT * FROM tbeventos WHERE ".$wI." ORDER BY id DESC ";

        $resultado = $this->executarSQL($select);

        ;
        $eventos = array();
        $i=0;
        while($r = mysql_fetch_assoc($resultado)) {

            $eventos[$i] = Evento::empacotarEventoPorResultSet($r);
            $i++;

        }

		return $eventos;

    }


	function buscarEventosDeServico($servico) {

		$wI = "evento >= 12 AND evento <=15 AND idAlteracao = ". $servico->getId();
		$select = "SELECT * FROM tbeventos WHERE ".$wI." ORDER BY id DESC ";

		$resultado = $this->executarSQL($select);

		;
		$eventos = array();
		$i=0;
		while($r = mysql_fetch_assoc($resultado)) {

			$eventos[$i] = Evento::empacotarEventoPorResultSet($r);
			$i++;

		}

		return $eventos;

    }


	function buscarDataDeCadastroDeServico($idServico) {
		
		$sql = "SELECT DATE_FORMAT(data,'%Y/%m/%d') as data FROM tbeventos WHERE evento = 12 AND idalteracao = " . (int) $idServico;

		$resultado = $this->executarSQL($sql);



		$r = mysql_fetch_assoc($resultado);

		if($r)
		{
			return $r["data"];
		}
		
		return "0/0/0";

    }


    function buscarEventos($usuario,$tipo,$limite) {


        $wU = (($usuario!= 0)?" AND usuario = ".$usuario:"");
        $wT = "";//(($tipo!= -1)?" AND evento = ".$tipo:"");
        $wL = " LIMIT ".(($limite!= 0)?$limite:"30");

        $select = "SELECT * FROM tbeventos WHERE 1=1".$wU.$wT." ORDER BY id DESC ".$wL ;

        $resultado = $this->executarSQL($select);

        $eventos = array();
        $i=0;
        while($r = mysql_fetch_assoc($resultado)) {

            $eventos[$i] = Evento::empacotarEventoPorResultSet($r);
            $i++;

        }

        return $eventos;

    }
    function buscarImovelParaListar($buscaInteligente,$texto,$setor,$excluidos,$limite) {
        if($excluidos != 0) {
            $e = 1;
        }else {
            $e=0;
        }

        $selectSql = "SELECT * FROM tbimoveis WHERE  excluido = " .$e;



        if ($setor != 0) {
            $s = ($setor == 1)?"aluga = 1":"venda =1";
            $selectSql .= " AND ". $s;
        }




        $buscaDinamica="";
        if($texto != "") {
            if($buscaInteligente) {
                $stringLimpa = limparParaBuscaInteligente($texto);

            }else {
                $stringLimpa = limparTextoParaSQL($texto);

            }
            $stringLimpa = limparTextoParaPesquisaSQL($stringLimpa);



            $buscaDinamica="
            	AND ( idm LIKE %s
            			OR contato LIKE %s
            			OR logradouro LIKE %s
            			OR numero LIKE %s
            			OR quadra LIKE %s
            			OR lote LIKE %s
            			OR complemento LIKE %s
            			OR localizacao LIKE %s
            			OR bairro LIKE %s
            			OR loteamento LIKE %s
            			OR numeroDaChave LIKE %s
            			OR outros LIKE %s
						OR corretor LIKE %s )";

            $buscaDinamica = str_replace("%s",$stringLimpa,$buscaDinamica);
        }

        $selectSql.= $buscaDinamica;
        $selectSql.= " ORDER BY id DESC";
		$selectSql.= " LIMIT " . $limite;

        $resultado = $this->executarSQL($selectSql);



        $imoveis = array();
        $i=0;
        while($r = mysql_fetch_assoc($resultado)) {

            $imoveis[$i] = Imovel::empacotarImovelPorResultSet($r);
            $i++;
        }



        return $imoveis;

    }
    function buscarServicoParaListarParaTabela($texto,$placa,$colocacao,$retirada,$foto,$vistoria,$status,$excluidos,$buscaInteligente,$limite) {


        $buscaDinamica="";
        if($texto != "") {
            if($buscaInteligente) {
                $stringLimpa = limparParaBuscaInteligente($texto);

            }else {
                $stringLimpa = limparTextoParaSQL($texto);

            }
            $stringLimpa = limparTextoParaPesquisaSQL($stringLimpa);



            $buscaDinamica="
            	AND ( i.idm LIKE %s
            			OR i.contato LIKE %s
            			OR i.corretor LIKE %s
            			OR i.logradouro LIKE %s
            			OR i.numero LIKE %s
            			OR i.quadra LIKE %s
            			OR i.lote LIKE %s
            			OR i.complemento LIKE %s
            			OR i.localizacao LIKE %s
            			OR i.bairro LIKE %s
            			OR i.loteamento LIKE %s
            			OR i.numeroDaChave LIKE %s
            			OR i.outros LIKE %s
            			OR s.descricao LIKE %s
            			OR s.outros LIKE %s
            			OR s.outros LIKE %s
            			OR s.problema LIKE %s
            			OR s.funcionario LIKE %s
            			OR s.observacoes LIKE %s
            			OR s.id LIKE %s
           			)";

            $buscaDinamica = str_replace("%s",$stringLimpa,$buscaDinamica);
        };


        $wColocacao = ($colocacao==1)?" AND s.colocacao = 1 ":"";
        $wRetirada = ($retirada==1)?" AND s.retirada = 1 ":"";
        $wFoto = ($foto==1)?" AND s.foto = 1 ":"";
        $wVistoria = ($vistoria==1)?" AND s.vistoria = 1 ":"";
        $wStatus = ($status > -1)?" AND s.statusFinal = " . ((int)$status):"";

        if($placa  != 0) {

            if($placa == 1) {
                $wPlaca = "AND s.aluga = 1";
            }else {
                $wPlaca = "AND s.venda = 1";
            }

        }else {
            $wPlaca = "";
        }


        $wExcluidos = ($excluidos==1)?" s.excluido = 1 ":" s.excluido = 0 ";

        $selectSql = "SELECT s.id FROM tbservicos s INNER JOIN tbimoveis i ON i.id = s.idImovel WHERE ";
        $selectSql.=$wExcluidos;
        $selectSql.=$wVistoria;
        $selectSql.=$wFoto;
        $selectSql.=$wRetirada;
        $selectSql.=$wPlaca;
        $selectSql.=$wColocacao;
        $selectSql.=$wStatus;
        $selectSql.=$buscaDinamica;

        $selectSql.= " ORDER BY s.id DESC";

        $selectSql.= " LIMIT $limite";

        $resultado = $this->executarSQL($selectSql);


        $servicos = array();
        $i=0;

        while($resultSet = mysql_fetch_assoc($resultado)) {

            $s = new Servico();
            $s->setId($resultSet['id']);

			$s = $this->buscarServico($s->getId());
            $servicos[$i] = $s;

            $i++;
        }

        return $servicos;

    }

    function excluirImovel($imovel) {

        $selectSql  = "UPDATE tbimoveis SET excluido = 1 WHERE id=";
        $selectSql .= limparTextoParaSQL($imovel->getId());
        $resultado = $this->executarSQL($selectSql);
        return $resultado;
    }
    function excluirServico($servico) {

        $selectSql  = "UPDATE tbservicos SET excluido = 1 WHERE id=";
        $selectSql .= limparTextoParaSQL($servico->getId());
        $resultado = $this->executarSQL($selectSql);
        return $resultado;
    }


	/* Função que realiza a busca dos serviços de um imóvel apartir do ID do imóvel e devolve um array dos serviços */
	function buscarServicosDeImovel($imovelID) {


		$selectSql = "SELECT id FROM tbservicos WHERE idImovel = " . $imovelID . " ORDER BY id DESC";

		$resultado = $this->executarSQL($selectSql);

		$servicos = array();

        $i=0;

        while($resultSet = mysql_fetch_assoc($resultado)) {

            $s = new Servico();
            $s = $this->buscarServico($resultSet['id']);
            $servicos[$i] = $s;
            $i++;
        }

        return $servicos;
	}

	function alterarImovel($in) {

        $sql = "UPDATE tbimoveis SET";

        $sql.= " aluga = "				.		$in->getAluga()							. ",";
		$sql.= " autorizacao = "		.		$in->getAutorizacao()					. ",";
		$sql.= " bairro = "				. "'" . $in->getBairro()				. "'"	. ",";
		$sql.= " complemento = "		. "'" . $in->getComplemento()			. "'"	. ",";
		$sql.= " condominioFechado = "	.		$in->getCondominioFechado()				. ",";
		$sql.= " contato = "			. "'" . $in->getContato()				. "'"	. ",";
		$sql.= " corretor = "			. "'" . $in->getCorretor()				. "'"	. ",";
        $sql.= " idm = "				.		$in->getIdm()							. ",";
		$sql.= " localizacao = "		. "'" . $in->getLocalizacao()			. "'"	. ",";
		$sql.= " logradouro = "			. "'" . $in->getLogradouro()			. "'"	. ",";
		$sql.= " loteamento = "			. "'" . $in->getLoteamento()			. "'"	. ",";
		$sql.= " lote = "				. "'" . $in->getLote()					. "'"	. ",";
		$sql.= " mapa = "				.		$in->getMapa()							. ",";
		$sql.= " numeroDaChave = "		. "'" . $in->getNumeroDaChave()			. "'"	. ",";
		$sql.= " numero = "				. "'" . $in->getNumero()				. "'"	. ",";
		$sql.= " outros = "				. "'" . $in->getOutros()				. "'"	. ",";
		$sql.= " placa = "				.		$in->getPlaca()							. ",";
		$sql.= " quadra = "				. "'" . $in->getQuadra()				. "'"	. ",";
		$sql.= " terreno = "			.		$in->getTerreno()						. ",";
		$sql.= " tipoDePlaca = "		.		$in->getTipoDePlaca()					. ",";
		$sql.= " venda = "				.		$in->getVenda()							;

		$sql.= " WHERE id = "			.		$in->getId();



		$sql = trim($sql);

        try {
            $this->executarSQL($sql);
            $imovel = $this->buscarImovel($in->getId());

            return $imovel;

        }catch (Exception $e) {

            throw new Exception($e->getMessage());

        }
    }
    public function buscarImovel($imovel) {

    	if(!is_numeric($imovel))
    	{
    		die;
    	}

        $id = $imovel;

        $selectSql = "SELECT * FROM tbimoveis WHERE id = " .$id;

        try {
            $r = mysql_fetch_assoc($this->executarSQL($selectSql));
            $imovel = Imovel::empacotarImovelPorResultSet($r);

            return $imovel;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

    }

	/*	public function buscarServico($servico) {

        $id = $servico->getId();
        $selectSql = "SELECT * FROM tbservicos WHERE id = " . limparTexto($id);

        try {
        $r = mysql_fetch_assoc($this->executarSQL($selectSql));
        $servicoLocalizado = Servico::empacotarServicoPorResultSet($r);
        return $servicoLocalizado;
        }
        catch (Exception $e) {
        echo $e->getMessage;
        }

    	}*/

    public function buscarServico($servicoId) {

        $id = $servicoId;
        $selectSql = "SELECT * FROM tbservicos WHERE id = " . limparTexto($id);

        try {


            $r = mysql_fetch_assoc($this->executarSQL($selectSql));
            $servicoLocalizado = Servico::empacotarServicoPorResultSet($r);
            return $servicoLocalizado;
        }
        catch (Exception $e) {
            echo $e->getMessage;
        }

    } 

    /* Função que retorna a conexão com o banco de dados*/
    function getConexao() {
        try {
            $conexao =  mysql_connect($this->getEnderecoDoBanco(),$this->getUsuario(),$this->getSenha());
            mysql_select_db($this->getBanco(),$conexao);
            return $conexao;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

    }
    function executarSQL($sql) {

        $conexao = $this->getConexao();
        $resultado = mysql_query($sql,$conexao);
        if ($resultado == false) {

			$numero = date("dmYHis");

			if($_edomgubed_ == 7)
			{
				$erro = " SQL:'".$sql."' - SGDB Erro:'".mysql_error()."'";
			}

			gravarErro($numero.$erro);

			$msg = "Erro ao executar comando SQL!<br>Código do erro:".$numero."<br>";
			$msg.= "Favor entrar em contato com a Contratte e informar o código do erro junto aos detalhes da atividade realizada ao ocorrer o erro.";
            throw new Exception($msg);

        }
        return $resultado;
    }

    function validarLogin($usuario) {

        $selectSql  = "SELECT login,senha FROM tbusuarios WHERE login = ";
        $selectSql .= limparTextoParaSQL($usuario->getLogin());
        $selectSql .= " AND senha = ";
        $selectSql .= limparTextoParaSQL($usuario->getSenha());

        $resultado = $this->executarSQL($selectSql);

        $valido = false;

        if (mysql_fetch_assoc($resultado) != false) {

            $valido = true;
        }
        return $valido;

    }



    function buscarTodosUsuarios($usuario) {
        $selectSql = "SELECT * FROM tbusuarios WHERE excluido = 0 ";


        if($usuario->getPermissao()!=0) {
            $where = " AND id = " . $usuario->getId();
            $selectSql .= $where;
        }


        $gab = new GAB();

        $resultado = $gab->executarSQL($selectSql);
        return $resultado;
    }
    function cadastrarUsuario($usuario) {

		$sql = "INSERT INTO tbusuarios ";

		$c= ""; $v="";

		$c .= "id, ";								$v .= "null, ";
		$c .= "login, ";							$v .= limparTextoParaSQL($usuario->getLogin())	. ", ";
		$c .= "senha, ";							$v .= limparTextoParaSQL($usuario->getSenha())	. ", ";
		$c .= "nome, ";								$v .= limparTextoParaSQL($usuario->getNome())	. ", ";
		$c .= "permissao, ";						$v .= $usuario->getPermissao()					. ", ";
		$c .= "setor,";								$v .= $usuario->getSetor()						. ", ";
		$c .= "excluido";							$v .= "0";

		$sql .= "(" . $c . ") VALUES (" . $v . ");";

		echo $sql;

        $sucesso= false;

        $sucesso = $this->executarSQL($sql);

        if ($sucesso) {

            //Cadastrar Evento

            //Devolve usuario cadastrado.
            $usuario->setLogin(limparTexto($usuario->getLogin()));
            $usuario->setSenha(limparTexto($usuario->getSenha()));
            $usuario->setNome(limparTexto($usuario->getNome()));
            $usuario->setId(mysql_insert_id());

            return $usuario;
        }else {
            throw new Exception("Não foi possivel cadastrar o usuario.");
        }
    }

    function buscarUsuarioPorLogin($usuario) {

        $selectSql  = "SELECT * FROM tbusuarios WHERE login=";
        $selectSql .= limparTextoParaSQL($usuario->getLogin());
        $resultado = $this->executarSQL($selectSql);


        if ($resultado!= false) {

            $dados = mysql_fetch_assoc($resultado);

            //Empacota usuario.
            return Usuario::empacotaUsuarioPorResultSet($dados);
        }else {
            return false;
        }
    }

    function excluirUsuario($usuario) {

        $selectSql  = "UPDATE tbusuarios SET excluido = 1 WHERE id=";
        $selectSql .= limparTextoParaSQL($usuario->getId());
        $resultado = $this->executarSQL($selectSql);
        return $resultado;
    }



    function alterarUsuario($usuarioNovo,$usuarioLogado) {


        $sql = "UPDATE tbusuarios SET ";

        if($usuarioLogado->getPermissao() == 0)
        {
        	$sql .= "login = " . limparTextoParaSQL($usuarioNovo->getLogin()) . ", ";
        	$sql .= "permissao = " . (int)($usuarioNovo->getPermissao()) . ", ";
        	$sql .= "setor = " . (int)($usuarioNovo->getSetor()) . ", ";
        	$sql .= "nome = " . limparTextoParaSQL($usuarioNovo->getNome()) . ", ";
        }

        $sql .= "senha = " . limparTextoParaSQL($usuarioNovo->getSenha());

		$sql .= " WHERE id = " . (int) $usuarioNovo->getId();

        try {
            $this->executarSQL($sql);

			return $this->buscarUsuario($usuarioNovo->getId());

        }catch (Exception $e) {

            throw new Exception($e->getMessage());

        }
    }

    function alterarServico($s,$usuario) {

		$status="";

		if($usuario->getPermissao() == 0 || $usuario->getPermissao() == 1)
		{
			$status = "statusFinal     = " . (int)$s->getStatusFinal()     .", "; 
		}

        $sql = "UPDATE tbservicos SET ";
		//$sql.= "idImovel		= " . (int)$s->getIdImovel()		.", ";
		$sql.= "colocacao		= " . (int)$s->getColocacao()		.", ";
		$sql.= "retirada        = " . (int)$s->getRetirada()		.", ";
		$sql.= "aluga           = " . (int)$s->getAluga()			.", ";
		$sql.= "venda           = " . (int)$s->getVenda()			.", ";
		$sql.= "separarChave    = " . (int)$s->getSepararChave()	.", ";
		$sql.= "foto            = " . (int)$s->getFoto()			.", ";
		$sql.= "vistoria        = " . (int)$s->getVistoria()        .", "; 
		$sql.= $status;
		$sql.= "descricao       = " . limparTextoParaSQL($s->getDescricao())	.", ";
		$sql.= "outros          = " . limparTextoParaSQL($s->getOutros())       .", "; 
		$sql.= "problema        = " . limparTextoParaSQL($s->getProblema())     .", "; 
		$sql.= "providencia     = " . limparTextoParaSQL($s->getProvidencia())  .", "; 
		$sql.= "funcionario     = " . limparTextoParaSQL($s->getFuncionario())  .", "; 
		$sql.= "observacoes     = " . limparTextoParaSQL($s->getObservacoes())  ." "; 

		$sql.= "WHERE id = " . (int)$s->getId();



        try {
            $this->executarSQL($sql);
            return $this->buscarServico($s->getId());

        }catch (Exception $e) {

            throw new Exception($e->getMessage());

        }
    }

    function buscarUsuario($usuario) {

        $selectSql  = "SELECT * FROM tbusuarios WHERE id=";
        $selectSql .= (int)($usuario);
        $resultado = $this->executarSQL($selectSql);


        if ($resultado!= false) {

            $dados = mysql_fetch_assoc($resultado);

            /*Empacota usuario.*/
            return Usuario::empacotaUsuarioPorResultSet($dados);

        }else {
            return false;
        }
    }

    function buscarQuemCadastrouServico($idServico)
    {
    	$sql = "SELECT u.id AS id FROM tbusuarios u INNER JOIN tbeventos e ON e.usuario = u.id WHERE e.idAlteracao = " .(int) $idServico;

        $resultado = $this->executarSQL($sql);

        if($resultado != false)
        {
            $dados = mysql_fetch_assoc($resultado);

            $usuario = $this->buscarUsuario($dados['id']);

            return $usuario;
        }
    }

    function buscarUltimosServicosDeUsuario($idUsuario,$qtd)
    {
		$sql = "SELECT e.idAlteracao AS id FROM tbeventos e WHERE e.evento = 12 AND e.usuario = ".(int)$idUsuario . " ORDER BY data DESC LIMIT " . (int) $qtd;

		$resultado = $this->executarSQL($sql);


        $servicos = array();
        $i=0;

        while($resultSet = mysql_fetch_assoc($resultado)) {


			$s = $this->buscarServico($resultSet['id']);
            $servicos[$i] = $s;

            $i++;
        }

        return $servicos;
    } 
}

?>
