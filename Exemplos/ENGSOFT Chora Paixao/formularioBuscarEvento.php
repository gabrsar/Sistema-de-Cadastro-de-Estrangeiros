<?php require_once("start.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $titulo; ?></title>
        <link href="temas/tema1.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-latest.js"></script>
        <script type="text/javascript" src="js/jquery.corner.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="js/jquery.quicksearch.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
        <script type="text/javascript" id="js">$(document).ready(function() {
            // call the tablesorter plugin
            $("table")
            .tablesorter({widgets: ['zebra']})
            .tablesorterPager({container: $("#pager")});
        });
        </script>
    </head>
    <body>
        <?php require_once("topo.php"); ?>
        <?php require_once("menu.php"); ?>

        <div class="formulario"><span class="titulo" >Consulta de Eventos</span>

            <table class="tablesorting listaDeResultado" cellpadding="3px" border="1px" cellspacing="2px">
                <thead>
                    <tr class="cabecalho" align="center">
                        <th>Usuário</th>
                        <th>Evento</th>
                        <th>Alvo</th>
                        <th>Data</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $gab = new GAB();
                    $eventos = $gab->buscarEventos($_POST['usuario'],$_POST['evento']);

                    foreach($eventos as $e) {
                        echo ("<tr>\n");
                        echo ("<td>\n\t".$e->getUsuario()->getNome()."</td>");
                        echo ("<td>\n\t".$e->getEventoTexto()."</td>");

                        $tdAlvo = "<td>\n\t%s</td>";
                        $alvo = '<a href="%s?id=%s" >%s</a>';


                        switch ($e->getEvento()) {

                            //Usuarios
                            case 2:
                            case 3:
                            case 4:
                            case 5:
                            case 6:
                            case 7:
                                $usuario = new Usuario();
                                $usuario->setId($e->getIdAlteracao());
                                $uAlvo = $gab->buscarUsuario($usuario);
                                $alvo=sprintf($alvo,"formularioAlterarUsuario.php",$e->getIdAlteracao(),$uAlvo->getNome());

                                $tdAlvo=sprintf($tdAlvo,$alvo);
                                break;

                            //Imoveis
                            case 8:
                            case 9:
                            case 10:
                            case 11:
                                $i = new Imovel();
                                $i->setId($e->getIdAlteracao());
                                $iAlvo=$gab->buscarImovel($i);
                                $alvo=sprintf($alvo,"formularioAlterarImovel.php",$e->getIdAlteracao(),$iAlvo->toString());

                                $tdAlvo=sprintf($tdAlvo,$alvo);
                                break;

                            //Serviços
                            case 12:
                            case 13:
                            case 14:
                            case 15:

                                $s = new Servico();
                                $s->setId($e->getIdAlteracao());
                                $sAlvo=$gab->buscarServico($s);

                                $alvo=sprintf($alvo,"formularioAlterarServico.php",$e->getIdAlteracao(),"CS".$sAlvo->getId()." ".$sAlvo->toString());

                                $tdAlvo=sprintf($tdAlvo,$alvo);
                                break;

                            default: $tdAlvo="";

                        }

                        echo $tdAlvo;

                        echo ("<td>\n\t".date("d/m/Y - H:i:s",strtotime($e->getData()))."</td>");
                        echo ("<td>\n\t".$e->getValor()."</td>");
                        echo ("</tr>");


                    }


                    ?>
                </tbody>
            </table>
            <br/>
            <div id="pager" class="pager">
                <form>
                    <img src="addons/pager/icons/first.png" class="first"/>
                    <img src="addons/pager/icons/prev.png" class="prev"/>
                    <input type="text" class="pagedisplay"/>
                    <img src="addons/pager/icons/next.png" class="next"/>
                    <img src="addons/pager/icons/last.png" class="last"/>
                    <select class="pagesize">
                        <option selected="selected"  value="10">10</option>

                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option  value="40">40</option>
                    </select>
                </form>
            </div>
            <br/>
            <br/>



            <a class="botao" href="formularioCadastrarImovel.php">Novo</a>
            <br/><br/>
            <div id="painelDeFiltro">
                <span class="titulo" >Painel de filtros</span>

                <form action="formularioBuscarEvento.php" method="post">

                    <p><label>Usuário</label>
                        <select name="usuario">
                        </select>
                    </p>
                    <p><label>Evento</label>
                        <select name="evento">
                            <option value ="-1">TODOS</option>
                            <option value ="0">DESCONHECIDOS</option>
                            <option value ="1">ERRO</option>
                            <option value ="2">LOGIN</option>
                            <option value ="3">LOGOFF</option>
                            <option value ="4">CADASTRAR USUARIO</option>
                            <option value ="5">ALTERAR USUARIO</option>
                            <option value ="6">CONSULTAR USUARIO</option>
                            <option value ="7">EXCLUIR USUARIO</option>
                            <option value ="8">CADASTRAR IMOVEL</option>
                            <option value ="9">ALTERAR IMOVEL</option>
                            <option value ="10">CONSULTAR IMOVEL</option>
                            <option value ="11">EXCLUIR IMOVEL</option>
                            <option value ="12">CADASTRAR SERVICO</option>
                            <option value ="13">ALTERAR SERVICO</option>
                            <option value ="14">CONSULTAR SERVICO</option>
                            <option value ="15">EXCLUIR SERVICO</option>
                        </select>
                    </p>
                    <p> <input class="botaoBuscar" type="submit" value="Filtrar" /> </p>

                </form>
            </div>

        </div>
    </body>
</html>
