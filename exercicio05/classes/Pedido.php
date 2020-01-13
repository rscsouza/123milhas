<?php
class Pedido{
	
	private $telefone;
	private $endereco;
	private $pizzas;

	public function __construct($telefone,$endereco){
		$this->setTelefone($telefone);
		$this->setEndereco($endereco);
		$this->pizzas=array();
	}

	public function getTelefone():string{
		return $this->telefone;
	}

	public function setTelefone($telefone){
		$this->telefone=$telefone;
	}

	public function getEndereco():string{
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco=$endereco;
	}

	public function getPizzas(){
		return $this->pizzas;
	}

	public function __toString(){
		return json_encode(array(
			"telefone"=>$this->getTelefone(),
			"endereco"=>$this->getEndereco(),
			"pizzas"=>$this->getPizzas()
		));
	}

	public function adicionarPizza($pizza){
		$this->pizzas[]=$pizza;
	}

	public function historicoPedido(){
		echo "Pedido criado para ".$this->getTelefone()." em ".$this->getEndereco()."<hr>";
		$total=0;
		foreach($this->getPizzas() as $pizza){
			echo $pizza->getSabor()." - ".$pizza->getTamanho()." - R$".number_format($pizza->getValor(),2)."<hr>";
			$total=$total+$pizza->getValor();
		}
		echo "<h2>Total: R$".number_format($total,2)."</h2>";
	}


}
?>