<?php
require_once 'Persona.php';

class Usuario extends Persona {
	/**
	* Clase que abstrae un cliente
	* esta clase extiende a la clase Persona
	**/

	/**
	* Nombre del usuario
	* @var login_usuario
	**/
    //private $login_usuario;
	/**
	* Contraseña del usuario
	* @var contrasena
	**/
	public $contrasena;
	/**
	* Contraseña del usuario
	* @var salt
	**/
	public $salt;
	/**
	* Fecha de registro del usuario
	* @var fechaRegistro
	**/
	//private $fecha_registro;
	/**
	* Fecha de registro del usuario
	* @var rol
	**/
	//private $rol;
	/**
	* Fecha de registro del usuario
	* @var activo
	**/
	//private $activo;
    //private $id_persona;
	/**
	* Método constructor de la clase cliente
	* @param username - nombre del usuario (nickname)
	* @param password - contraseña 
	* @param fechaRegistro - fecha de registro
	* @param nombre - primer nombre del usuario
	* @param apellidoPaterno - apellido paterno
	* @param apellidoMaterno - apellido materno
	* @param correoElectronico - correo electrónico
	**/
	public function __construct($username=null,
                                $password=null,
                                $fechaRegistro=null,
                                $id_persona=null,
                                $rol=null,
                                $nombre=null,
                                $apellidoPaterno=null,
                                $apellidoMaterno=null,
                                $correoElectronico=null,
                                $activo=null) {

        
		parent::__construct($id_persona,
                            $nombre,
                            $apellidoPaterno,
                            $apellidoMaterno,
                            $correoElectronico);
        
        if($username) { $this->login_usuario=$username; }
        if($password) { $this->contrasena=$password; }  
        if($fechaRegistro) {$this->fecha_registro=$fechaRegistro; }
        if($id_persona) { $this->id_persona=$id_persona; }
        if($rol) { $this->rol=$rol;}
        if($activo) { $this->activo=$activo;}
        $this->setTabla('usuario');
        $this->setClase('Usuario');
        $this->setPK('login_usuario');	        
	}
    
    /**
    * Método que regresa el nombre del usuario (nickname)
    * @return username
    **/
	public function getUsername() {
		return $this->login_usuario;
	}
    
    /**
    * Método que regresa la contraseña del usuario
    * @return contraseña
    **/
	public function getPassword() {
		return $this->contrasena;
	}
    
    /**
    * Método que regresa el nombre del usuario (nickname)
    * @return salt
    **/
	public function getSalt() {
		return $this->salt;
	}
        
    /**
    * Método que regresa la fecha de registro
    * @return fecha de registro
    **/
	public function getFechaRegistro() {
		return $this->$fecha_registro;
	}
    
    /**
    * Método que regresa el nombre del usuario (nickname)
    * @return username
    **/
	public function setUsername($usr) {
		$this->login_usuario = $usr;
	}
    
    /**
    * Método que regresa la contraseña del usuario
    * @return contraseña
    **/
	public function setPassword($pass) {
		$this->contrasena = $pass;
	}
    
    /**
    * Método que regresa el nombre del usuario (nickname)
    * @return salt
    **/
	public function setSalt($salt) {
		$this->salt = $salt;
	}
        
    /**
	 * Método privado para generar un salt para 'cifrar' el password
	 */
	private static function generarSalt() {
		$CLENGTH = 16; $CSTRONG = true;
		return bin2hex(openssl_random_pseudo_bytes($CLENGTH, $CSTRONG));
	}
    
	/**
	 * Método para 'cifrar' password del usuario del sistema
	 */
	private function cifraContrasena() {
		$this->contrasena= hash('sha256', $this->salt . $this->contrasena);
	}

	/**
	 * Método para dar de alta un nuevo usuario en el sistema
	 */
	public function registrar() {
		$this->salt = self::generarSalt();
 		$this->cifraContrasena();
		
        $this->saveUser();
    }

    public function getJSONEncodeUser() {
        return json_encode(get_object_vars($this));
    }
    
    public function existsUser(){
        return $this->exists($this->login_usuario);
    }
    
    public function saveUser(){
		$usuario = [
			'activo' => $this->activo,
			'salt' => $this->salt,
			'contrasena' => $this->contrasena,
			'id_persona' => $this->id_persona,
			'fecha_registro' => $this->fecha_registro,
			'login_usuario' => $this->login_usuario,
            'rol' => $this->rol
		];
        $this->insert($usuario);
    }

    public function iniciaSesion(){
        $usuarioBase = new Usuario();
        $usuarioBase->getById($this->getUsername(),$usuarioBase);
        $this->setSalt($usuarioBase->getSalt());
        $this->cifraContrasena();
        
        return $this->getPassword() === $usuarioBase->getPassword();
    }
    

}

//$usu=new Usuario('dolivares','dolivares');
//var_dump($usu->iniciaSesion());

