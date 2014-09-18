<?php
require_once("../controle/controle.php");
Sessao::LoginNecessario();
$mensagem = Sessao::getMensagem();

if(isset($_GET["id"]) and $_GET["id"]) {
	$motorista = Motorista::Consultar($_GET["id"]);
	if(!$motorista) {
		echo "Motorista com ID = {$_GET['id']} não existe";
		die();
	}
	$titulo = "Detalhes do motorista";
} elseif(isset($_SESSION["motorista"]) and $_SESSION["motorista"]) {
	$motorista = $_SESSION["motorista"];
	unset($_SESSION["motorista"]);
	$titulo = "Novo motorista";
} else {
	$motorista = new Motorista();
	$titulo = "Novo motorista";
}

// Executar código da visão 
ob_start();
include("../visoes/motorista_form.php");
$conteudo = ob_get_contents(); 
ob_end_clean();
// Gerar HTML e mostrar
include("../visoes/layout.php");
?>