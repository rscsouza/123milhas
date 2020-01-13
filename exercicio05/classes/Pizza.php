<?php
class Pizza{

	private $sabor;
	private $tamanho;
	private $valor;

	public function __construct($sabor,$tamanho,$valor){
		$this->setSabor($sabor);
		$this->setTamanho($tamanho);
		$this->setValor($valor);
	}

	public function getSabor():string{
		return $this->sabor;
	}

	public function setSabor($sabor){
		$this->sabor=$sabor;
	}

	public function getTamanho():string{
		return $this->tamanho;
	}

	public function setTamanho($tamanho){
		$this->tamanho=$tamanho;
	}

	public function getValor():float{
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor=$valor;
	}

	public function __toString(){
		return json_encode(array(
			"sabor"=>$this->getSabor(),
			"tamanho"=>$this->getTamanho(),
			"valor"=>$this->getValor()
		));
	}
}
?>