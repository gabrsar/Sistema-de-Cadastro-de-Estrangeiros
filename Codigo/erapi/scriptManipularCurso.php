<?php
/* Autor: Gabriel Henrique Martinez Saraiva
 * Script para manipular os cursos.
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
require("curso.php");

$listaCursos=obterListaDeCursos();


// Detecta o modo de execução

$modo="";
if(isset($_GET['modo']))
{
	$modo=$_GET['modo'];
	
	switch ($modo) {

		// Modos aceitos =====
		case 'cadastrar': 	cadastrarCurso();			break;
		case 'editar': 		editarCurso();				break;
		case 'excluir': 	excluirCurso();				break;
		// ====================
		default:			erro("Erro de endereço!", $paginaRetorno);	break;
	}
}
else
{
	erro("Erro de endereço!","inicio");
}


function montarCursoPOST($curso)
{

	$curso->nome=sanitizeString($_POST['nome']);
	$curso->tipo=sanitizeInt($_POST['tipo']);
	$curso->excluido=0;

	if($curso->nome && trim($curso->nome) < 1)
	{
		erro("Nenhum nome foi fornecido para o curso!", $paginaRetorno);
	}

	if(!$curso->tipo)
	{
		erro("Tipo de curso não está definido!", $paginaRetorno);
	}

	return $curso;
}

function cadastrarCurso()
{
	$paginaRetorno="index.php?page=configuracoesCursos";

	$curso = montarCursoPOST(R::dispense('curso'));	

	$id = R::store($curso);

	sucesso("Curso $curso->nome foi cadastrado com sucesso!", $paginaRetorno);
}


function editarCurso()
{
	$paginaRetorno="index.php?page=configuracoesCursos";

	$id = sanitizeInt($_GET['id']);
	if(!$id)
	{
		erro("Parâmetros incorretos!",$paginaRetorno);
	}

	$curso = montarCursoPOST(R::load('curso',$id));

	R::store($curso);

	sucesso("O curso",$paginaRetorno);	
}

function excluirCurso()
{
	$paginaRetorno="index.php?page=configuracoesCursos";

	
	$id=sanitizeInt($_GET['id']);
	if(!$id || ((int) $id) < 0)
	{	
		erro("Parâmetros incorretos!",$paginaRetorno);
	}

	$curso = R::load('curso',$id);
	$curso->excluido=true;

	R::store($curso);

	sucesso("Curso excluido com sucesso!", $paginaRetorno);
	
}


?>