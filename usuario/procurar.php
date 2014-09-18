<?php
require_once ("../modelos/Usuario.php");
if(isset($_GET["id"]) and $_GET["id"]) {
	$id = $_GET["id"];
	$usuario = Usuario::Consultar($id);
	if($usuario -> getID() == $id) {
		echo htmlentities($usuario -> getNome());
	} else {
		echo "<span class=\"error\">Usu&aacute;rio n&atilde;o encontrado</span>";
	}
}
?>