<?php
require_once("../controle/controle.php");
Sessao::LoginNecessario();

if(isset($_GET["usuario_id"]) and $_GET["usuario_id"]) {
	$usuario = Usuario::Consultar($_GET["usuario_id"]);
	var_dump($usuario);
} else {
	throw new InvalidArgumentException("ID do usuário não informado");
}
?>
