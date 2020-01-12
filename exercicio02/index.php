<?php
require_once("config.php");
date_default_timezone_set("Brazil/East");

$estacionamento= new Estacionamento(6,20.00,10.00);

$estacionamento->iniciarEstacionamento();

$estacionamento->exibirEstacionamento();

?>