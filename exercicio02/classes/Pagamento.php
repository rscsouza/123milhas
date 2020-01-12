<?php
interface Pagamento{
	// valor que será cobrado por fração de hora
	public function pagamentoFracaoHora();
	// desconto que será aplicado de acordo com o veículo estcionado
	public function desconto();
}
?>