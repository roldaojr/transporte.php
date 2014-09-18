<?php
require_once("../controle/controle.php");
Sessao::LoginNecessario();

if(isset($_GET["id"]) and $_GET["id"]) {
	$motorista = Motorista::Consultar($_GET["id"]);
	if($motorista) {
		$motorista -> Excluir();
		Sessao::setMensagem("Motorista com ID = {$_GET['id']} excluido");
	} else {
		Sessao::setMensagem("Motorista com ID = {$_GET['id']} não existe");
	}
	Sessao::Retornar();
}
?>
