<?php
require_once ("../controle/controle.php");
Sessao::LoginNecessario();
$mensagem = Sessao::getMensagem();

if(isset($_GET['id']) and $_GET['id']) {
	$viagem = Viagem::Consultar($_GET['id']);
	$titulo = "Detalhes da Viagem";
	if(!$viagem) {
		echo "Viagem com ID = {$_GET['id']} não existe";
		die();
	}
} elseif(isset($_SESSION["viagem"]) and $_SESSION["viagem"]) {
	$viagem = $_SESSION["viagem"];
	unset($_SESSION["viagem"]);
	$titulo = "Solicitar Viagem";
} else {
	$viagem = new Viagem();
	$titulo = "Solicitar Viagem";
}

// Executar código da visão
ob_start();
include ("../visoes/viagem_form.php");
$conteudo = ob_get_contents();
ob_end_clean();
// Gerar HTML e mostrar
include ("../visoes/layout.php");
?>