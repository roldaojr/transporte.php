<?php
/**
 * Classe abstrata que trata de toda a parte de manipulaçãoo do banco de dados.
 * Todos os objetos que necessitam de persistência devem extendê-la.
 */
define("LIMUTE_ITENS_POR_PAGINA", 20);
 
abstract class Entidade {

	/**
	 * Array contendo erros de validação
	 * @var      array
	 */
	protected $Erros;

	/**
	 * Construtor
	 */
	public function __consutrct() {
		$this -> Erros = array();
	}

	/*
	 * Conectar-se ao banco de dados
	 * @return   void
	 */
	protected function Conectar() {
		if(!mysql_connect('localhost', 'root', '')) {
			throw new ErrorException("Erro ao conectar-se ao banco de dados");
		}
		mysql_select_db("transporte");
	}

	/**
	 * Retornar uma lista registros do banco de dados
	 * @param    mixed $criterios    Cristérios da consulta
	 * @return   array
	 */
	public static function Listar($criterios =null){}

	/**
	 * Ler registro do banco de dados através de seu ID
	 * @param    int $id    ID o item a ser consultado
	 * @return   Entidade
	 */
	public static function Consultar($id){}

	/**
	 * Salvar registro no banco de dados
	 * @return   void
	 */
	public function Salvar() {}

	/**
	 * Escluir um registro do banco de dados
	 * @return   void
	 */
	public function Excluir() {}

	/**
	 * Validar dados do registro
	 * @return   boolean
	 */
	public function Validar() {
		if(count($this -> Erros) == 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @return   array
	 */
	public function getErros() {
		return $this -> Erros;
	}

}
?>
