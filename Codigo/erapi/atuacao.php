<?php

/* Autor: Victor Hugo Cândido de Oliveira
 * Esse arquivo armazena as atuações
 *
 * Caso haja alguma mudança atualizar referência no scriptSelectOutros.js
 */

class Atuacao{
	
	static $atuacoes = array(
		array(0,"Graduação"),
		array(1,"Mestrado"),
		array(2,"Especialização"),
		array(3,"Doutorado"),
		array(4,"Pós-Doutorado"),
		array(5,"Prof. visitante"),
		array(6,"Palestrante"),
		array(7,"Outro")
	);

	static public function getListaAtuacoes()
	{
		return self::$atuacoes;
	}

	static public function getNomeAtuacao($id)
	{
		if($id < sizeof(self::$atuacoes))
		{
			return self::$atuacoes[$id][1];
		}
		else
		{
			return "ATUAÇÃO INVALIDO";
		}
	}


}


?>