<?php

/* Autor: Gabriel Henrique Martinez Saraiva
 * Esse arquivo armazena as configurações dos cursos (tipos)
 * deve ser utilizado essa função ao solicitar os tipos de cursos
 *
 */

class TipoDeCurso{
	
	static $tipos = array(
		array(0,"Graduação"),
		array(1,"Mestrado"),
		array(2,"Especialização"),
		array(3,"Doutorado"),
		array(4,"Pós-Doutorado"),
		array(5,"Outros")
	);

	static public function getListaTipoCursos()
	{
		return self::$tipos;
	}

	static public function getNomeTipoCurso($id)
	{
		if($id < sizeof(self::$tipos))
		{
			return self::$tipos[$id][1];
		}
		else
		{
			return "TIPO DE CURSO INVALIDO";
		}
	}


}


?>