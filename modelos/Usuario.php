<?php
require_once (dirname(__FILE__) . "/Entidade.php");
/**
 * Controle de contas de usuário
 */
class Usuario extends Entidade {

	private static $ldap_servidor = "192.168.89.2:389";
	private static $ldap_dominio = "lanserv.local";
	private static $ldap_dnbase = "dc=lanserv,dc=local";
	private static $ldap_rdn = "ldapq@lanserv.local";
	private static $ldap_senha = "ldapq";
	private static $ldap;

	/**
	 * IFRN-ID do usuário
	 * @var      int
	 */
	private $ID;

	/**
	 * Nome completo do usuário
	 * @var      string
	 */
	private $Nome;

	/**
	 * Tipo do usuário
	 * @var      int
	 */
	private $Tipo = 0;

	/**
	 * Criar novo usuario
	 * @param   int   IFRN-ID do usuário no servidor LDAP
	 */
	public function __construct($id =null, $nome =null, $tipo=0) {
		if($id)	$this -> ID = $id;
		if($nome) $this -> Nome = $nome;
		$this -> Tipo = $tipo;
	}

	/**
	 * Conectar-se ao servidor LDAP
	 * @return   void
	 */
	private static function ConectarLdap() {
		if(!function_exists("ldap_connect")) {
			throw new ErrorException("PHP não suporta chamadas LDAP");
			return false;
		}
		self::$ldap = ldap_connect(self::$ldap_servidor, 389);
		ldap_set_option(self::$ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option(self::$ldap, LDAP_OPT_REFERRALS, 0);
	}

	/**
	 * Desconectar-se do servidor LDAP
	 * @return   void
	 */
	private static function DesconectarLdap() {
		@ldap_unbind(self::$ldap);
		@ldap_close(self::$ldap);
	}

	/**
	 * Ler informações do usuário do servidor LDAP através de seu ID
	 * @param    int $id   IFRN-ID do usuário
	 * @return   mixed     Objeto usuário caso o usuário seja ecnotrado, false caso contrário.
	 */
	private static function ConsultarLdap($id) {
		// Verificar se o PHP suporta conexão LDAP
		if(!function_exists("ldap_connect")) {
			return false;
		}
		try {
			self::ConectarLdap();
			if(ldap_bind(self::$ldap, self::$ldap_rdn, self::$ldap_senha)) {
				$filtro = "(&(objectCategory=person)(sAMAccountName=$id))";
				$atributos = array("displayname", "sn", "givenname", "memberof");
				// preencher dados do usuário com o dados do AD
				$result = ldap_search(self::$ldap, self::$ldap_dnbase, $filtro, $atributos);
				$itens = ldap_get_entries(self::$ldap, $result);
				if($itens["count"] == 1) {
					$nome = $itens[0]["givenname"][0] . " " . $itens[0]["sn"][0];
					$usuario = new Usuario();
					$usuario -> ID = $id;
					$usuario -> Nome = $nome;
					if(isset($itens[0]["memberof"])) {
						foreach($itens[0]["memberof"] as $grupo) {
							if(stristr($grupo, "G_PF_COORD_SERVICOS_GERAIS_MANUTENCAO")
							or stristr($grupo, "G_PF_COORD_GESTAO_TI")
							) {
								$usuario -> Tipo = 1;
								break;
							} else {
								$usuario -> Tipo = 0;
							}
						}
					} else {
						$usuario -> Tipo = 0;
					}
					$usuario -> Salvar();
					return $usuario;
				} else {
					return null;
				}
			}
		} catch(Exception $ex) {
			throw new ErrorException("Erro de conexão com o LDAP: " . $ex -> getMessage());
		}
		self::DesconectarLdap();
		return false;
	}

	/**
	 * Ler informações do usuário do banco de dadosatravés de seu ID
	 * @param    int $id   IFRN-ID do usuário
	 * @return   mixed     Objeto usuário caso o usuário seja ecnotrado, false caso contrário.
	 */
	private static function ConsultarBd($id) {
		$usuario = null;
		if($id > 0) {
			self::Conectar();
			$resultado = mysql_query("select * from usuario where id = '$id'");
			if(mysql_num_rows($resultado) > 0) {
				$usuario = mysql_fetch_object($resultado, "usuario");
			}
		}
		return $usuario;
	}

	
	/**
	 * Ler registro do banco de dados através de seu ID
	 * @param    int $id   IFRN-ID do usuário
	 * @return   Usuario   Objeto contendo dados do usuário.
	 */
	public static function Consultar($id) {
		$usuario = null;
		if($id) {
			$usuario = self::ConsultarLdap($id);
			if(!$usuario) {
				$usuario = self::ConsultarBD($id);
			}
			if(!$usuario) {
				$usuario = new Usuario(0, "Nenhum");
			}
		} else {
			$usuario = new Usuario(0, "Nenhum");
		}
		return $usuario;
	}

    /**
    * Salvar registro no banco de dados
    * @return   void
    */
    public function Salvar()
    {
    	self::Conectar();
      $r = mysql_query("select ID from usuario where ID = $this->ID");
		if(mysql_num_rows($r) > 0) {
			$consulta = "update usuario set
			Nome = '$this->Nome',
			Tipo = $this->Tipo
			where ID = '$this->ID'";
		} else {
			$consulta = "insert into usuario (ID, Nome, Tipo)
			values('$this->ID', '$this->Nome', $this->Tipo)";
		}
		mysql_query($consulta);
		if(mysql_errno() > 0) {
			throw new ErrorException("Erro ao salvar: " . mysql_error());
		}
    }
    

	/**
	 * Autenticar o usuário no Active Directory e retornar um objeto usuário com o dados do usuario.
	 * @param    string $id       IFRN-ID do usuário.
	 * @param    string $senha    Senha do usuário.
	 * @return   mixed            Objeto usuário caso o usuário seja autenticado com sucesso, false caso contrário.
	 */
	public static function Autenticar($id, $senha) {
		$usuario = null;
		self::ConectarLdap();
		// Autenticar usuário
		if(@ldap_bind(self::$ldap, $id . "@" . self::$ldap_dominio, $senha)) {
			self::DesconectarLdap();
			// Consultar dados do usuário
			$usuario = self::ConsultarLdap($id);
		} else {
			self::DesconectarLdap();
			$usuario = false;
		}
		return $usuario;
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
	 * @return   int
	 */
	public function getTipo() {
		return $this -> Tipo;
	}

}
?>
