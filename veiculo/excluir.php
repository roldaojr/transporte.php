<?php
require_once("../controle/controle.php");
Sessao::LoginNecessario();

if(isset($_GET["id"]) and $_GET["id"]) {
	$veiculo = Veiculo::Consultar($_GET["id"]);
	if($veiculo) {
		$veiculo -> Excluir();
		Sessao::setMensagem("Veiculo com ID = {$_GET['id']} excluido");
	} else {
		Sessao::setMensagem("Veiculo com ID = {$_GET['id']} não existe");
	}
	Sessao::Retornar();
}
?>
