<?php

$departamento = R::dispense('departamento');

$id=$_GET['id'];

$dep = R::load('departamento',$id);

R::trash($dep);

header("location:index.php?page=Departamento");
?>
