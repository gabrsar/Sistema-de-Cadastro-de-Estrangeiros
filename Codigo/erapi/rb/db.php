<?php

/* Autor: Gabriel Henrique Martinez Saraiva
 * Função para conexão com o banco de dados e a "configuração" do RebBean
 * Essa página é importada na scriptMaster.php, assim não necessita ser 
 * importada em todas as páginas.
 *
 *
 * !!! Enquanto estivermos em produção recomendo que utilizemos os mesmos 
 * usuários para simplificar o acesso ao banco de dados.
 *
 *
 */

function rbSetup()
{
	require 'rb.php';

	$host="localhost";
	$db="erapi";
	$user="sce";
	$password="sce";
	
	R::setup("mysql:host=$host;dbname=$db",$user,$password);
}
?>
