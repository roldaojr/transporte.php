<?php
require_once (dirname(__FILE__) . "/Entidade.php");
/**
 * Cadastro de motoristas
 */
class Motorista extends Entidade {

	/**
	 * ID do motorista
	 * @var      int
	 */
	private $ID;

	/**
	 * Nome do motorista
	 * @var      string
	 */
	private $Nome;

	/**
	 * Telefone do motorista
	 * @var      int
	 */
	private $Telefone;

	/**
	 * Endereço do motorista
	 * @var      string
	 */
	private $Endereco;

	/**
	 * Número da carteira de habilitação
	 * @var      int
	 */
	private $CnhNumero;

	/**
	 * Categoria da Carteira de Haibilitação
	 * @var      int
	 */
	private $CnhCategoria;

	/**
	 * Retornar uma lista registros do banco de dados
	 * @param    string $criterios   Critérios de busca
	 * @return   array
	 */
	public static function Listar($criterios =null) {
		$lista = array();
		self::Conectar();
		$consulta = "select * from motorista";
		if($criterios) {
			$consulta .= " where $criterios";
		}
		$consulta .= " order by Nome";
		$resultado = mysql_query($consulta);
		if(mysql_num_rows($resultado) > 0) {
			while($linha = mysql_fetch_object($resultado, "motorista")) {
				$lista[] = $linha;
			}
		}
		return $lista;
	}

	/**
	 * Ler registro do banco de dados através de seu ID
	 * @param    int $id
	 * @return   Motorista
	 */
	public static function Consultar($id) {
		self::Conectar();
		$resultado = mysql_query("select * from motorista where id = $id");
		if(mysql_affected_rows() > 0) {
			$linha = mysql_fetch_object($resultado, "motorista");
			return $linha;
		} else {
			$motorista = new Motorista();
			$motorista -> ID = 0;
			$motorista -> Nome = "Nenhum";
			return $motorista;
		}
	}

	/**
	 * Salvar registro no banco de dados
	 * @return   void
	 */
	public function Salvar() {
		self::Conectar();
		if($this -> ID > 0) {
			$consulta = "update motorista set
			nome = '$this->Nome',
			endereco = '$this->Endereco',
			cnhnumero = '$this->CnhNumero',
			cnhcategoria = '$this->CnhCategoria',
			telefone = '$this->Telefone'
			where ID = $this->ID";
			mysql_query($consulta);
		} else {
			$consulta = "insert into motorista (nome, endereco, cnhnumero, cnhcategoria, telefone) values
			('$this->Nome', '$this->Endereco','$this->CnhNumero','$this->CnhCategoria','$this->Telefone')";
			mysql_query($consulta);
			$this -> ID = mysql_insert_id();
		}
	}

	/**
	 * Escluir um registro do banco de dados
	 * @return   void
	 */
	public function Excluir() {
		self::Conectar();
		if($this -> ID) {
			mysql_query("delete from motorista where id = $this->ID");
		}
	}

	/**
	 * Validar dados do motorista
	 * @return   int

	 */
	public function Validar() {
		$this -> Erros = array();
		if(strlen(trim($this -> Nome)) < 4) {
			$this -> Erros["Nome"] = "O nome deve ter 4 ou mais caracteres";
		}
		if(intval($this -> CnhNumero) < 1) {
			$this -> Erros["CnhNumero"] = "não é um número valido";
		}
		if(strlen(trim($this -> CnhCategoria)) < 1) {
			$this -> Erros["CnhCategoria"] = "categoria não é valida";
		}
		self::Conectar();
		$res = mysql_query("select id from motorista where CnhNumero = '{$this->CnhNumero}'");
		if(mysql_num_rows($res) > 0) {
			list($id) = mysql_fetch_row($res);
			if($id != $this -> ID) {
				$this -> Erros["Nº carteira"] = "Já existe com a carteira informada";
			}
		}
		return parent::Validar();
	}

	/**
	 * Listar viagens relacionadas a este motorista
	 * @param    string $criterios   Critérios de busca
	 * @return   array
	 */
	public function ListarViagens($criterios =null) {
		$lista = array();
		self::Conectar();
		$resultado = mysql_query("select * from viagem where motorista_id = $this->ID");
		while($linha = mysql_fetch_object($resultado, "viagem")) {
			$lista[] = $linha;
		}
		return $lista;
	}

	/**
	 * @return   int
	 */
	public function getID() {
		return $this -> ID;
	}

	/**
	 * @return   string
	 */
	public function getNome() {
		return $this -> Nome;
	}

	/**
	 * @param    string $newNome
	 * @return   void
	 */
	public function setNome($newNome) {
		$this -> Nome = $newNome;
	}

	/**
	 * @return   int
	 */
	public function getTelefone() {
		return $this -> Telefone;
	}

	/**
	 * @param    int $newTelefone
	 * @return   void
	 */
	public function setTelefone($newTelefone) {
		$this -> Telefone = $newTelefone;
	}

	/**
	 * @return   string
	 */
	public function getEndereco() {
		return $this -> Endereco;
	}

	/**
	 * @param    string $newEndereco
	 * @return   void
	 */
	public function setEndereco($newEndereco) {
		$this -> Endereco = $newEndereco;
	}

	/**
	 * @return   int
	 */
	public function getCnhNumero() {
		return $this -> CnhNumero;
	}

	/**
	 * @param    int $newCnhNumero
	 * @return   void
	 */
	public function setCnhNumero($newCnhNumero) {
		$this -> CnhNumero = $newCnhNumero;
	}

	/**
	 * @return   int
	 */
	public function getCnhCategoria() {
		return $this -> CnhCategoria;
	}

	/**
	 * @param    int $newCnhCategoria
	 * @return   void
	 */
	public function setCnhCategoria($newCnhCategoria) {
		$this -> CnhCategoria = $newCnhCategoria;
	}

}
?>
