<?php
class VagaCarro extends Vaga implements Pagamento{
	
	public function pagamentoFracaoHora(){
		if(!$this->getEstaDisponivel()){
			return ($this->getPeriodoOcupacaoVaga()*$this->getValorHora())-$this->desconto();
		}
		return 0;
	}
	
	/* 
	* se a vaga for de carro aplicar um desconto de metade do valor da hora inicial na primeira hora.
	*/
	public function desconto(){
		if($this->getPeriodoOcupacaoVaga()>1){
			$descontoAplicado=0.5*$this->getValorHora();
			return $descontoAplicado;
		}
		return 0;
	}
}
?>