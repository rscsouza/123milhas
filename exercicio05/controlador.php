<?php
require_once("config.php");

$acao=$_POST['acao'];
if($acao=="cadastrarNovoSabor"){
	$pizza=new Pizza($_POST['sabor'],$_POST['tamanho'],$_POST['valor']);
	array_push($_SESSION["gerenciamentoDeSabores"],serialize($pizza));
	cardapio();
}
else
if($acao=="editarItem"){
	$idItem=$_POST["item"];
	$item=unserialize($_SESSION["gerenciamentoDeSabores"][$idItem]);
	echo $item;
	die();
}
else
if($acao=="salvarAtualizacaoItem"){
	$idItem=$_POST["item"];
	$pizza=new Pizza($_POST['sabor'],$_POST['tamanho'],$_POST['valor']);
	$_SESSION["gerenciamentoDeSabores"][$idItem]=serialize($pizza);
	cardapio();
}
else
if($acao=="excluirItem"){
	$idItem=$_POST["item"];
	unset($_SESSION["gerenciamentoDeSabores"][$idItem]);
	cardapio();
}
else
if($acao=="excluirTodosSabores"){
	$_SESSION["gerenciamentoDeSabores"]=array();
}
else
if($acao=="adicionarAoPedido"){
	if(isset($_SESSION["gerenciamentoDePedidos"])){
		$pedido=unserialize($_SESSION["gerenciamentoDePedidos"]);
		$idItem=$_POST["item"];
		$pizza=unserialize(($_SESSION["gerenciamentoDeSabores"][$idItem]));
		$pedido->adicionarPizza($pizza);
		$pedido->historicoPedido();
		$_SESSION["gerenciamentoDePedidos"]=serialize($pedido);

	}
	else{
		echo("Você precisa criar um novo pedido informando telefone e endereco");
	}
}
else
if($acao=="criarPedido"){
	echo "Pedido criado para ".$_POST["telefone"]." em ". $_POST["endereco"]."<hr>";
	$pedido= new Pedido($_POST["telefone"],$_POST["endereco"]);
	$_SESSION["gerenciamentoDePedidos"]=serialize($pedido);
}
else
if($acao=="finalizarPedido"){
	echo "";
	unset($_SESSION["gerenciamentoDePedidos"]);
}	

function cardapio(){
	$cardapio="<table style='width:100%; border-style:solid; border-width:1px; border-color:#ccc; color:#2F4F4F; background-color:#ADFF2F;'><tr><td><b>Cardápio</b></td><td><b>Tamanho</b></td><td><b>Valores</b></td><td><b>Editar item</b></td><td><b>Excluir item</b></td><td></td></tr>";
	foreach($_SESSION["gerenciamentoDeSabores"] as $key=>$pizza){
		$pizza=unserialize($pizza);
		$cardapio.="<tr><td>".$pizza->getSabor()."</td>";
		$cardapio.="<td>".$pizza->getTamanho()."</td>";
		$cardapio.="<td>R$".number_format($pizza->getValor(),2)."</td>";
		$cardapio.="<td><button onclick='"."editarItem($key)';>Editar</button></td>";
		$cardapio.="<td><button onclick='"."excluirItem($key)';>Excluir</button></td>";
		$cardapio.="<td><button onclick='"."adicionarAoPedido($key)';>Adicionar ao pedido corrente</button></td></tr>";
	}
	$cardapio.="</table>";
	echo $cardapio;
}

?>