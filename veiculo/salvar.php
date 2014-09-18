<?php
require_once ("../controle/controle.php");
Sessao::LoginNecessario();

if(isset($_POST["id"]) and $_POST["id"]) {
	$veiculo = Veiculo::Consultar($_POST["id"]);
	if(!$veiculo) {
		echo "Veiculo com ID = {$_POST['id']} não existe";
		die();
	}
} else {
	$veiculo = new Veiculo();
}
$veiculo -> setTipo($_POST["tipo"]);
$veiculo -> setPlaca($_POST["placa"]);
$veiculo -> setQtdPessoas($_POST["qtdpessoas"]);
$veiculo -> setCategoria($_POST["categoria"]);
if($veiculo -> Validar()) {
	$veiculo -> Salvar();
	Sessao::setMensagem("Veiculo salvo com êxito!");
	Sessao::Direcionar("cadastro.php?id=" . $veiculo -> getID());
} else {
	$erros = "<b>Erros de validação</b><br/>";
	foreach($veiculo->getErros() as $atributo => $erro) {
		$erros .= "<b>$atributo</b>: $erro<br/>";
	}
	$_SESSION["veiculo"] = $veiculo;
	Sessao::setMensagem($erros);
	Sessao::Retornar();
}
?>