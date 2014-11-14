<?php

	/* Autores: Gabriel Henrique Martinez Saraiva
	 *			Victor Hugo Cândido de Oliveira
	 *			Carlos Henrique Severino (Caik)
 	 * Arquivo com funções genéricas
 	 */

	function erro($mensagem, $encaminhar)
	{

		$_SESSION['erroMensagem']=$mensagem;
		$_SESSION['erroGoto']=$encaminhar;

		header("location:index.php?page=erro");
	}

	function sucesso($mensagem,$encaminhar)
	{

		$_SESSION['sucessoMensagem']=$mensagem;
		$_SESSION['sucessoGoto']=$encaminhar;
		
		header("location:index.php?page=sucesso");
	}

	function getUsuarioLogado()
	{


		if(isset($_SESSION['usuarioLogado']))
		{

			return R::load('usuario',$_SESSION['usuarioLogado']->id);
			
		}
		else
		{
			erro("SEM USUÁRIO LOGADO","index.php");
			return NULL;
		}
	}
				
	function dtPadrao($data) 
	{
		$data = trim($data);
		if (strlen($data) < 10)
		{
			$rs = "";
		}
		else
		{
			$arr_data = explode(" ",$data);
			$data_db = $arr_data[0];
			$arr_data = explode("-",$data_db);
			$data_form = $arr_data[2]."/".$arr_data[1]."/".$arr_data[0];
			$rs = $data_form;
		}
		return $rs;
	}

	function dtBanco($data) {
		$data = trim($data);
		if(strlen($data) < 10) {
			$rs = "";
		}
		else {
			$arr_data = explode('/', $data);
			$data_banco = $arr_data[2].'-'.$arr_data[1].'-'.$arr_data[0];
			$rs = $data_banco;
		}
		return $rs;
	}
?>
