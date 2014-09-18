<?php
require_once ("../controle/controle.php");
Sessao::LoginNecessario();
$mensagem = Sessao::getMensagem();
if(isset($_GET["situacao"]) and $_GET["situacao"] == 0) {
	$situacao = $_GET["situacao"];
	$viagens = Viagem::Listar("situacao = 0");
} else {
	$paginador = new Paginador(Viagem::Contar(), 20);
	$viagens = Viagem::Listar(null, sprintf("%s, %s", $paginador -> getOffset(), $paginador -> getLimite()));
	$totalDePaginas = $paginador->getTotal();
	$paginaAtual = $paginador->getAtual();
}

// Executar código da visão
ob_start();
include ("../visoes/viagem_lista.php");
$conteudo = ob_get_contents();
ob_end_clean();
// Gerar HTML e mostrar
include ("../visoes/layout.php");
?>
