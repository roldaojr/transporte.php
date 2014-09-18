<?php
class Sessao {
	public function Iniciar() {
		// Iniciar sessão do PHP
		session_start();
	}

	public function Encerrar() {
		// Destruir sessão do PHP
		session_destroy();
	}

	/**
	 * Determina que o login é necessário
	 */
	public function LoginNecessario() {
		if(!isset($_SESSION["usuario"]) || !is_a($_SESSION["usuario"], "Usuario")) {
			header("Location: /transporte/usuario/login.php");
			die();
		}
	}

	public function Direcionar($url) {
		header("Location: " . $url);
		die();
	}

	/**
	 * Voltar á pagina anterior
	 */
	public function Retornar() {
		if(isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
			die();
		} else {
			die();
		}
	}

	/**
	 * Ler a mesangem definida
	 */
	public function getMensagem() {
		if(isset($_SESSION["mensagem"])) {
			$msg = $_SESSION["mensagem"];
			unset($_SESSION["mensagem"]);
			return $msg;
		} else {
			return null;
		}
	}

	/**
	 * Definir uma mensagem de aviso
	 */
	public function setMensagem($msg) {
		$_SESSION["mensagem"] = $msg;
	}

}
?>
