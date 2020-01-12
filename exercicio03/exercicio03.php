<?php
// texto a ser pesquisado
$texto="Melhor preço sem escalas R$ 1.367(1)
Melhor preço com escalas R$ 994 (1)

1 - Incluindo todas as taxas";

//expressão regular para extrair os caracteres
$padrao="/([a-z\ç\$\-\.])+/i";
$alterarPor="";
// ocorrências da expressão regular são substituidas por ""
$novoTexto=preg_replace($padrao, $alterarPor, $texto);
// texto retornado é explodido na string(1)
$partes=explode("(1)",$novoTexto);

echo "Texto base:".$texto."<hr>";

//precisamos dos 2 primeiros valores, por isso consideramos somente estes itens no for
echo "Valores avaliados:<hr>";
for($i=0;$i<2;$i++){
	$partes[$i]=floatval(trim($partes[$i]));
	echo $partes[$i]."<br>";
}

// verificação de valores
if($partes[0]<$partes[1]){
	echo "O menor valor é R$".number_format($partes[0],2);
}
else
if($partes[1]<$partes[0]){
	echo "O menor valor é R$".number_format($partes[1],2);
}
else{
	echo "Ambos os valores são menores R$".number_format($partes[0],2);
}
?>