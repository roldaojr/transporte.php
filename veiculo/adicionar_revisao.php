<?php
require_once ("../controle/controle.php");
Sessao::LoginNecessario();

if(!isset($_POST["veiculo_id"]) or !$_POST["veiculo_id"]) {
	echo "ID do veiculo não informado";
	die();
}
$revisao = new Revisao($_POST["veiculo_id"]);
$revisao -> setData($_POST["data"]);
$revisao -> setQuilometragem($_POST["quilometragem"]);
$revisao -> setDescricao($_POST["descricao"]);
if($revisao -> Validar()) {
	$revisao -> Salvar();
	Sessao::setMensagem("Revisão adicionada com êxito!");
} else {
	$erros = "Erros de validação<br/>";
	foreach($revisao->getErros() as $atributo => $erro) {
		$erros .= "$atributo: $erro<br/>";
	}
	Sessao::setMensagem($erros);
}
Sessao::Retornar();
?>