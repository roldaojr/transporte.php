<?php
require_once ("../controle/controle.php");
Sessao::LoginNecessario();
$mensagem = Sessao::getMensagem();
$data_inicio = "01/" . date("m/Y");
$data_fim = date("t/m/Y");
// Executar código da visão
ob_start();
include ("../visoes/relatorio_quilometragem_form.php");
$conteudo = ob_get_contents();
ob_end_clean();
// Gerar HTML e mostrar
include ("../visoes/layout.php");
?>