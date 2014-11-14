<?php // TODO VERIFICAR ENDEREÇAMENTO, CONSIGO ACESSAR A PÁGINA SEM PARAMETROS
	/* Autor: Victor Hugo Cândido de Oliveira
	 * Script para manipular os estrangeiros.
	 * Esse script faz:
	 *
	 * 		1 - Cadastro
	 *		2 - Edição
	 *		3 - Exclusão
	 *
	 *
	 * Parametros recebidos:
	 *		
	 *		modo (cadastrar,editar,excluir)
	 *			Define o modo que o script vai operar.
	 *		id
	 *			Utilizado para editar e excluir
	 */

	require_once("scriptUploadFoto.php");
	require_once("permissao.php");
	require_once("simplex/utils.php");

	// -------------------------------------------------------------------------
	// Monta variável para verificação de permissão
	header('Content-Type: text/html; charset=utf-8');

	$usuario	= getUsuarioLogado();
	$isAdmin	= $usuario->permissao == Permissao::getIDPermissao("Administrador");
	$isUsuario	= $usuario->permissao == Permissao::getIDPermissao("Usuário");

	if(validaOperacao()) {
		$modo = sanitizeString($_GET['modo']);
		if($isAdmin || $isUsuario) {
			switch ($modo) {
				case 'cadastrar':
					cadastrarEstrangeiro();
					break;

				case 'editar':
					editarEstrangeiro();
					break;

				case 'excluir':
					excluirEstrangeiro();
					break;

				default:
					erro("Você não tem permissão para executar essa ação!",
					"index.php?page=estrangeiros");
			}
		}
		else {
			if($modo == 'cadastrar') {
				cadastrarEstrangeiro();
			}
			else {
				erro("Você não tem permissão para executar essa ação!",
					"index.php?page=estrangeiros");
			}
		}
	}
	else {
		erro("Erro de endereço!", "index.php?page=estrangeiros");
	}

	function validaOperacao() {
		$valido = false;

		if(isset($_GET['modo'])) {
			$modo = sanitizeString($_GET['modo']);
			switch($modo) {
				case 'cadastrar':
					$valido = true;
					break;

				case 'excluir': case 'editar':
					$valido = isset($_GET['id']) && sanitizeInt($_GET['id']) > 0;
					break;
			}
		}
		
		return $valido;
	}

	// Função que preenche um objeto R::estrangeiro apartir de um $_POST 
	function montarEstrangeiroPOST($estrangeiro)
	{
		$foto = uploadFoto();
		if($foto != null && $foto != "") {
			$estrangeiro->foto = $foto==null ? "" : $foto;
		}
		$estrangeiro->nome = sanitizeString($_POST['nome']);
		$estrangeiro->email = sanitizeString($_POST['email']);
		$estrangeiro->passaporte = sanitizeString($_POST['passaporte']);
		$estrangeiro->rne = sanitizeString($_POST['rne']);
		$estrangeiro->atuacao = sanitizeInt($_POST['atuacao']);
		$estrangeiro->curso = sanitizeInt($_POST['curso']);
		$estrangeiro->pais = sanitizeString($_POST['pais']);
		$estrangeiro->instituicao = sanitizeString($_POST['instituicao']);
		$estrangeiro->docente = sanitizeString($_POST['docente']);
		$estrangeiro->email_docente = sanitizeString($_POST['email_docente']);
		$estrangeiro->departamento = sanitizeInt($_POST['departamento'])."";
		$estrangeiro->atividade = $_POST['atividade'];
		$estrangeiro->data_chegada = dtBanco(sanitizeString($_POST['data_chegada']));
		$estrangeiro->data_saida = dtBanco(sanitizeString($_POST['data_saida']));
		$estrangeiro->excluido=0;

		if(isset($_POST['validado']) && $_POST['validado']=='on') {
			if($estrangeiro->validado != 1) {
				$estrangeiro->validado = 1;
				$estrangeiro->usuario_validador = getUsuarioLogado()->id;
				$estrangeiro->data_validacao = date('Y-m-d H:i:s');
			}
		}
		else {
			$estrangeiro->validado = 0;
		}
		return $estrangeiro;
	}



	function cadastrarEstrangeiro()
	{
		$paginaRetorno="index.php?page=estrangeiros";

		if($_POST != null ){
			$estrangeiro = montarEstrangeiroPOST(R::dispense('estrangeiro'));

			R::store($estrangeiro);

			sucesso("Estrangeiro $estrangeiro->nome foi cadastrado com sucesso!", $paginaRetorno);
		}
		else {
			erro("Endereço inválido!", $paginaRetorno);
		}
	}


	function editarEstrangeiro()
	{
		$paginaRetorno="index.php?page=estrangeiros";

		if($_POST != null ){
			$id = sanitizeInt($_GET['id']);

			$estrangeiro = R::load('estrangeiro',$id);
			$estrangeiroMontado = montarEstrangeiroPOST($estrangeiro);

			R::store($estrangeiroMontado);

			sucesso("O estrangeiro $estrangeiroMontado->nome foi atualizado com sucesso!",$paginaRetorno);

			/*
			TODO RETIRAR ESSE COMENTARIO
			foreach ($estrangeiroMontado as $e) {
				echo($e."<br>");
			}
			var_dump(implode('<br>', explode(',',$estrangeiroMontado)));*/
		}
		else {
			erro("Endereço inválido!", $paginaRetorno);
		}
	}

	function excluirEstrangeiro()
	{
		$paginaRetorno="index.php?page=estrangeiros";
		$id=sanitizeInt((int)$_GET['id']);

		$estrangeiro = R::load("estrangeiro",$id);
		$estrangeiro->excluido=true;

		R::store($estrangeiro);

		sucesso("Estrangeiro excluido com sucesso!", $paginaRetorno);
	}
?>