<?php
require_once("controle/controle.php");
Sessao::LoginNecessario();

$viagens_solicitadas = Viagem::Listar("situacao = " . VIAGEM_SITUACAO_SOLICITADA);
$viagens_aprovadas = Viagem::Listar("situacao = " . VIAGEM_SITUACAO_APROVADA);

// Executar código da visão 
ob_start();
include("visoes/inicio.php");
$conteudo = ob_get_contents(); 
ob_end_clean();
// Gerar HTML e mostrar
include("visoes/layout.php");
?>