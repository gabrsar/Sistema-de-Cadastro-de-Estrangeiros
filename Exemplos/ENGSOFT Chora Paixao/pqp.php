 <?php
require_once("start.php");
validaSessao();
?>




<?php

 echo "oi";

 $s = new Servico();
    $s->setId(1); 
    
				
   $data =  $s->getDataCadastro();
//	$data = $gab->buscarDataDeCadastroDeServico(1);

   dump($data);
	echo "ashdfuhasfuhs";
?>
          
