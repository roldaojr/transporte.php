<?php
require_once ("../controle/controle.php");
Sessao::LoginNecessario();

if(isset($_POST["viagem_id"]) and $_POST["viagem_id"]) {
	$viagem = Viagem::Consultar($_POST["viagem_id"]);
	if(!$viagem) {
		throw new InvalidArgumentException("Viagem com ID = {$_GET['id']} não encontrado.");
		die();
	}
} else {
	$viagem = new Viagem();
}

if(isset($_POST["imprimir"])) { // Imprimir solicitação
echo "........";
	Sessao::Direcionar("imprimir_guia.php?id=" . $viagem -> getID());
} elseif(isset($_POST["aprovar"])) { // Aprovar viagem
	$viagem -> Aprovar($viagem);
	Sessao::setMensagem("Viagem aprovada");
	Sessao::Direcionar("lista.php");
} elseif(isset($_POST["reprovar"])) { // Reprovar viagem
	$viagem -> Reprovar($viagem);
	Sessao::setMensagem("Viagem reprovada");
	Sessao::Direcionar("lista.php");
} elseif(isset($_POST["cancelar"])) { // Cancelar viagem
	$viagem -> Cancelar($viagem);
	Sessao::setMensagem("Viagem cancelada");
	Sessao::Direcionar("lista.php");
} elseif(isset($_POST["realizada"])) {
	$viagem -> Realizada($viagem);
	Sessao::setMensagem("Viagem concluída");
	Sessao::Direcionar("lista.php");	
} elseif(isset($_POST["alterar_veiculo"])) { // Alterar veiculo
	$veiculo = Veiculo::Consultar($_POST["veiculo_id"]);
	$viagem -> setVeiculo($veiculo);
	$viagem -> Salvar();
	Sessao::setMensagem("Veiculo alterado");
	Sessao::Direcionar("cadastro.php?id=" . $viagem -> getID());
} elseif(isset($_POST["alterar_motorista"])) { // Alterar motorista
	$motorista = Motorista::Consultar($_POST["motorista_id"]);
	$viagem -> setMotorista($motorista);
	$viagem -> Salvar();
	Sessao::setMensagem("Motorista alterado");
	Sessao::Direcionar("cadastro.php?id=" . $viagem -> getID());
} elseif(isset($_POST["salvar"])) { // Salvar dados da viagem
	if(!$viagem -> getID()) {
		$viagem -> setSolicitante(Usuario::Consultar($_POST["solicitante_id"]));
	}
	$viagem -> setDestino($_POST["destino"]);
	$viagem -> setMotivo($_POST["motivo"]);
	$viagem -> setQtdpessoas($_POST["qtd_pessoas"]);
	$viagem -> setSaida($_POST["saida"]);
	$viagem -> setChegada($_POST["chegada"]);
	if($viagem -> Validar()) {
		$viagem -> Salvar();
		Sessao::setMensagem("Viagem salva com sucesso");
		Sessao::Direcionar("cadastro.php?id=" . $viagem -> getID());
	} else {
		$erros = "<b>Erros de validação</b><br/>";
		foreach($viagem->getErros() as $atributo => $erro) {
			$erros .= "<b>$atributo</b>: $erro<br/>";
		}
		$_SESSION["viagem"] = $viagem;
		Sessao::setMensagem($erros);
		Sessao::Retornar();
	}
}
?>