<?php

class Persona {

    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $correoElectronico;

    public function __construct($nombre, $apellidoPaterno, $apellidoMaterno, $correoElectronico){
        $this->nombre=$nombre;  
        $this->apellidoPaterno=$apellidoPaterno;
        $this->apellidoMaterno=$apellidoMaterno;
        $this->correoElectronico=$correoElectronico;
    }

   	public function getNombre() {
   		return $this->nombre;
   	}

   	public function getApellidoPaterno() {
   		return $this->apellidoPaterno;
   	}
   
   	public function getApellidoMaterno() {
   		return $this->apellidoMaterno;
   	}

   	public function getCorreo() {
		return $this->$correoElectronico;
	}

	public function __toString() {
		return $this->nombre."\n".$this->apellidoPaterno."\n".$this->apellidoMaterno."\n".$this->correoElectronico;

	}


}

class Cliente extends Persona {

	private $username;
	private $password;
	private $fechaRegistro;

	public function __construct($username, $password, $fechaRegistro, $nombre, $apellidoPaterno, $apellidoMaterno, $correoElectronico) {
		parent::__construct($nombre, $apellidoPaterno, $apellidoMaterno, $correoElectronico);
		$this->username=$username;
		$this->password=$password;
		$this->fechaRegistro=$fechaRegistro;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getFechaRegistro() {
		return $this->$fechaRegistro;
	}
}

class Administrador extends Persona {

	private $username;
	private $password;

	public function __construct($username, $password, $nombre, $apellidoPaterno, $apellidoMaterno, $correoElectronico) {
		parent::__construct($nombre, $apellidoPaterno, $apellidoMaterno, $correoElectronico);
		$this->username=$username;
		$this->password=$password;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getPassword() {
		return $this->password;
	}
}

$persona = new Persona("Cinthia Olivia", "Rodríguez", "Aguilar", "yomera@gmail.com");
$per=(string)$persona;
var_dump($per);


//leemos la fecha del día actual
$hoy = date("Y-m-d");

$cliente = new Cliente("fulano", "secreta", $hoy, "Lala", "Lele", "Lulu", "lili@lala.com");
$cliente=(string)$cliente;
var_dump($cliente);

$admin = new Administrador("admin", "pass", "Juan", "Mendez", "Mendiola", "jefecito@empresa.com");
$ad=(string)$admin;
var_dump($ad);


?>