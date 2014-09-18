<?php
require_once ("../controle/controle.php");
Sessao::LoginNecessario();

if(!isset($_GET["veiculo_id"]) or !$_GET["veiculo_id"]) {
	Sessao::setMensagem("ID do veiculo não informado");
	Sessao::Retornar();
} else {
	$veiculoId = $_GET["veiculo_id"];
}
if(!isset($_GET["id"]) or !$_GET["id"]) {
	Sessao::setMensagem("ID da revis&atlide;o não informado");
	Sessao::Retornar();
} else {
	$id = $_GET["id"];
}
$revisao = Revisao::Consultar($veiculoId, $id);
if($revisao) {
	$revisao -> Excluir();
	Sessao::setMensagem("Revis&atlide;o exclu&iacute;da");
} else {
	Sessao::setMensagem("Revis&atlide;o n&atlide;o existe");
}
Sessao::Retornar();
?>