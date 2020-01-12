<?php
class Estacionamento{
	// Array de vagas deste estacionamento
	private $vagasDoEstacionamento;
	// número de vagas deste estacionamento
	private $numeroDeVagas;
	// valor cobrado para estacionar um carro por hora
	private $valorVagaHoraCarro;
	// valor cobrado para estacionar uma moto por hora
	private $valorVagaHoraMoto;

	// construtor
	public function __construct($numeroDeVagas,$valorVagaHoraCarro,$valorVagaHoraMoto){
		$this->setNumeroDeVagas($numeroDeVagas);
		$this->setValorVagaHoraCarro($valorVagaHoraCarro);
		$this->setValorVagaHoraMoto($valorVagaHoraMoto);
	}

	/* métodos getters e setters - início*/
	public function getNumeroDeVagas():int{
		return $this->numeroDeVagas;
	}

	public function setNumeroDeVagas($numeroDeVagas){
		$this->numeroDeVagas=$numeroDeVagas;
	}

	public function getValorVagaHoraCarro():float{
		return $this->valorVagaHoraCarro;
	}

	public function setValorVagaHoraCarro($valorVagaHoraCarro){
		$this->valorVagaHoraCarro=$valorVagaHoraCarro;
	}

	public function getValorVagaHoraMoto():float{
		return $this->valorVagaHoraMoto;
	}

	public function setValorVagaHoraMoto($valorVagaHoraMoto){
		$this->valorVagaHoraMoto=$valorVagaHoraMoto;
	}

	/* métodos getters e setters - fim*/


	// método que inicia o estacionamento
	public function iniciarEstacionamento(){
		for($i=0;$i<$this->getNumeroDeVagas();$i++){
			$this->vagasDoEstacionamento[$i]=Estacionamento::randomizarAtributosVagas($i,$this->getValorVagaHoraCarro(),$this->getValorVagaHoraMoto());
		}
	}

	// método que gera um estacionamento aleatório com carros e motos
	public static function randomizarAtributosVagas($i,$valorVagaHoraCarro,$valorVagaHoraMoto){
		$vagaDisponivel=(bool)random_int(0, 1);
		$vagaEspecial=(bool)random_int(0, 1);
		$statusVaga=true;
		$identificador="Vaga".$i;
		if(!$vagaDisponivel){
			$statusVaga=false;
			$dataEntrada="2020-01-0".(int)random_int(0,9)." 00:00:00";
			if($i%2==0){
				return new VagaCarro($identificador,$vagaDisponivel,$valorVagaHoraCarro,$vagaEspecial,$dataEntrada);
			}else{
				return new VagaMoto($identificador,$vagaDisponivel,$valorVagaHoraMoto,$vagaEspecial,$dataEntrada);
			}
		}else{
			if($i%2==0){
				return new VagaCarro($identificador,$vagaDisponivel,$valorVagaHoraCarro,$vagaEspecial);
			}else{
				return new VagaMoto($identificador,$vagaDisponivel,$valorVagaHoraMoto,$vagaEspecial);
			}
		}
	}


	//método que efetua a exibição do estacionamento
	public function exibirEstacionamento(){
		$valorGanho=0;
		$desconto=0;
		$valorTotal=0;
		$descontoTotal=0;
		echo "<table border='1' cellpadding='5'><tr><td><h3>Estacionamento 123milhas</h3>
		<b>Horário atual:".date("Y-m-d H:i:s")."</b><br>
		Ocupação:".$this->getPorcentagemOcupacao()."%".
		"<br>Especiais:".$this->getNumeroDeVagasEspeciais()."</td></tr>";
		foreach($this->vagasDoEstacionamento as $vaga){
			echo'<tr><td>';
			echo $vaga;
			if(!$vaga->getEstaDisponivel()){
				$valorGanho=$vaga->pagamentoFracaoHora();
				$desconto=$vaga->desconto();
				echo "<br>Horas:".$vaga->getPeriodoOcupacaoVaga();
				echo "<br>Ganho até o momento: R$".number_format($valorGanho,2);
				echo "<br>Desconto: R$".number_format($desconto,2);
				$valorTotal=$valorTotal+$valorGanho;
				$descontoTotal=$descontoTotal+$desconto;
			}
			echo"</td></tr>";
			
		}
		echo "<tr><td>Valor Bruto:R$".number_format($valorTotal+$descontoTotal,2)."<br>
		Desconto Total:R$".number_format($descontoTotal,2)."<br>
		Valor Liquido:R$".number_format($valorTotal,2)."</td></tr>";
		echo"</table>";
		echo "<small>(*) No caso de carros o desconto de 50% de uma hora é fornecido somente na primeira hora.<br>(*) No caso de motos o desconto de 75% de uma hora é fornecido somente para vagas especiais somente na primeira hora.</small>";
	}

	// método que retorna a procentagem de ocupação do estacionamento
	public function getPorcentagemOcupacao(){
		$ocupadas=0;
		foreach($this->vagasDoEstacionamento as $vaga){
			if(!$vaga->getEstaDisponivel()){
				$ocupadas++;
			}
		}
		return number_format(round(($ocupadas/$this->getNumeroDeVagas())*100),2);
	}

	// método que retorna o número de vagas especiais do estacionamento
	public function getNumeroDeVagasEspeciais(){
		$especiais=0;
		foreach($this->vagasDoEstacionamento as $vaga){
			if($vaga->getVagaEspecial()){
				$especiais++;
			}
		}
		return $especiais;
	}

}
?>