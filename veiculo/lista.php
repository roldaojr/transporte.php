<?php
require_once("../controle/controle.php");
Sessao::LoginNecessario();
$mensagem = Sessao::getMensagem();

$veiculos = Veiculo::Listar();
// Executar código da visão 
ob_start();
include("../visoes/veiculo_lista.php");
$conteudo = ob_get_contents(); 
ob_end_clean();
// Gerar HTML e mostrar
include("../visoes/layout.php");
?>