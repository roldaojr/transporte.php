<?php
require_once("../controle/controle.php");
Sessao::LoginNecessario();

if(isset($_POST["id"]) and $_POST["id"]) {
	$motorista = Motorista::Consultar($_POST["id"]);
	if(!$motorista) {
		echo "Motorista com ID = {$_POST['id']} não existe";
		die();
	}
} else {
	$motorista = new Motorista();
}
$motorista -> setNome($_POST["nome"]);
$motorista -> setTelefone($_POST["telefone"]);
$motorista -> setEndereco($_POST["endereco"]);
$motorista -> setCnhNumero($_POST["cnhnumero"]);
$motorista -> setCnhCategoria($_POST["cnhcategoria"]);
if($motorista -> Validar()) {
	$motorista -> Salvar();
	Sessao::setMensagem("Motorista salvo com êxito!");
	Sessao::Direcionar("cadastro.php?id=" . $motorista -> getID());
} else {
	$erros = "Erros de validação<br/>";
	foreach($motorista->getErros() as $atributo => $erro) {
		$erros .= "$atributo: $erro<br/>";
	}
	$_SESSION["motorista"] = $motorista;
	Sessao::setMensagem($erros);
	Sessao::Retornar();
}
?>