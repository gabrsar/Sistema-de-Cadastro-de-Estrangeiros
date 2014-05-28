<?php
include('start.php');
validaSessao();
?>


<?php
$s = new Servico();

$s->setIdImovel($_POST['idImovel']);
$s->setSepararChave($_POST['separar_chave']);
$s->setFoto($_POST['fotos']);
$s->setVistoria($_POST['vistoria']);

$s->setDescricao("");
$s->setOutros($_POST['outros']);
$s->setProblema($_POST['problema']);
$s->setProvidencia("");
$s->setFuncionario("");
$s->setObservacoes(""); 
$s->setStatusFinal(0);

$s->setColocacao(0);
$s->setRetirada(0);
$s->setAluga(0);
$s->setVenda(0);
switch($_POST['servico_placa'])
{
	case "1":
		$s->setColocacao(1);
		$s->setAluga(1);
		break;
	case "2":
		$s->setColocacao(1);
		$s->setVenda(1);
		break;
	case "3":
		$s->setColocacao(1);
		$s->setVenda(1);
		$s->setAluga(1);
		break;
 	case "4":
		$s->setRetirada(1);
		$s->setAluga(1);
		break;
	case "5":
		$s->setRetirada(1);
		$s->setVenda(1);
		break;
	case "6":
		$s->setRetirada(1);
		$s->setVenda(1);
		$s->setAluga(1);
		break;
	default:
		break;

}

$gab = new GAB();
try {

	$s = $gab->cadastrarServico($s,$usuarioLogado);
    $evento = new Evento();
    $evento->setUsuario($usuarioLogado);
    $evento->setEvento("CADASTRAR_SERVICO");
    $evento->setIdAlteracao($s->getId());
    
	$gab->cadastrarEvento($evento);

    header("Location: ./formularioBuscarServico.php");

}catch (Exception $e) {

    echo $e->getMessage();

}
