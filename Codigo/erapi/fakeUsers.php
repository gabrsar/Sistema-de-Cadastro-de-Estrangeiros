<?php

/* Autor: Gabriel Henrique Martinez Saraiva
 * Arquivo para criar o usuário admin.
 * Posteriormente esse arquivo será expandido para inicializar todo o banco de
 * dados.
 */

require("rb/db.php");
rbSetup();
echo ("Criando usuários de teste!");


$login="admin";
$senha="sce";

$usuario = R::dispense('usuario');

$usuario->nome="Administrador";
$usuario->login="admin";
$usuario->senha_hash=md5($login.$senha);
$usuario->email="amin@email.com.br";
$usuario->permissao=0;
$usuario->excluido=false;

R::store($usuario);
echo "Usuário criado:. <br>";

?>
