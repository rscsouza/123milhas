<?php
/*
*Escreva uma função que receba como parâmetros os coeficientes de uma equação de segundo grau e retorne suas raízes.
*/
function equacaoSegundoGrau($a,$b,$c){
	$delta= pow($b,2) - (4*$a*$c);
	if($delta>0){
		$x1=(-$b-pow($delta,0.5))/(2*$a);
		$x2=(-$b+pow($delta,0.5))/(2*$a);
		echo "x1=$x1 ===== x2=$x2";
	}
	else{
		echo "Não pode ser calculado(delta negativo)";
	}
}
// chamada do método correspondente a expressão x^2 - 5*x +6
equacaoSegundoGrau(1,5,6);
?>