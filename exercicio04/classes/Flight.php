<?php
class Flight
{
	private $flightNumber;
    private $cia;
    private $departureAirport;
    private $arrivalAirport;
    private $departureTime;
    private $arrivalTime;
    private $valorTotal;
    // Array de itens carga deste voo
    private $itensDeCarga;

    public function __construct(
        string $flightNumber,
        string $cia,
        string $departureAirport,
        string $arrivalAirport,
        DateTime $departureTime,
        DateTime $arrivalTime,
        float $valorTotal
    )
    {
        $this->flightNumber = $flightNumber;
        $this->cia = $cia;
        $this->departureAirport = $departureAirport;
        $this->arrivalAirport = $arrivalAirport;
        $this->departureTime = $departureTime;
        $this->arrivalTime = $arrivalTime;
        $this->valorTotal = $valorTotal;
        $this->itensDeCarga=array();
    }

    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    public function getCia()
    {
    	return $this->cia;
    }

    public function getDepartureAirport()
    {
    	return $this->departureAirport;
    }

    public function getArrivalAirport()
    {
    	return $this->arrivalAirport;
    }

    public function getDepartureTime()
    {
    	return $this->departureTime;
    }

    public function getArrivalTime()
    {
    	return $this->arrivalTime;
    }

    public function getValorTotal()
    {
    	// o valor total agora é calculado com a soma dos serviço adquiridos
    	return $this->valorTotal+ItemCarga::gastosComServicos($this->getItensDeCarga());
    }

    // método que retorna um array de ItemCarga
    public function getItensDeCarga()
    {
    	return $this->itensDeCarga;
    }

    // metodo que adiciona um item de carga no voo
    public function adicionarItemCarga($itemCarga)
    {
    	$this->itensDeCarga[]=$itemCarga;
    }

}
?>