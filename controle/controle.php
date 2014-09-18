<?php
require_once(dirname(__FILE__)."/sessao.php");

function __autoload($class = null) {
	if($class) {
		include_once(dirname(__FILE__)."/../modelos/$class.php");
	}
}

Sessao::Iniciar();
?>