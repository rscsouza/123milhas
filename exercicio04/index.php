<?php
require_once("config.php");
/*
* Criação de 2 voos com suas respectivas bagagens e cargas vivas
*/

$voo1=new Flight("Voo1","123milhas","Belo Horizonte","Sao Paulo", new DateTime(), new DateTime(),500);
$voo2=new Flight("Voo2","123milhas","Sao Paulo","Rio de Janeiro", new DateTime(), new DateTime(),2000);


$item1Voo1= new ItemCarga("bg1","Mala",10,500,true,false);
$item2Voo1= new ItemCarga("bg3","Bolsa",30,1000,true,false);

$voo1->adicionarItemCarga($item1Voo1);
$voo1->adicionarItemCarga($item2Voo1);


$item1Voo2= new ItemCarga("chc3","Cachorro",10,0,false,true);
$item2Voo2= new ItemCarga("bg2","Mala",30,1000,true,false);


$voo2->adicionarItemCarga($item1Voo2);
$voo2->adicionarItemCarga($item2Voo2);

$checkout= new Checkout($voo1,$voo2);
echo "<h2>EXIBIÇÃO DO EXTRATO COMPLETO</h2>";
var_dump($checkout->generateExtract());

?>