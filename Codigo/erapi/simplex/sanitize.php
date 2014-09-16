<?php
	/* Autor: Gabriel Henrique Martinez Saraiva
	 * Funções úteis para validar e sanitizar variaveis de entrada.
	 *
	 * Link útil: http://www.dreamhost.com/dreamscape/2013/05/22/php-security-user-validation-and-sanitization-for-the-beginner/
	 * 
	 * As funções desse arquivo só devem serem implementadas ao surgir a necessidade, isso evita lixo.
	 */



	function sanitizeInt($int)
	{
		/* Função que recebe um parametro, verifica se está definido e se é um inteiro */
		if(!isset($int))
		{
			return False;
		}

		if(!is_int($int))
		{
			return False;
		}

		return (int) $int;
	}

	function sanitizeString($string)
	{
		/* Função que recebe um parametro, verifica se está definido e se é uma string.
		 * Além disso passa o parâmetro por uma sanitização de caracteres indesejados.
		 */

		if(!isset($string))
		{
			return False;
		}

		if(!is_string($string))
		{
			return False;
		}

		return strip_tags(htmlentities($string));
	}
?>
