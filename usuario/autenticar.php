<?php
require_once("../controle/controle.php");
if(isset($_POST["login"]) and $_POST["login"] and isset($_POST["senha"]) and $_POST["senha"]){
	$usuario = Usuario::Autenticar($_POST["login"], $_POST["senha"]);
	if($usuario) {
		$_SESSION["usuario"] = $usuario;
		Sessao::setMensagem("Usuario autenticado");
		echo "Usuario autenticado";
		Sessao::Direcionar("../index.php");
	} else {
		Sessao::setMensagem("Usuario ou senha inválidos");
		echo "Usuario ou senha inválidos";
		Sessao::Retornar();
	}
}
?>