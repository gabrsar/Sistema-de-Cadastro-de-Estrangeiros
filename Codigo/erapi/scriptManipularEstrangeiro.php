<?php
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
	$usuario = getUsuarioLogado();

	// Monta variável com o modo da operação
	$modo = isset($_GET['modo']) ? sanitizeString($_GET['modo']) : null;

	// Verifica se possui id
	$idOk = isset($_GET['id']) && sanitizeInt($_GET['id']) > 0;

	if($usuario != null) {
		$isAboveUsuario	= ($usuario->permissao <= Permissao::getIDPermissao("Usuário"));
		if($isAboveUsuario) {

			switch($modo) {
				case 'cadastrar':
					cadastrarEstrangeiro();
					break;

				case 'editar':
					$idOk ? editarEstrangeiro() : erro("Erro ao encontrar estrangeiro!", "index.php?page=estrangeiros");
					break;

				case 'excluir':
					$idOk ? excluirEstrangeiro() : erro("Erro ao encontrar estrangeiro", "index.php?page=estrangeiros");
					break;

				default:
					erro("Erro de endereço!", "index.php?page=estrangeiros");
			}
		} // if($isAboveUsuario)
		else {
			erro("Você não tem permissão para executar essa ação!",
					"index.php?page=estrangeiros");
		}
	} // if($usuario != null)
	else {
		cadastrarEstrangeiroPublico();
	}

/*start of debugging
ob_start();
var_dump(implode('<br>', explode(',',$usuario))); //quero ver o que tem no usuario quando acessado da página publica
$result = ob_get_clean();
echo '<script type="text/javascript">alert("' . $result . '");</script>';
var_dump(implode('<br>', explode(',',$usuario)));
//end of debugging
*/

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

	function cadastrarEstrangeiroPublico() {
		$paginaRetorno='http://www.ibilce.unesp.br/#!/administracao/staepe/erapi/'; //DIRECIONAR PARA TABELA PUBLICA

		if($_POST != null ){
			$estrangeiro = montarEstrangeiroPOST(R::dispense('estrangeiro'));

			R::store($estrangeiro);

			sucesso("Estrangeiro $estrangeiro->nome foi cadastrado com sucesso!<br>Aguarde contato.", $paginaRetorno);
		}
		else {
			// TODO VERIFICAR PQ NÃO REDIRECIONA PARA O LUGAR CERTO
			session_start();
			erro("Sem dados para cadastro", $paginaRetorno);
		}
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
			erro("Sem dados para cadastro", $paginaRetorno);
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
		}
		else {
			erro("Sem dados para a edição", $paginaRetorno);
		}
	}

	function excluirEstrangeiro()
	{
		$paginaRetorno="index.php?page=estrangeiros";
		$id=sanitizeInt((int)$_GET['id']);

		$estrangeiro = R::load("estrangeiro",$id);

		R::trash($estrangeiro);

		sucesso("Estrangeiro excluido com sucesso!", $paginaRetorno);
	}
?>