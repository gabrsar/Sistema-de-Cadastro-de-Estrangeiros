<?php

function rbSetup()
{
	require 'rb.php';

	$host="localhost";
	$db="erapi";
	$user="root";
	$password="gabriel";
	
	R::setup("mysql:host=$host;dbname=$db",$user,$password);
}
?>
