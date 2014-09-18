<?php
require_once("../controle/controle.php");
Sessao::LoginNecessario();
$mensagem = Sessao::getMensagem();

$motoristas = Motorista::Listar();

// Executar código da visão 
ob_start();
include("../visoes/motorista_lista.php");
$conteudo = ob_get_contents(); 
ob_end_clean();
// Gerar HTML e mostrar
include("../visoes/layout.php");
?>
