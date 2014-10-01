<?php

/* Autor: Gabriel Henrique Martinez Saraiva
 * Esse arquivo armazena os tipos de permissões dos usuários
 * devem ser utilizadas as funções dessa classe ao trabalhar com permissões.
 *
 */

class Permissao{
	
	static $tipos = array(
		array(0,"Administrador"),
		array(1,"Usuário"),
		array(2,"Espectador"),
	);

	static public function getListaTipoPermissao()
	{
		return self::$tipos;
	}

	static public function getNomePermissao($id)
	{
		if($id < sizeof(self::$tipos))
		{
			return self::$tipos[$id][1];
		}
		else
		{
			return "PERMISSÃO INVÁLIDA";
		}
	}


}