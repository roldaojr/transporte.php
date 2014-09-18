<?php
require_once (dirname(__FILE__) . "/Entidade.php");
require_once (dirname(__FILE__) . "/Revisao.php");
/**
 * Cadastro de Veículos
 */
class Veiculo extends Entidade {

	/**
	 * ID do veículo
	 * @var      int
	 */
	private $ID;

	/**
	 * Tipo do Veículo
	 * @var      string
	 */
	private $Tipo;

	/**
	 * Placa do veículo
	 * @var      string
	 */
	private $Placa;

	/**
	 * Categoria do veículo
	 * @var      string
	 */
	private $Categoria;

	/**
	 * Quantidade míxima de pessoas que o veículo pode transportar
	 * @var      int
	 */
	private $QtdPessoas;

	/**
	 * Retornar uma lista registros do banco de dados
	 * @param    string $criterios   Critérios de busca
	 * @return   array
	 */
	public static function Listar($criterios =null) {
		$lista = array();
		self::Conectar();
		$consulta = "select * from veiculo";
		if($criterios) {
			$consulta .= " where $criterios";
		}
		$consulta .= " order by Placa";
		$resultado = mysql_query($consulta);
		if(mysql_num_rows($resultado) > 0) {
			while($linha = mysql_fetch_object($resultado, "veiculo")) {
				$lista[] = $linha;
			}
		}
		return $lista;
	}

	public static function Consultar($id) {
		if($id > 0) {
			self::Conectar();
			$resultado = mysql_query("select * from veiculo where id = $id");
			if(mysql_affected_rows() > 0) {
				$linha = mysql_fetch_object($resultado, "veiculo");
				return $linha;
			} else {
				return false;
			}
		} else {
			$veiculo = new Veiculo();
			$veiculo -> ID = 0;
			$veiculo -> Tipo = "Nenhum";
			return $veiculo;
		}
	}

	/**
	 * Ler registro do banco de dados através de seu ID
	 * @param    int $id
	 * @return   Veiculo
	 */
	public function Salvar() {
		self::Conectar();
		if($this -> ID > 0) {
			$consulta = "update veiculo set
			tipo = '$this->Tipo',
			placa = '$this->Placa',
			qtdpessoas = $this->QtdPessoas,
			categoria = '$this->Categoria'
			where ID = $this->ID";
			mysql_query($consulta);
			if(mysql_errno() > 0) {
				throw new ErrorException("Erro ao salvar: " . mysql_error());
			}
		} else {
			$consulta = "insert into Veiculo (tipo, placa, categoria, qtdpessoas) values
			('$this->Tipo','$this->Placa','$this->Categoria','$this->QtdPessoas')";
			mysql_query($consulta);
			if(mysql_errno() > 0) {
				throw new ErrorException("Erro ao salvar: " . mysql_error());
			}
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
			mysql_query("delete from veiculo where id = $this->ID");
		}
		if(mysql_errno() > 0) {
			throw new ErrorException("Erro ao salvar: " . mysql_error());
		}
	}

	/**
	 * Validar dados do veículo
	 * @return   boolean
	 */
	public function Validar() {
		$this -> Erros = array();
		if(strlen(trim($this -> Tipo)) < 1) {
			$this -> Erros["Destino"] = "O tipo deve ser informado";
		}
		if(strlen(trim($this -> Categoria)) < 1) {
			$this -> Erros["Motivo"] = "A categoria deve ser informada";
		}
		if(intval($this -> QtdPessoas) < 1) {
			$this -> Erros["QtdPessoas"] = "A quantidade de pessoas deve ser um número inteiro maior que zero";
		}
		if(strlen(trim($this -> Placa)) < 6) {
			$this -> Erros["Placa"] = "A placa deve ser informada";
		}
		self::Conectar();
		$res = mysql_query("select id from veiculo where placa = '{$this->Placa}'");
		if(mysql_num_rows($res) > 0) {
			list($id) = mysql_fetch_row($res);
			if($id != $this -> ID) {
				$this -> Erros["Placa"] = "Já existe um veiculo com a placa informada";
			}
		}
		return parent::Validar();
	}

	/**
	 * Listar as revisíes realizadas no veículo
	 * @param    string $criterios   Critérios de busca
	 * @return   array
	 */
	public function ListarRevisoes($criterios =null) {
		if($this -> ID > 0) {
			return Revisao::Listar($this -> ID);
		} else {
			return array();
		}
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
	public function getTipo() {
		return $this -> Tipo;
	}

	/**
	 * @param    string $newTipo
	 * @return   void
	 */
	public function setTipo($newTipo) {
		$this -> Tipo = $newTipo;
	}

	/**
	 * @return   string
	 */
	public function getPlaca() {
		return $this -> Placa;
	}

	/**
	 * @param    string $newPlaca
	 * @return   void
	 */
	public function setPlaca($newPlaca) {
		$this -> Placa = $newPlaca;
	}

	/**
	 * @return   string
	 */
	public function getCategoria() {
		return $this -> Categoria;
	}

	/**
	 * @param    string $newCategoria
	 * @return   void
	 */
	public function setCategoria($newCategoria) {
		$this -> Categoria = $newCategoria;
	}

	/**
	 * @return   int
	 */
	public function getQtdPessoas() {
		return $this -> QtdPessoas;
	}

	/**
	 * @param    int $newQtdPessoas
	 * @return   void
	 */
	public function setQtdPessoas($newQtdPessoas) {
		$this -> QtdPessoas = $newQtdPessoas;
	}

	/**
	 * @return   boolean
	 */
	public function isEmRevisao() {
		return $this -> EmRevisao;
	}

	/**
	 * @param    boolean $newEmRevisao
	 * @return   void
	 */
	public function setEmRevisao($newEmRevisao) {
		$this -> EmRevisao = $newEmRevisao;
	}

}
?>
