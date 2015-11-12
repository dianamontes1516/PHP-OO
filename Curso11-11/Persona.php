<?php

class Persona {
	/**
	* Clase que abstrae a una persona
	* Esta clase contiene el nombre y el contacto (email)
	**/
	/** 
     * Primer nombre de la persona
     * @var nombre
     */
    private $nombre = "Pedro";
    /** 
     * Apellido paterno de la persona
     * @var apellidoPaterno
     */
    private $apellido_paterno = "Juarez";
    /** 
     * Apellido materno de la persona
     * @var apellidoMaterno
     */
    private $apellido_materno = "Romero";
    /** 
     * Correo electrónico de la persona
     * @var correoElectronico
     */
    private $correo;

    /**
    * Método constructor de la persona
    * @param nombre - de la persona
    * @param apellidoPaterno - de la persona
    * @param apellidoMaterno - de la persona
    * @param correoElectronico - de la persona
    **/
    public function __construct(){
    }

    /**
    * Método que regresa el primer nombre de la persona
    * @return nombre de la persona
    **/
   	public function getNombre() {
   		return $this->nombre;
   	}
    /**
    * Método que regresa el apellido paterno de la persona
    * @return apellido paterno
    **/

    /**
    * Método que regresa el apellido materno de la persona
    * @return apellido materno
    **/   

    /**
    * Método que regresa el correo de la persona
    * @return correo electrónico de la persona
    **/

    /**
    * Método que asigna nombre a la persona
    **/
   	public function setNombre($nuevoNombre) {
   		$this->nombre = $nuevoNombre;
   	}
    /**
    * Método que asigna apellido paterno de la persona
    **/

    /**
    * Método que asigna apellido materno de la persona
    **/   

    /**
    * Método que asina correo de la persona
    **/
    
    /**
    * Método que regresa a un saludo a la persona con nombre $nombre
    * @param nombre - Nombre de la persona a saludar
    * @return  cadena con saludo
    **/
    public function saludaA($nombre) {
		return "Hola ".$nombre."!\n";
	}

}


?>