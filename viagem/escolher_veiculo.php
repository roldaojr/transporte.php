<?php
require_once("../controle/controle.php");
Sessao::LoginNecessario();
$veiculos = Veiculo::Listar();
$viagem_id = @intval($_GET["viagem_id"]);
// Executar código da visão
ob_start();
include ("../visoes/viagem_escolher_veiculo.php");
$conteudo = ob_get_contents();
ob_end_clean();
// Gerar HTML e mostrar
include ("../visoes/layout.php");
?>