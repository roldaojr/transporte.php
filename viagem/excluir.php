<?php
require_once("../controle/controle.php");
Sessao::LoginNecessario();

if(isset($_GET["id"]) and $_GET["id"]) {
	$viagem = Viagem::Consultar($_GET["id"]);
	if($viagem) {
		$viagem -> Excluir();
		Sessao::setMensagem("Viagem com ID = {$_GET['id']} excluido");
	} else {
		Sessao::setMensagem("Viagem com ID = {$_GET['id']} não existe");
	}
	Sessao::Retornar();
}
?>