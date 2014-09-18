<?php
require_once (dirname(__FILE__) . "/Entidade.php");
require_once (dirname(__FILE__) . "/Motorista.php");
require_once (dirname(__FILE__) . "/Veiculo.php");
require_once (dirname(__FILE__) . "/Usuario.php");

define("VIAGEM_SITUACAO_SOLICITADA", 0);
define("VIAGEM_SITUACAO_APROVADA", 1);
define("VIAGEM_SITUACAO_REPROVADA", 2);
define("VIAGEM_SITUACAO_CANCELADA", 3);
define("VIAGEM_SITUACAO_REALIZADA", 4);

/**
 * Controle de viagens
 */
class Viagem extends Entidade {

	/**
	 * ID da viagem
	 * @var      int
	 */
	private $ID;

	/**
	 * Data em que foi solicitado
	 * @var      string
	 */
	private $Data;

	/**
	 * Destino da viagem
	 * @var      string
	 */
	private $Destino;

	/**
	 * Quantidade de pessoas
	 * @var      int
	 */
	private $QtdPessoas;

	/**
	 * Data e Hora de saída
	 * @var      string
	 */
	private $Saida;

	/**
	 * Data e Hora de chegada
	 * @var      string
	 */
	private $Chegada;

	/**
	 * @var      string
	 */
	private $Motivo;

	/**
	 * Situação atual da viagem
	 * @var      int
	 */
	private $Situacao;

	/**
	 * Quilometragem do veículo na saída
	 * @var      int
	 */
	private $KmSaida;

	/**
	 * Quilometragem do veículo na chegada
	 * @var      int
	 */
	private $KmChegada;

	/**
	 * Quantidade de combustível abastecida durante a viagem
	 * @var      int
	 */
	private $Abastecido;

	/**
	 * Veiculo que será usado na viagem
	 * @var      Veiculo
	 */
	private $Veiculo_ID;

	/**
	 * Motorista que irá dirigir o veículo utilizado na viagem
	 * @var      Motorista
	 */
	private $Motorista_ID;

	/**
	 * Matricual/CPF do Solicitante da viagem
	 * @var      Usuario
	 */
	private $Usuario_ID;

	/**
	 * Retornar uma lista registros do banco de dados
	 * @param    mixed $criterios    Cristérios da consulta
	 * @return   array
	 */
	public static function Listar($criterios =null, $limite =null) {
		$lista = array();
		self::Conectar();
		$consulta = "select * from viagem";
		if(isset($_SESSION["usuario"]) and is_a($_SESSION["usuario"], "Usuario") and $_SESSION["usuario"]->getTipo() == 0) {
			$criterio = "Usuario_ID = ".$_SESSION["usuario"]->getID();
			if($criterios) {
				$criterios .= " and $criterio";
			} else {
				$criterios = $criterio;
			}
		}
		if($criterios) {
			$consulta .= " where $criterios";
		}
		$consulta .= " order by Data desc";
		if($limite) {
			$consulta .= " limit $limite";
		}
		$resultado = mysql_query($consulta);
		if(mysql_affected_rows() > 0) {
			while($linha = mysql_fetch_object($resultado, "viagem")) {
				$lista[] = $linha;
			}
		}
		return $lista;
	}

	/**
	 * Ler registro do banco de dados através de seu ID
	 * @param    int $id    ID o item a ser consultado
	 * @return   Viagem
	 */
	public static function Consultar($id) {
		self::Conectar();
		$resultado = mysql_query("select * from viagem where id = $id");
		if(mysql_affected_rows() > 0) {
			$linha = mysql_fetch_object($resultado, "viagem");
			return $linha;
		} else {
			return false;
		}
	}

	/**
	 * Salvar registro no banco de dados
	 * @return   void
	 */
	public function Salvar() {
		self::Conectar();
		if(isset($_SESSION["usuario"]) and is_a($_SESSION["usuario"], "Usuario") and $_SESSION["usuario"]->getTipo() == 0) {
			$this->Usuario_ID = $_SESSION["usuario"]->getID();
		}
		if($this -> ID > 0) {
			$consulta = "update viagem set
			destino = '$this->Destino',
			situacao = '$this->Situacao',
			motivo = '$this->Motivo',
			qtdpessoas = '$this->QtdPessoas',
			saida = '$this->Saida',
			chegada = '$this->Chegada',
			motorista_id = '$this->Motorista_ID',
			veiculo_id = '$this->Veiculo_ID',
			usuario_id = '$this->Usuario_ID'
			where ID = $this->ID";
			if(!mysql_query($consulta)) {
				throw new ErrorException("Erro na consulta SQL: " . mysql_error());
			}
		} else {
			$consulta = "insert into viagem (data, destino, situacao, motivo, qtdpessoas, saida, chegada,
			usuario_id)
			values(now(), '$this->Destino', '$this->Situacao', '$this->Motivo', '$this->QtdPessoas',
			'$this->Saida', '$this->Chegada','$this->Usuario_ID')";
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
			mysql_query("delete from viagem where id = $this->ID");
		}
		if(mysql_errno() > 0) {
			throw new ErrorException("Erro ao salvar: " . mysql_error());
		}
	}

	/**
	 * Validar dados da viagem
	 * @return   boolean
	 */
	public function Validar() {
		$this -> Erros = array();
		if(!is_int($this -> Usuario_ID) and $this -> Usuario_ID < 0) {
			$this -> Erros["Solicitante"] = "ID de solicitante inválido";
		}
		if(strlen(trim($this -> Destino)) < 4) {
			$this -> Erros["Destino"] = "deve ter 4 ou mais caracteres";
		}
		if(strlen(trim($this -> Motivo)) < 4) {
			$this -> Erros["Motivo"] = "deve ter 4 ou mais caracteres";
		}
		if(intval($this -> QtdPessoas) < 1) {
			$this -> Erros["QtdPessoas"] = "deve ser um número inteiro maior que zero";
		}
		if(strlen($this -> Saida) < 10 or !DateTime::createFromFormat("Y-m-d", $this -> Saida)) {
			$this -> Erros["Saida"] = "Data em formato inválida";
		}
		if(strlen($this -> Chegada) < 10 or !DateTime::createFromFormat("Y-m-d", $this -> Chegada)) {
			$this -> Erros["Chegada"] = "Data em formato inválida";
		} elseif(!isset($this -> Erros["Saida"])) {
            $data1 = DateTime::createFromFormat("Y-m-d", $this -> Saida);
            $data2 = DateTime::createFromFormat("Y-m-d", $this -> Chegada);
            if($data1 > $data2) {
                $this -> Erros["Chegada"] = "Data de chegada inválida";
            }
		}
		return parent::Validar();
	}

	/**
	 * Contar total de registros
	 */
	public function Contar($criterios =null) {
		self::Conectar();
		$consulta = "select count(id) from viagem";
		if($criterios) {
			$consulta .= " where $criterios";
		}
		$resultado = mysql_query($consulta);
		if(mysql_affected_rows() > 0) {
			list($total) = mysql_fetch_array($resultado);
			return $total;
		} else {
			return 0;
		}
	}

	/**
	 * Aprovar a viagem
	 * Pode ser executado somente pelo coordenador
	 * @return   void
	 */
	public function Aprovar() {
		$this -> Situacao = VIAGEM_SITUACAO_APROVADA;
		$this -> Salvar();
	}

	/**
	 * Reprovar a viagem
	 * Pode ser executado somente pelo coordenador
	 * @return   void
	 */
	public function Reprovar() {
		$this -> Situacao = VIAGEM_SITUACAO_REPROVADA;
		$this -> Salvar();
	}

	/**
	 * Cancelar viagem
	 * Pode ser feita pelo coordenador ou pelo solicitante
	 * @return   void
	 */
	public function Cancelar() {
		$this -> Situacao = VIAGEM_SITUACAO_CANCELADA;
		$this -> Salvar();
	}

	public function Realizada() {
		$this -> Situacao = VIAGEM_SITUACAO_REALIZADA;
		$this -> Salvar();
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
		$data = DateTime::createFromFormat("Y-m-d H:i:s", $this -> Data);
		if($data) {
			return date_format($data, "d/m/Y h:i:s");
		} else {
			return "null";
		}
	}

	/**
	 * @return   string
	 */
	public function getDestino() {
		return $this -> Destino;
	}

	/**
	 * @param    string $newDestino
	 * @return   void
	 */
	public function setDestino($newDestino) {
		$this -> Destino = $newDestino;
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
	 * @return   string
	 */
	public function getSaida() {
		if($this -> Saida) {
			$datahora = DateTime::createFromFormat("Y-m-d", $this -> Saida);
			if($datahora) {
				return date_format($datahora, "d/m/Y");
			} else {
				return null;
			}
		} else {
			return null;
		}
	}

	/**
	 * @param    string $newSaida
	 * @return   void
	 */
	public function setSaida($newSaida) {
		if($newSaida) {
			$datahora = DateTime::createFromFormat("d/m/Y", $newSaida);
			if($datahora) {
				$this -> Saida = date_format($datahora, "Y-m-d");
			} else {
				$this -> Saida = null;
			}
		} else {
			$this -> Saida = null;
		}
	}

	/**
	 * @return   string
	 */
	public function getChegada() {
		if($this -> Chegada) {
			$datahora = DateTime::createFromFormat("Y-m-d", $this -> Chegada);
			if($datahora) {
				return date_format($datahora, "d/m/Y");
			} else {
				return null;
			}
		} else {
			return null;
		}
	}

	/**
	 * @param    string $newChegada
	 * @return   void
	 */
	public function setChegada($newChegada) {
		if($newChegada) {
			$datahora = DateTime::createFromFormat("d/m/Y", $newChegada);
			if($datahora) {
				$this -> Chegada = date_format($datahora, "Y-m-d");
			} else {
				$this -> Chegada = null;
			}
		} else {
			$this -> Chegada = null;
		}
	}

	/**
	 * @return   string
	 */
	public function getMotivo() {
		return $this -> Motivo;
	}

	/**
	 * @param    string $newMotivo
	 * @return   void
	 */
	public function setMotivo($newMotivo) {
		$this -> Motivo = $newMotivo;
	}

	/**
	 * @return   int
	 */
	public function getSituacao() {
		return $this -> Situacao;
	}

	/**
	 * @return   string
	 */
	public function getSituacaoAsString() {
		$VIAGEM_SITUACOES = array(0 => "Solicitada", 1 => "Aprovada", 2 => "Reprovada", 3 => "Cancelada", 4 => "Realizada");
		return $VIAGEM_SITUACOES[$this -> Situacao];
	}

	/**
	 * @return   int
	 */
	public function getKmSaida() {
		return $this -> KmSaida;
	}

	/**
	 * @param    int $newKmSaida
	 * @return   void
	 */
	public function setKmSaida($newKmSaida) {
		$this -> KmSaida = $newKmSaida;
	}

	/**
	 * @return   int
	 */
	public function getKmChegada() {
		return $this -> KmChegada;
	}

	/**
	 * @param    int $newKmChegada
	 * @return   void
	 */
	public function setKmChegada($newKmChegada) {
		$this -> KmChegada = $newKmChegada;
	}

	/**
	 * @return   int
	 */
	public function getAbastecido() {
		return $this -> Abastecido;
	}

	/**
	 * @param    int $newAbastecido
	 * @return   void
	 */
	public function setAbastecido($newAbastecido) {
		$this -> Abastecido = $newAbastecido;
	}

	/**
	 * @return   Veiculo
	 */
	public function getVeiculo() {
		return Veiculo::Consultar($this -> Veiculo_ID);
	}

	/**
	 * @param    Veiculo $newVeiculo
	 * @return   void
	 */
	public function setVeiculo(Veiculo$newVeiculo) {
		$this -> Veiculo_ID = $newVeiculo -> getID();
	}

	/**
	 * @return   Motorista
	 */
	public function getMotorista() {
		return Motorista::Consultar($this -> Motorista_ID);
	}

	/**
	 * @param    Motorista $newMotorista
	 * @return   void
	 */
	public function setMotorista(Motorista$newMotorista) {
		$this -> Motorista_ID = $newMotorista -> getID();
	}

	/**
	 * @return   Usuario
	 */
	public function getSolicitante() {
		return Usuario::Consultar($this -> Usuario_ID);
	}

	/**
	 * @param    Usuario $newSolicitante
	 * @return   void
	 */
	public function setSolicitante(Usuario $newSolicitante) {
		var_dump($newSolicitante);
		$this -> Usuario_ID = $newSolicitante -> getID();
	}

}
?>
