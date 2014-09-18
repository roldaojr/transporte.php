<?php
require_once ("../controle/controle.php");
Sessao::LoginNecessario();
$data_inicio = $_GET["data_inicio"];
$data_fim = $_GET["data_fim"];

$data_inicio_sql = implode("-", array_reverse(explode("/", $data_inicio)));
$data_fim_sql = implode("-", array_reverse(explode("/", $data_fim)));

$viagens = Viagem::Listar("situacao = " . VIAGEM_SITUACAO_REALIZADA . " and saida > '$data_inicio_sql' and saida < '$data_fim_sql'");
// Executar código da visão
ob_start();
include ("../visoes/relatorio_quilometragem_imprimir.php");
$conteudo = ob_get_contents();
ob_end_clean();
// Gerar HTML e mostrar
include ("../visoes/layout_imprimir.php");
?>