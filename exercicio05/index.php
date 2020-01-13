<?php
require_once("config.php");
?>

<html>
<head>
	<title>Pizzaria 123 Milhas</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
    	$( "#cadastrar" ).click(function() {
  			if(validacaoCadastroSabores()){
  				cadastrarNovoSabor();
  			}
  			else{
  				alert("Favor preencher todos os campos do Sabor");
  			}
		});

		$( "#atualizar" ).click(function() {
  			salvarAtualizacaoItem();
		});

		$( "#excluirTodosSabores" ).click(function() {
  			excluirTodosSabores();
		});

		$( "#criarPedido" ).click(function() {
  			if(validacaoCadastroPedido()){
  				criarPedido();
  			}else{
  				alert("Favor preencher todos os campos do pedido");
  			}
		});

		$( "#finalizarPedido" ).click(function() {
  			finalizarPedido();
		});

	});

var ultimaEdicao="";
var historicoPedido="";


function cadastrarNovoSabor(){
	var sabor= $("#sabor").val();
	var tamanho= $("#tamanho").val();
	var valor= $("#valor").val();
	var acao="cadastrarNovoSabor";

	$.ajax({
        url : "controlador.php",
        type : 'post',
        data : {
               sabor : sabor,
               tamanho :tamanho,
               valor: valor,
               acao: acao
        },
        beforeSend : function(){
               $("#gerenciamentoDeSabores").html("ENVIANDO...");
        }
     })
     .done(function(msg){	
          $("#gerenciamentoDeSabores").html(msg);
          reiniciarCamposSabores();
          $("#excluirTodosSabores").show();
     })
     .fail(function(jqXHR, textStatus, msg){
          alert(msg);
     }); 
}

function excluirTodosSabores(){
	var acao="excluirTodosSabores";

	$.ajax({
        url : "controlador.php",
        type : 'post',
        data : {
               acao: acao
        },
        beforeSend : function(){
               $("#gerenciamentoDeSabores").html("Efetuando exclusão de todos os sabores...");
        }
     })
     .done(function(msg){
          $("#gerenciamentoDeSabores").html(msg);
          $("#excluirTodosSabores").hide();
     })
     .fail(function(jqXHR, textStatus, msg){
          alert(msg);
     }); 
}

function editarItem(idSabor){
	var acao="editarItem";
	var item=idSabor;

	$.ajax({
        url : "controlador.php",
        type : 'post',
        data : {
               acao: acao,
               item:item
        },
        dataType:'json',
        beforeSend : function(){
               $("#gerenciamentoDeSabores").html("Efetuando edição...");
        }
     })
     .done(function(msg){
     	  ultimaEdicao=idSabor;	
 		  $("#sabor").val(msg['sabor']);
 		  $("#tamanho").val(msg['tamanho']);
 		  $("#valor").val(msg['valor']);	
 		  $("#cadastrar").hide();
 		  $("#atualizar").show();
 		  $("#excluirTodosSabores").hide();
          $("#gerenciamentoDeSabores").html("Favor concluir a edição deste item clicando em atualizar");
     })
     .fail(function(jqXHR, textStatus, msg){
          alert(msg);
     });

}

function salvarAtualizacaoItem(){
	var sabor= $("#sabor").val();
	var tamanho= $("#tamanho").val();
	var valor= $("#valor").val();
	var acao="salvarAtualizacaoItem";
	var item=ultimaEdicao;

	$.ajax({
        url : "controlador.php",
        type : 'post',
        data : {
               sabor : sabor,
               tamanho :tamanho,
               valor: valor,
               acao: acao,
               item:item,
        },
        beforeSend : function(){
               $("#gerenciamentoDeSabores").html("Efetuando edição...");
        }
     })
     .done(function(msg){

 		  $("#atualizar").hide();	
 		  $("#cadastrar").show();
 		  $("#excluirTodosSabores").show();
          $("#gerenciamentoDeSabores").html(msg);
          reiniciarCamposSabores();
     })
     .fail(function(jqXHR, textStatus, msg){
          alert(msg);
     });
}


function excluirItem(idSabor){
	var acao="excluirItem";
	var item=idSabor;

	$.ajax({
        url : "controlador.php",
        type : 'post',
        data : {
               acao: acao,
               item:item
        },
        beforeSend : function(){
               $("#gerenciamentoDeSabores").html("Efetuando exclusão...");
        }
     })
     .done(function(msg){
 		  $("#cadastrar").show();
 		  $("#atualizar").hide();
 		  $("#excluirTodosSabores").show();
          $("#gerenciamentoDeSabores").html(msg);
     })
     .fail(function(jqXHR, textStatus, msg){
          alert(msg);
     });
}

function adicionarAoPedido(idSabor){
	var acao="adicionarAoPedido";
	var item=idSabor;

	$.ajax({
        url : "controlador.php",
        type : 'post',
        data : {
               acao: acao,
               item:item
        },
        beforeSend : function(){
               $("#gerenciamentoDePedidos").html("Efetuando adição de item ao pedido...");
        }
     })
     .done(function(msg){

          $("#gerenciamentoDePedidos").html(msg);

     })
     .fail(function(jqXHR, textStatus, msg){
          alert(msg);
     });
}

function reiniciarCamposSabores(){
	$("#sabor").val("");
	document.getElementById("tamanho").options.selectedIndex = 0;
	$("#valor").val("");
}

function reiniciarCamposPedido(){
	$("#telefone").val("");
	$("#endereco").val("");
}

function criarPedido(){
	var telefone= $("#telefone").val();
	var endereco= $("#endereco").val();
	var acao="criarPedido";
	$("#criarPedido").hide();
	$("#finalizarPedido").show();
	$.ajax({
        url : "controlador.php",
        type : 'post',
        data : {
               telefone : telefone,
               endereco :endereco,
               acao: acao
        },
        beforeSend : function(){
               $("#gerenciamentoDePedidos").html("Criando Pedido...");
        }
     })
     .done(function(msg){	
     	  reiniciarCamposPedido();	
          $("#gerenciamentoDePedidos").html(msg);
          
     })
     .fail(function(jqXHR, textStatus, msg){
          alert(msg);
     });
}

function finalizarPedido(){
	var acao="finalizarPedido";
	$("#criarPedido").show();
	$("#finalizarPedido").hide();
	$.ajax({
        url : "controlador.php",
        type : 'post',
        data : {
               acao: acao
        },
        beforeSend : function(){
               $("#gerenciamentoDePedidos").html("Finalizando Pedido...");
        }
     })
     .done(function(msg){	
     	reiniciarCamposPedido();
     	alert("Pedido Finalizado com Sucesso!!");
          $("#gerenciamentoDePedidos").html(msg);

          
     })
     .fail(function(jqXHR, textStatus, msg){
          alert(msg);
     });
}


function validacaoCadastroSabores(){
	if(($("#sabor").val()!="")&&($("#tamanho").val()!="")&&($("#valor").val()!="")){
		return true;
	}
	return false;
}

function validacaoCadastroPedido(){
	if(($("#telefone").val()!="")&&($("#endereco").val()!="")){
		return true;
	}
	return false;
}

</script>

</head>
<body>	
<table style="width:100%; border-style:solid; border-width:1px; border-color:#ccc;">
	<tr>
		<td valign="top" width="60%" style="background-color:#DEB887;">
			<h1>Gerenciamento de Sabores</h1>
			<table>
				<tr>
					<td>
						<input type="text" name="sabor" id="sabor" placeholder="Sabor">
					</td>
					<td>
						<select name="tamanho" id="tamanho">
							<option value="">Selecione tamanho...</option>
							<option value="P">P</option>
							<option value="M">M</option>
							<option value="G">G</option>
						</select>	
					</td>
					<td>
						<input type="text" name="valor" id="valor" placeholder="Valor(R$)">
					</td>	
					<td>
						<button id="cadastrar">Cadastrar</button>
						<button id="atualizar" style="display:none;">Atualizar</button>
						<button id="excluirTodosSabores" style="display:none;">Excluir todos</button>
					</td>	
				</tr>
			</table>
			<div id="gerenciamentoDeSabores">

			</div>	
		</td>

		<td valign="top" width="40%" style="background-color:#F0E68C;">
			<h1>Gerenciamento de Pedidos</h1>
			<table>
				<tr>
					<td valign="top">
						<input type="text" name="telefone" id="telefone" placeholder="Telefone do cliente">
					</td>
					<td valign="top">
						<textarea id="endereco" name="endereco" placeholder="Endereço do cliente"></textarea>
					</td>	
					<td valign="top">
						<button id="criarPedido">Criar Pedido</button>
						<button id="finalizarPedido" style="display:none;">Finalizar Pedido</button>
					</td>	
				</tr>	
			</table>
			<div id="gerenciamentoDePedidos">

			</div>	
		</td>	
	</tr>		
</table>
<small>(*)Sistema prova de programação 123 milhas de cadastro de itens de pizzaria e pedidos. Os itens devem ser cadastrados para após isso efetuar o pedido( Utilizado PHP e Javascript(JQuery))</small>	
</body>
</html>