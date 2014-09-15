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



// Detecta o modo de execução

$modo="";
if(isset($_GET['modo']))
{
	$modo=$_GET['modo'];
	
	switch ($modo) {

		// Modos aceitos =====
		case 'cadastrar': 	cadastrarDepartamento();			break;
		case 'editar': 		editarDepartamento();				break;
		case 'excluir': 	excluirDepartamento();				break;
		// ====================
		default:			erro("Erro de endereco!", $paginaRetorno);	break;
	}
}
else
{
	erro("Erro de endereço!","inicio");
}



function cadastrarDepartamento()
{
	$paginaRetorno="index.php?page=configuracoesDepartamentos";

	$departamento = R::dispense('departamento');

	$departamento->nome=$_POST['nome'];
	$departamento->excluido=0;
	if(trim($departamento->nome) == "")
	{
		erro("Nenhum nome foi fornecido para o departamento!", $paginaRetorno);

	}

	$id = R::store($departamento);

	$d = R::load('departamento',$id);

	sucesso("Departamento $departamento->nome foi cadastrado com sucesso!", $paginaRetorno);
}


function editarDepartamento()
{
	$paginaRetorno="index.php?page=configuracoesDepartamentos";

sucesso("EDITADO!",$paginaRetorno);	
}

function excluirDepartamento()
{
	$paginaRetorno="index.php?page=configuracoesDepartamentos";

	
	$id=-1;
	$erro=0;
	if(isset($_GET['id']))
	{
		if(is_numeric($_GET['id']))
		{
			$id=$_GET['id'];
		}
		else
		{
			$erro=1;
		}
	}else
	{
		$erro=1;
	}

	if($erro)
	{
		erro("Parâmetros incorretos!",$paginaRetorno);
	}

	$departamento = R::load('departamento',$id);
	$departamento->excluido=true;

	R::store($departamento);

	sucesso("Departamento excluido com sucesso!", $paginaRetorno);
	
}


?>