
<form name="teste" action="#" method="post">
    <input name="texto"/>     <input type="submit"/>
</form>


<?php


include ("dados.php");
echo "Recebido: " . $_POST["texto"]."<br>";
echo "Inteligente: " . limparParaBuscaInteligente($_POST["texto"])."<br>";
echo "Simples: " . limparTextoParaSQL($_POST["texto"])."<br>";
?>


