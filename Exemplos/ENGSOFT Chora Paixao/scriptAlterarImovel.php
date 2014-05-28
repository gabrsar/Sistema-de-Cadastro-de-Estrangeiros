<?php
include('start.php');
validaSessao();



$in = new Imovel(); //Imovel novo




$in->setId($_POST['id']);
$in->setIdm($_POST['idm']);


if($_POST['setor'] == 0)
{
	$in->setAluga(1);
	$in->setVenda(0);
}
else if($_POST['setor'] == 1)
{
	$in->setAluga(0);
	$in->setVenda(1);
}
else 
{
	$in->setAluga(1);
	$in->setVenda(1);
}

$in->setAutorizacao           (						$_POST['autorizacao']       );
$in->setBairro                (						$_POST['bairro']            );
$in->setComplemento           (						$_POST['complemento']       );
$in->setCondominioFechado     (						$_POST['condominioFechado'] );
$in->setContato               (						$_POST['contato']           );
$in->setCorretor              (						$_POST['corretor']          );
$in->setLocalizacao           (						$_POST['localizacao']       );

$l="";

if($_POST['classe_logradouro'] != "OUTROS")
{
	  $l = $_POST['classe_logradouro'] . " " ;
}

$l.=$_POST['logradouro'];
$in->setLogradouro			  ( $l);

$in->setLoteamento            (						$_POST['loteamento']        );
$in->setLote                  (						$_POST['lote']              );
$in->setMapa                  (						$_POST['mapa']              );
$in->setNumeroDaChave         (						$_POST['numeroDaChave']     );
$in->setNumero                (						$_POST['numero']            );
$in->setOutros                (						$_POST['outros']            );
$in->setPlaca                 (						$_POST['placa']             );
$in->setQuadra                (						$_POST['quadra']            );
$in->setTerreno               (						$_POST['terreno']           );
$in->setTipoDePlaca           (						$_POST['tipoDePlaca']       );

$gab = new GAB();
try {
    $imovelAtualizado = $gab->alterarImovel($in);
    $evento = new Evento();
    $evento->setUsuario($usuarioLogado);
    $evento->setEvento("ALTERAR_IMOVEL");
    $evento->setIdAlteracao($imovelAtualizado->getId());
    $gab->cadastrarEvento($evento);


	header("Location: formularioAlterarImovel.php?id=".$in->getId());

}catch (Exception $e) {
}

?>


