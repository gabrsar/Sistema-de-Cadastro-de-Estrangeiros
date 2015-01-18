<?php

/* Autor: Gabriel Henrique Martinez Saraiva
 * Esse arquivo armazena os tipos de permissões dos usuários
 * devem ser utilizadas as funções dessa classe ao trabalhar com permissões.
 */

class Permissao{
	
	static $tipos = array(
		array(0,"Administrador"),
		array(1,"Usuário"),
		array(2,"Espectador"),
	);

	static public function getListaPermissao()
	{
		return self::$tipos;
	}

	static public function getIDPermissao($texto)
	{

		// Essa função não é escalavel. Mas como o número de usuários do
		// sistema é pequeno não há problemas. Caso o sistema possua mais de
		// 100 usuários ou essa função seja utilizada muitas vezes, 
		// ela pode começar a ser um gargalo no sistema.
		// Um dia eu penso em algo mais "melhor".

		foreach(self::$tipos as $nome => $tipo)
		{
			if($tipo[1] == $texto)
			{
				return $tipo[0];
			}
		}
		return "ID INESISTENTE!";

	}

	static public function getNomePermissao($id)
	{
		if($id < sizeof(self::$tipos))
		{
			return self::$tipos[$id][1];
		}
		else
		{
			return False;
		}
	}



	static public function usuarioPodeAcessarID($id)
	{
		// Função que retorna se o usuário LOGADO pode manipular o usuário com $id

		$usuarioLogado=getUsuarioLogado();

		if($usuarioLogado->permissao == Permissao::getIDPermissao("Administrador"))
		{
			return True;
		}
		else if($usuarioLogado->id == $id)
		{
			return True;
		}
		
		return False;
	}
}

?>