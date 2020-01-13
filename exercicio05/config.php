<?php
session_start();

if(!isset($_SESSION["gerenciamentoDeSabores"])){
	$_SESSION["gerenciamentoDeSabores"]=array();
}
spl_autoload_register(function($nameClass){
	$filename="classes".DIRECTORY_SEPARATOR.$nameClass.".php";
	if(file_exists($filename)){
		require_once($filename);
	}
});

?>