<?php
/* Autor: Gabriel Henrique Martinez Saraiva
 * Script para manipular os usuários.
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

require("permissao.php");


// Detecta o modo de execução
switch (sanitizeString($_GET['modo'])) {

	// Modos aceitos =====
	case 'cadastrar': 	cadastrarUsuario();				break;
	case 'editar': 		editarUsuario();				break;
	case 'excluir': 	excluirUsuario();				break;
	// ====================
	default:			erro("Erro de endereço!", $paginaRetorno);	break;
}

/* Função que preenche um objeto R::usuario apartir de um $_POST */

function montarUsuarioPOST()
{
	if(!$_POST)
	{
		erro("Conteúdo não definido!","index.php");
	}

	// Cria novo objeto usuário e preenche com valores do post	
	$usuario = R::dispense("usuario");

	// endereço de retorno em caso de erro
	$paginaRetorno="index.php?page=configuracoesUsuarios";  


	$usuario->nome = sanitizeString($_POST['nome']);
	if(!$usuario->nome || strlen(trim($usuario->nome)) < 1)
	{
		erro("Nenhum nome foi definido para o usuário!",$paginaRetorno);
	}

	$usuario->login = sanitizeString($_POST['login']);
	if(!$usuario->login || strlen(trim($usuario->login)) < 1)
	{
		erro("Nenhum login foi definido para o usuário!",$paginaRetorno);
	}

	$usuario->email = sanitizeString($_POST['email']);
	if(!$usuario->email || strlen(trim($usuario->email)) < 1)
	{
		erro("Nenhum email foi definido para o usuário!",$paginaRetorno);
	}

	$TAMANHO_MINIMO_SENHA = 6;

	$senha = $_POST['senha'];
	
	if(strlen($senha) < $TAMANHO_MINIMO_SENHA)
	{
		erro("Senha muito fraca. Utilize uma senha com pelo menos $TAMANHO_MINIMO_SENHA caracteres",$paginaRetorno);
	}

	$usuario->senha_hash = $senha;

	$usuario->permissao = sanitizeInt($_POST['permissao']);

	if($usuario->permissao != Permissao::getIDPermissao("Administrador"))
	{
		erro("Erro ao definir permissão do usuário!",$paginaRetorno);
	}
		
	$usuario->excluido=False;

	return $usuario;

	
}



function cadastrarUsuario()
{

	$paginaRetorno="index.php?page=configuracoesUsuarios";

	$usuario = montarUsuarioPOST();

	// Cifra a senha do usuário usando md5
	// Isso não é muito seguro, mas é o que da tempo de fazer.
	// Como os usuários vão fazer a gentileza de usar senhas como 123 
	// isso não vai fazer muita diferença.

	$usuario->senha_hash = md5($usuario->$senha);

	try {
		R::store($usuario); 
	} catch (Exception $e) {
		erro("Não foi possivel cadastrar o usuário.",$paginaRetorno);
	}

	sucesso("Usuario $usuario->nome foi cadastrado com sucesso!", $paginaRetorno);
}


function editarUsuario()
{

	$paginaRetorno="index.php?page=configuracoesUsuarios";

	$id = sanitizeInt($_GET['id']);
	
	if(!$id || $id < 1)
	{
		erro("Parâmetros incorretos!",$paginaRetorno);
		return False;
	}

	if(!Permissao::usuarioPodeAcessarID($id))
	{
		erro("Você não tem permissão acessar esses dados!",$paginaRetorno);
		return False;
	}

	$usuarioArmazenado = R::load('usuario',$id);

	$usuarioMontado = montarUsuarioPOST();

	$usuario = getUsuarioLogado();

	if($usuario->permissao == Permissao::getIDPermissao("Administrador"))
	{
		$usuarioArmazenado->login = $usuarioMontado->login;			
		$usuarioArmazenado->nome = $usuarioMontado->nome;
		$usuarioArmazenado->email= $usuarioMontado->email;
		$usuarioArmazenado->permissao = $usuarioMontado->permissao;
	}

	if($usuario->senha_hash != $usuarioArmazenado->senha_hash)
	{
		$usuario->senha_hash = md5($usuario->senha_hash);
	}

	try {
		R::store($usuarioArmazenado);
	} catch (Exception $e) {
		erro("Não foi possivel editar o usuário.",$paginaRetorno);
	}
	

	sucesso("O usuário $usuarioArmazenado->nome foi atualizado com sucesso!",$paginaRetorno);	
}

function excluirUsuario()
{
	$paginaRetorno="index.php?page=configuracoesUsuarios";
	
	$id=sanitizeInt((int)$_GET['id']);
	if(!$id || $id < 0)
	{	
		erro("Parâmetros incorretos!",$paginaRetorno);
		return False;
	}

	$usuario = R::load("usuario",$id);
	
	$usuario->excluido=true;
	$usuario->senha_hash = rtrim(base64_encode(md5(microtime())),"=");


	try {
		R::store($usuario);
	} catch (Exception $e) {
		erro("Não foi possivel excluir o usuário.",$paginaRetorno);
	}
	sucesso("Usuario excluido com sucesso!", $paginaRetorno);	
}


?>
