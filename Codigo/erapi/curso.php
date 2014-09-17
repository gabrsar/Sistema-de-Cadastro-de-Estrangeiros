<?php

/* Autor: Gabriel Henrique Martinez Saraiva
 * Esse arquivo armazena as configurações dos cursos (tipos)
 * deve ser utilizado essa função ao solicitar os tipos de cursos
 *
 *
 * Essa implementação não está me agradando. Logo irei mudá-la...Isso é meio que um STUB ou DRIVER, 
 * não lembro o nome certo...
 * POCOTÓ, POCOTÓ, POCOTÓ, POCOTÓ, POCOTÓ, POCOTÓ, ...
 */

class TipoDeCurso{
	
	static $tipos = array(
		array(0,"Outros"),
		array(1,"Graduação"),
		array(2,"Mestrado"),
		array(3,"Especialização"),
		array(4,"Doutorado"),
		array(5,"Pós-Doutorado")		
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