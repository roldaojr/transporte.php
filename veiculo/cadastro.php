<?php
require_once("../controle/controle.php");
Sessao::LoginNecessario();
$mensagem = Sessao::getMensagem();

if(isset($_GET["id"]) and $_GET["id"]) {
	$veiculo = Veiculo::Consultar($_GET["id"]);
	if(!$veiculo) {
		echo "Veiculo com ID = {$_GET['id']} não existe";
		die();
	}
	$titulo = "Detalhes do veiculo";
} elseif(isset($_SESSION["veiculo"]) and $_SESSION["veiculo"]) {
	$veiculo = $_SESSION["veiculo"];
	unset($_SESSION["veiculo"]);
	$titulo = "Cadastrar veiculo";
} else {
	$veiculo = new Veiculo();
	$titulo = "Cadastrar veiculo";
}

// Executar código da visão 
ob_start();
include("../visoes/veiculo_form.php");
$conteudo = ob_get_contents(); 
ob_end_clean();
// Gerar HTML e mostrar
include("../visoes/layout.php");
?>