<?php

class Paginador {
	/**
	 * Página atual
	 * @var int
	 */
	private $atual;

	/**
	 * Total de paginas
	 * @var int
	 */
	private $total;

	/**
	 * Limite de registros por página
	 * @var int
	 */
	private $limite;

	/**
	 * Total de registro do banco de dados
	 * @var int
	 */
	private $totalRegistros;

	/**
	 * Construtor
	 */
	public function __construct($totalRegistros =0, $limite =20) {
		$this -> totalRegistros = $totalRegistros;
		$this -> limite = $limite;
		if(isset($_GET["p"]) and $_GET["p"] > 0 and $_GET["p"] <= $this -> getTotal()) {
			$this -> atual = $_GET["p"];
		} else {
			$this -> atual = 1;
		}
	}

	/**
	 * @return int
	 */
	public function getAtual() {
		return $this -> atual;
	}

	/**
	 * @return int
	 */
	public function getTotal() {
		$this -> total = ceil($this -> totalRegistros / $this -> limite);
		return $this -> total;
	}

	public function getLimite() {
		return $this -> limite;
	}

	/**
	 *
	 */
	public function getOffset() {
		return $this -> limite * ($this -> atual - 1);
	}

}
?>