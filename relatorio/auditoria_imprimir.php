<?php
require_once ("../controle/controle.php");
Sessao::LoginNecessario();
@$data_inicio = $_GET["data_inicio"];
@$data_fim = $_GET["data_fim"];

// Validar e converter datas
list($dia, $mes, $ano) = explode("/", $data_inicio);
if(!checkdate($mes, $dia, $ano)) {
	Sessao::setMensagem("Data inicio inválida");
	Sessao::Retornar();
}
$data_inicio_sql = "$ano-$mes-$dia";
list($dia, $mes, $ano) = explode("/", $data_fim);
if(!checkdate($mes, $dia, $ano)) {
	Sessao::setMensagem("Data fim inválida");
	Sessao::Retornar();
}
$data_fim_sql = "$ano-$mes-$dia";

$viagens = Viagem::Listar("situacao = " . VIAGEM_SITUACAO_REALIZADA . " and saida > '$data_inicio_sql' and saida < '$data_fim_sql'");
// Executar código da visão
ob_start();
include ("../visoes/relatorio_auditoria_imprimir.php");
$conteudo = ob_get_contents();
ob_end_clean();
// Gerar HTML e mostrar
include ("../visoes/layout_imprimir.php");
?>
