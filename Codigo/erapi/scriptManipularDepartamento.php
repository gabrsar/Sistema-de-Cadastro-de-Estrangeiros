<?php
/* Autor: Gabriel Henrique Martinez Saraiva
 * Script para manipular os departamentos.
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
$usuario = getUsuarioLogado();

if($usuario->permissao == Permissao::getIDPermissao("Administrador"))
{
	erro("Você não tem permissão para executar essa ação!",
		"index.php?page=configuracoesDepartamentos");
}
else
{
	// Detecta o modo de execução
	switch (sanitizeString($_GET['modo'])) {

		// Modos aceitos =====
		case 'cadastrar': 	cadastrarDepartamento();			break;
		case 'editar': 		editarDepartamento();				break;
		case 'excluir': 	excluirDepartamento();				break;
		// ====================
		default:			erro("Erro de endereco!", $paginaRetorno);	break;
	}
}


 /* Função que preenche um objeto R::departamento apartir de um $_POST */
function montarDepartamentoPOST($departamento)
{
	$departamento->nome=sanitizeString($_POST['nome']);
	$departamento->excluido=0;


	if(!$departamento->nome && trim($departamento->nome) < 1)
	{
		erro("Nenhum nome foi fornecido para o departamento!", $paginaRetorno);
	}

	return $departamento;
} 

function cadastrarDepartamento()
{
	$paginaRetorno="index.php?page=configuracoesDepartamentos";

	$departamento = montarDepartamentoPOST(R::dispense('departamento'));

	R::store($departamento);

	sucesso("Departamento $departamento->nome foi cadastrado com sucesso!", $paginaRetorno);
}


function editarDepartamento()
{
    $paginaRetorno="index.php?page=configuracoesDepartamentos";
	$id = sanitizeInt($_GET['id']);
	if(!$id)
	{
		erro("Parâmetros incorretos!",$paginaRetorno);
	}
	
	$departamento = R::load('departamento',$id);

	$departamentoMontado = montarDepartamentoPOST($departamento);
	R::store($departamentoMontado);

	sucesso("O departamento $departamentoMontado->nome foi atualizado com sucesso!",$paginaRetorno);

}

function excluirDepartamento()
{
    $paginaRetorno="index.php?page=configuracoesDepartamentos";

	
	$id=sanitizeInt((int)$_GET['id']);
	if(!$id || ((int) $id) < 0)
	{	
		erro("Parâmetros incorretos!",$paginaRetorno);
	}

	$curso = R::load("departamento",$id);
	$curso->excluido=true;

	R::store($curso);

	sucesso("Departamento excluido com sucesso!", $paginaRetorno);
	
}                                                        


?>
