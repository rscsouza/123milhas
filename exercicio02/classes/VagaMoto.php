<?php
class VagaMoto extends Vaga implements Pagamento{
	
	public function pagamentoFracaoHora(){
		if(!$this->getEstaDisponivel()){
			return ($this->getPeriodoOcupacaoVaga()*$this->getValorHora())-$this->desconto();
		}
		return 0;
	}
	
	/* 
	* se a vaga for de moto um desconto de 75% do valor da hora inicial na primeira hora,
	* se a vaga também for especial
	*/
	public function desconto(){
		if($this->getPeriodoOcupacaoVaga()>1 && $this->getVagaEspecial()){
			$descontoAplicado=0.75*$this->getValorHora();
			return $descontoAplicado;
		}
		return 0;
	}
}
?>