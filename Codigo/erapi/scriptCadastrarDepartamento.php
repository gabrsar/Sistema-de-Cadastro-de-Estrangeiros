<?php

$departamento = R::dispense('departamento');

$v=$_POST['nome'];

$departamento->nome=$v;

$id = R::store($departamento);

$d = R::load('departamento',$id);
R::close();
echo ("O departamento {$d->nome} foi cadastrado com sucesso.");


header("location:index.php?page=Departamento");

?>
