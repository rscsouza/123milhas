<?php
class ItemCarga{
	// informa o código da carga
	private $codigo;
	// informa o nome da carga
	private $nome;
	// informa o peso da carga
	private $peso;
	//informa o valor da carga
	private $valor;
	// informa se a carga possui valor definido
	private $possuiValor;
	// informa se é uma carga viva( cachorro, gato, aves, etc)
	private $cargaViva;

	// construtor
	public function __construct($codigo,$nome,$peso,$valor,$possuiValor,$cargaViva){
		$this->setCodigo($codigo);
		$this->setNome($nome);
		$this->setPeso($peso);
		$this->setValor($valor);
		$this->setPossuiValor($possuiValor);
		$this->setCargaViva($cargaViva);
	}

	/*Métodos getters e setters - início*/
	public function getCodigo():string{
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo=$codigo;
	}

	public function getNome():string{
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome=$nome;
	}

	public function getPeso():float{
		return $this->peso;
	}

	public function setPeso($peso){
		 $this->peso=$peso;
	}

	public function getValor():float{
		return $this->valor;
	}

	public function setValor($valor){
		 $this->valor=$valor;
	}

	public function getPossuiValor():bool{
		return $this->possuiValor;
	}

	public function setPossuiValor($possuiValor){
		 $this->possuiValor=$possuiValor;
	}

	public function getCargaViva():bool{
		return $this->cargaViva;
	}

	public function setCargaViva($cargaViva){
		 $this->cargaViva=$cargaViva;
	}
	/*Métodos getters e setters - fim*/

	// Método __toString desta carga
	public function __toString(){
		$itemDescricao="<br>";
		$itemDescricao.="Código: ".$this->getCodigo()."<br/>";
		$itemDescricao.="Nome: ".$this->getNome()."<br/>";
		$itemDescricao.="Peso: ".$this->getPeso()." Kg<br/>";
		if($this->getPossuiValor()){
			$itemDescricao.="Possui valor: Sim<br/>";
			$itemDescricao.="Valor: R$".number_format($this->getValor(),2)."<br/>";
		}
		else{
			$itemDescricao.="Possui valor: Não<br/>";
		}
		if($this->getCargaViva()){
			$itemDescricao.="Carga viva: Sim<br/>";
		}
		else{
			$itemDescricao.="Carga viva: Não<br/>";	
		}
		return $itemDescricao; 
	}

	// Método estático que retorna o valor total gasto com serviços
	public static function gastosComServicos($itensDeCarga){
		$valorTotalServicos=0;
		foreach($itensDeCarga as $itemCarga){
			if($itemCarga->getPossuiValor()){
				$valorTotalServicos+=$itemCarga->getValor();
			}
		}
		return $valorTotalServicos;
	}

	// Método estático que retorna o resumo dos serviços adquiridos (listagem)
	public static function resumoDosServicos($itensDeCarga){
		if(count($itensDeCarga)>0){
			$itensDescricao="";
			foreach($itensDeCarga as $itemCarga){
				$itensDescricao.=$itemCarga."<hr>";
			}
			return $itensDescricao;
		}
		return "Nenhum serviço adicional incluído";
	}

}
?>