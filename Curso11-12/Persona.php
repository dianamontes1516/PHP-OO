<?php
class Persona {
	/**
	* Clase que abstrae a una persona
	* Esta clase contiene el nombre y el contacto (email)
	**/

    
	/** 
     * Variable est�tica de numero de personas creadas
     * @var nombre
     */
    private static $poblacion = 0;
	/** 
     * Primer nombre de la persona
     * @var nombre
     */
    private $nombre;
    /** 
     * Apellido paterno de la persona
     * @var apellidoPaterno
     */
    private $apellido_paterno;
    /** 
     * Apellido materno de la persona
     * @var apellidoMaterno
     */
    private $apellido_materno;
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
    public function __construct($nombre, $apellidoPaterno, $apellidoMaterno, $correoElectronico){
        $this->nombre=$nombre;  
        $this->apellido_paterno=$apellidoPaterno;
        $this->apellido_materno=$apellidoMaterno;
        $this->correo=$correoElectronico;
        self::$poblacion++;
    }

    
    /**
    * Método que de acceso a la variable est�tica poblacion
    * @return nombre de la persona
    **/
    public static function getPoblacion(){
        return self::$poblacion;
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
   	public function getApellidoPaterno() {
   		return $this->apellido_paterno;
   	}
    /**
    * Método que regresa el apellido materno de la persona
    * @return apellido materno
    **/   
   	public function getApellidoMaterno() {
   		return $this->apellido_materno;
   	}
    /**
    * Método que regresa el correo de la persona
    * @return correo electrónico de la persona
    **/
   	public function getCorreo() {
		return $this->$correo;
	}
    /**
    * Método que asigna nombre a la persona
    **/
   	public function setNombre($nuevoNombre) {
   		$this->nombre = $nuevoNombre;
   	}
    /**
    * Método que asigna apellido paterno de la persona
    **/
   	public function setApellidoPaterno($nuevoAP) {
   		$this->apellido_paterno = $nuevoAP;
   	}
    /**
    * Método que asigna apellido materno de la persona
    **/   
   	public function setApellidoMaterno($nuevoAM) {
   		$this->apellido_materno = $nuevoAM;
   	}
    /**
    * Método que asina correo de la persona
    **/
   	public function setCorreo($nuevoCorreo) {
		$this->$correo = $nuevoCorreo;
	}

    /**
    * Método destructor
    **/
    public function __destruct(){
        echo "R.I.P.: ".$this->nombre;

    }

    /**
    * Método para saludar
    * @param nombre - recibe una cadena 
    **/
    public function saludaA($nombre){
    	   return "Hola " . $nombre . "</br>";
    }
}
