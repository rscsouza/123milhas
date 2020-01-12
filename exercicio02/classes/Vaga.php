<?php

class Vaga{
	// informa a identificação da vaga
	private $identificador;
	// informa se esta vaga está disponivel no momento
	private $estaDisponivel;
	// informa o valor da hora cobrado para esta vaga 
	private $valorHora;
	// informa se esta vaga é especial (idoso ou deficiente físico)
	private $vagaEspecial;
	//informa a data de entrada nesta vaga( se a mesma estiver ocupada)
	private $dataEntrada;

	// construtor 
	public function __construct($identificador,$estaDisponivel,$valorHora,$vagaEspecial,$dataEntrada=null){
		$this->setIdentificador(get_class($this)."-".$identificador);
		$this->setEstaDisponivel($estaDisponivel);
		$this->setValorHora($valorHora);
		$this->setVagaEspecial($vagaEspecial);
		if(!is_null($dataEntrada)){
			$this->setDataEntrada($dataEntrada);
		}
	}

	/*Métodos getters e setters - início*/

	public function getIdentificador():string{
		return $this->identificador;
	}

	public function setIdentificador($identificador){
		$this->identificador=$identificador;
	}

	public function getEstaDisponivel():bool{
		return $this->estaDisponivel;
	}

	public function setEstaDisponivel($estaDisponivel){
		$this->estaDisponivel=$estaDisponivel;
	}

	public function getValorHora():float{
		return $this->valorHora;
	}

	public function setValorHora($valorHora){
		$this->valorHora=$valorHora;
	}

	public function getVagaEspecial():bool{
		return $this->vagaEspecial;
	}

	public function setVagaEspecial($vagaEspecial){
		$this->vagaEspecial=$vagaEspecial;
	}

	public function getDataEntrada(){
		return $this->dataEntrada;
	}

	public function setDataEntrada($dataEntrada){
		$this->dataEntrada=$dataEntrada;
	}	
	/*Métodos getters e setters - fim*/

	// método que retorna a ocupação desta vaga em horas
	public function getPeriodoOcupacaoVaga(){
		if(!is_null($this->getDataEntrada())){
			$dataEntrada = $this->getDataEntrada();
 			$dataAtual = date("Y-m-d H:i:s");
		 	$ocupacaoEmHoras =round((strtotime($dataAtual)-strtotime($dataEntrada))/3600,2);
		 	return $ocupacaoEmHoras;
		}
		return 0;
	}

	public function __toString(){
		return json_encode(array(
			"identificador"=>$this->getIdentificador(),
			"esta_disponivel"=>$this->getEstaDisponivel(),
			"valor_hora"=>$this->getValorHora(),
			"vaga_especial"=>$this->getVagaEspecial(),
			"data_entrada"=>$this->getDataEntrada()
		));
	}
}

?>