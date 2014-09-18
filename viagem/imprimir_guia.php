<?php
require_once ("../controle/controle.php");
Sessao::LoginNecessario();
@$viagem_id = $_GET["id"];

if(isset($_GET['id']) and $_GET['id']) {
	$viagem = Viagem::Consultar($_GET['id']);
	if(!$viagem) {
		echo "Viagem com ID = {$_GET['id']} não existe";
		die();
	}
}

// Gerar HTML e mostrar
include ("../visoes/imprimir_guia.php");
?>
