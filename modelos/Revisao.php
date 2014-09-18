<?php
require_once (dirname(__FILE__) . "/Entidade.php");
/*
 * Controle de revisões
 */
class Revisao extends Entidade {
	/**
	 * ID da revisão
	 * @var      int
	 */
	private $ID;

	/**
	 * Data em que foi feita a revisão
	 * @var      string
	 */
	private $Data;

	/**
	 * Quilometragem no momento da revisão
	 * @var      int
	 */
	private $Quilometragem;

	/**
	 * Detalhes sobre a revisão
	 * @var      string
	 */
	private $Descricao;

	/**
	 * ID do veículo associado
	 * @var      int
	 */
	private $Veiculo_ID;

	/**
	 * Construtor
	 * @param    int    $veiculoId   ID do veículo associado
	 * @return   void
	 */
	public function __construct($veiculoId =null) {
		$this -> Veiculo_ID = $veiculoId;
	}

	/**
	 * Retornar uma lista registros do banco de dados
	 * @param    int    $veiculoId    ID do veículo a qual pertence a revisão
	 * @param    string $criterios    Cristérios da consulta
	 * @return   array
	 */
	public static function Listar($veiculoId, $criterios =null) {
		$lista = array();
		self::Conectar();
		$consulta = "select * from revisao where veiculo_id = $veiculoId";
		if($criterios) {
			$consulta .= " where $criterios";
		}
		$consulta .= " order by Data desc";
		$resultado = mysql_query($consulta);
		if(mysql_num_rows($resultado) > 0) {
			while($linha = mysql_fetch_object($resultado, "revisao")) {
				$lista[] = $linha;
			}
		}
		return $lista;
	}

	/**
	 * Ler registro do banco de dados através de seu ID
	 * @param    int $veiculoId    ID do veículo a qual pertence a revisão
	 * @param    int $id           ID o item a ser consultado
	 * @return   Revisao
	 */
	public static function Consultar($veiculoId, $id) {
		self::Conectar();
		$resultado = mysql_query("select * from revisao where id = $id and veiculo_id = $veiculoId");
		if(mysql_affected_rows() > 0) {
			$linha = mysql_fetch_object($resultado, "Revisao");
			return $linha;
		} else {
			return false;
		}
	}

	public function Salvar() {
		self::Conectar();
		// Checar de o objeto foi lido do banco de dados
		if($this -> ID > 0) {
			$consulta = "update revisao set
			data = '$data',
			quilomentragem= '$this->Quilomentragem',
			descricao = '$this->Descricao',
			where ID = $this->ID";
			mysql_query($consulta);
			if(mysql_errno() > 0) {
				throw new ErrorException("Erro ao salvar: " . mysql_error());
			}
		} else {
			$consulta = "insert into revisao (Data, Quilometragem, Descricao, Veiculo_ID)
			values('$this->Data', $this->Quilometragem, '$this->Descricao', $this->Veiculo_ID)";
			mysql_query($consulta);
			if(mysql_errno() > 0) {
				throw new ErrorException("Erro ao salvar: " . mysql_error());
			}
			// Colocar o ID gerado pelo insert no atributo
			$this -> ID = mysql_insert_id();
		}
	}

	public function Excluir() {
		self::Conectar();
		if($this -> ID) {
			mysql_query("delete from revisao where id = $this->ID");
		}
		if(mysql_errno() > 0) {
			throw new ErrorException("Erro ao salvar: " . mysql_error());
		}
	}

	/**
	 * Validar dados do motorista
	 * @return   int
	 */
	public function Validar() {
		if(strlen($this -> Data) < 10 or !DateTime::createFromFormat("Y-m-d", $this -> Data)) {
			$this -> Erros["Data"] = "Data inválida";
		}
		if(intval($this->Quilometragem) < 0) {
			$this -> Erros["Quilometragem"] = "Deve um número positivo válido";
		}
		return parent::Validar();
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
	public function getData() {
		if($this -> Data) {
			$data = DateTime::createFromFormat("Y-m-d", $this -> Data);
			return date_format($data, "d/m/Y");
		} else {
			return null;
		}
	}

	/**
	 * @param    String $newData
	 * @return   void
	 */
	public function setData($newData) {
		if($newData) {
			$data = DateTime::createFromFormat("d/m/Y", $newData);
			$this -> Data = date_format($data, "Y-m-d");
		} else {
			$this -> Data = $newData;
		}
	}

	/**
	 * @return   int
	 */
	public function getQuilometragem() {
		return $this -> Quilometragem;
	}

	/**
	 * @param    int $newQuilometragem
	 * @return   void
	 */
	public function setQuilometragem($newQuilometragem) {
		$this -> Quilometragem = $newQuilometragem;
	}

	/**
	 * @return   string
	 */
	public function getDescricao() {
		return $this -> Descricao;
	}

	/**
	 * @param    String $newDescricao
	 * @return   void
	 */
	public function setDescricao($newDescricao) {
		$this -> Descricao = $newDescricao;
	}

}
?>
