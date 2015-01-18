<?php

/* Autor: Gabriel Henrique Martinez Saraiva
 * Função para conexão com o banco de dados e a "configuração" do RebBean
 * Essa página é importada na scriptMaster.php, assim não necessita ser 
 * importada em todas as páginas.
 *
 */

function rbSetup()
{
	require 'rb.php';

	$host="localhost";
	$db="erapi";
	$user="erapi";
	$password="erapi";
	
	R::setup("mysql:host=$host;dbname=$db",$user,$password);
}
?>
