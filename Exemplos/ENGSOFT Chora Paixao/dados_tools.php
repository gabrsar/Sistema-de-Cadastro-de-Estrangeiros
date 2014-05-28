<?php

function dump($var)
{
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

function protegerSQL($in)
{




	// Completar essa função.
	if(is_numeric($in))
	{
		return $in;
	}

	if(is_string($in))
	{

		
/*
		$inArray = str_split($in);
		if($inArray[0] != "'")
		{
			$in = "'" . $in;
		}

		if($inArray[strlen($in)-1] != "'")
		{
			$in = $in . "'";
		}
		$in = str_replace(";"," e ",$in);
  */
		return "'".trim($in)."'";
	}

	die("ERRO!");
}



 //função que formata a data
function formata_data($data)
{
 //recebe o parâmetro e armazena em um array separado por -
 $data = explode('/', $data);
 //armazena na variavel data os valores do vetor data e concatena /
 $data = $data[2].'/'.$data[1].'/'.$data[0];
 
 //retorna a string da ordem correta, formatada
 return $data;
}
 
 
function gravarErro($erro)
{
	$arquivoDeErros = "fail.log";
	
	$a = fopen($arquivoDeErros,"a+");
	echo($erro);
	fwrite($a,$erro);
	fclose($a);
}


/* Função utilizada para trabalhar com mais de 1 submit por formulário.
   Função vinda de: http://simplesideias.com.br/multiplos-botoes-submit-em-um-formulario/
*/
function get_post_action($name)
{
    foreach ($name as $x) {

        if (isset($_POST[$x])) {
            return $x;
        }
    }
}

function  limparParaBuscaInteligente($texto) {

    $novaString = $texto;

    $novaString = str_replace("a", "_",$novaString);
    $novaString = str_replace("e", "_",$novaString);
    $novaString = str_replace("i", "_",$novaString);
    $novaString = str_replace("o", "_",$novaString);
    $novaString = str_replace("u", "_",$novaString);

    $novaString = str_replace("á", "_",$novaString);
    $novaString = str_replace("é", "_",$novaString);
    $novaString = str_replace("í", "_",$novaString);
    $novaString = str_replace("ó", "_",$novaString);
    $novaString = str_replace("ú", "_",$novaString);

    $novaString = str_replace("à", "_",$novaString);
    $novaString = str_replace("è", "_",$novaString);
    $novaString = str_replace("ì", "_",$novaString);
    $novaString = str_replace("ò", "_",$novaString);
    $novaString = str_replace("ù", "_",$novaString);

    $novaString = str_replace("ã", "_",$novaString);
    $novaString = str_replace("õ", "_",$novaString);
    $novaString = str_replace("ñ", "_",$novaString);

    $novaString = str_replace("ä", "_",$novaString);
    $novaString = str_replace("ë", "_",$novaString);
    $novaString = str_replace("ï", "_",$novaString);
    $novaString = str_replace("ö", "_",$novaString);
    $novaString = str_replace("ü", "_",$novaString);

    $novaString = str_replace("â", "_",$novaString);
    $novaString = str_replace("ê", "_",$novaString);
    $novaString = str_replace("î", "_",$novaString);
    $novaString = str_replace("ô", "_",$novaString);
    $novaString = str_replace("û", "_",$novaString);

    $novaString = str_replace(" ", "%",$novaString);
    $novaString = str_replace(".", "%",$novaString);
    $novaString = str_replace("&", "%",$novaString);
    $novaString = str_replace("-", "%",$novaString);
    $novaString = str_replace("\"", "%",$novaString);
    $novaString = str_replace("/", "%",$novaString);
    $novaString = str_replace("*", "%",$novaString);
    $novaString = str_replace("\\", "%",$novaString);
    $novaString = str_replace("+", "%",$novaString);
    $novaString = str_replace("@", "%",$novaString);
    $novaString = str_replace("#", "%",$novaString);
    $novaString = str_replace("%", "%",$novaString);
    $novaString = str_replace("¨", "%",$novaString);
    $novaString = str_replace("(", "%",$novaString);
    $novaString = str_replace(")", "%",$novaString);
    $novaString = str_replace("§", "%",$novaString);
    $novaString = str_replace(";", "%",$novaString);
    $novaString = str_replace("ª", "%",$novaString);
    $novaString = str_replace("º", "%",$novaString);
    $novaString = str_replace("]", "%",$novaString);
    $novaString = str_replace(":", "%",$novaString);
    $novaString = str_replace("[", "%",$novaString);
    $novaString = str_replace("{", "%",$novaString);
    $novaString = str_replace("´", "%",$novaString);
    $novaString = str_replace("`", "%",$novaString);
    $novaString = str_replace("}", "%",$novaString);
    $novaString = str_replace("^", "%",$novaString);
    $novaString = str_replace("<", "%",$novaString);
    $novaString = str_replace(">", "%",$novaString);
    $novaString = str_replace("$", "%",$novaString);
    $novaString = str_replace("!", "%",$novaString);
    $novaString = str_replace("?", "%",$novaString);

    $novaString = str_replace("Rua", "%",$novaString);
    $novaString = str_replace("Av", "%",$novaString);

    $novaString = str_replace("R.", "%",$novaString);
    $novaString = str_replace("Av.", "%",$novaString);

    $novaString = str_replace("Sra.", "%",$novaString);
    $novaString = str_replace("Sr.", "%",$novaString);

    $novaString = str_replace("lh", "%",$novaString);
    $novaString = str_replace("sh", "%",$novaString);
    $novaString = str_replace("mh", "%",$novaString);
    $novaString = str_replace("ss", "%",$novaString);
    $novaString = str_replace("s", "%",$novaString);
    $novaString = str_replace("ç", "%",$novaString);
    $novaString = str_replace("x", "%",$novaString);
    $novaString = str_replace("z", "%",$novaString);
    $novaString = str_replace("h", "%",$novaString);

    return $novaString;
}


function limparTexto($texto) {

	$caracteresInvalidos = array("<", ">", "\\", "/", "=", "'", "?","$");
    $caracteresRespectivos=array("&lt;", "&gt;", "-" , "-", "-", "", "_","s");

    $textoLimpo=str_replace($caracteresInvalidos, $caracteresRespectivos, $texto);
    return $textoLimpo;

}

function limparTextoParaSQL($texto) {
    $textoLimpo = "'".limparTexto($texto)."'";
    return $textoLimpo;
}

function limparTextoParaPesquisaSQL($texto) {
    $textoLimpo = "'%".limparTexto($texto)."%'";

    while(strpos("%%",$textoLimpo)>0) {
        $textoLimpo = str_replace("%%","%",$textoLimpo);
    }

    while(strpos("''",$textoLimpo)>0) {
        $textoLimpo = str_replace("''","'",$textoLimpo);
    }
    return $textoLimpo;
}

function criptNum($num) {

    $cNum = ($num * 7790 * 3.14)/5000;
    return $cNum;
}

function criptReverseNum($num) {

    $tmp = ($num *5000);
    $ucNum = $tmp/(3.14*7790);
    return $ucNum;
}            

?>
