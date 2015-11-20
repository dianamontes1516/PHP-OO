<?php
require_once 'Database.inc.php';

class Persona extends Modelo{
	/**
	* Clase que abstrae a una persona
	* Esta clase contiene el nombre y el contacto (email)
	**/
	/** 
     * Primer nombre de la persona
     * @var id
     */
    //    private $id;
	/** 
     * Primer nombre de la persona
     * @var nombre
     */
    //private $nombre;
    /** 
     * Apellido paterno de la persona
     * @var apellidoPaterno
     */
    //private $apellido_paterno;
    /** 
     * Apellido materno de la persona
     * @var apellidoMaterno
     */
    //private $apellido_materno;
    /** 
     * Correo electrónico de la persona
     * @var correoElectronico
     */
    //private $correo;

    /**
    * Método constructor de la persona
    * @param nombre - de la persona
    * @param apellidoPaterno - de la persona
    * @param apellidoMaterno - de la persona
    * @param correoElectronico - de la persona
    **/
    public function __construct($id=null,$nombre=null, $apellidoPaterno=null,
                                $apellidoMaterno=null, $correoElectronico=null){

        parent::__construct('persona','Persona','id');

        if($id) { $this->id=$id; }
        if($nombre) { $this->nombre=self::nombreMayMin($nombre); }  
        if($apellidoPaterno) { $this->apellido_paterno=self::nombreMayMin($apellidoPaterno); }
        if($apellidoMaterno) { $this->apellido_materno=self::nombreMayMin($apellidoMaterno); }
        if($correoElectronico) { $this->correo=$correoElectronico;}

    }

    private static function nombreMayMin($cadena){
        return strtoupper($cadena[0]).substr($cadena,1);
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
		return $this->correo;
	}
    /**
    * Método que regresa el correo de la persona
    * @return correo electrónico de la persona
    **/
   	public function getIdPersona() {
		return $this->id;
	}
    /**
    * Método que pasa a cadena la clase Persona
    * @return  cadena con el nombre completo y el correo electrónico de la persona
    * separados por saltos de línea
    **/
	public function __toString() {
		return $this->nombre."\n".$this->apellido_paterno."\n".$this->apellido_materno."\n".$this->correo;

	}
    
    public function getJSONEncodePerson() {
        return json_encode(get_object_vars($this));
    }

    public function getArray() {
        return json_decode($this->getJSONEncode());
    }

    public function existsPerson(){
        return $this->exists($this->id);
    }

    public function savePerson(){
        $this->insert(json_decode($this->getJSONEncodePerson(),true));
    }
}

// $persona = new Persona(21,'pedro','vallarta','montes','pedro@stern.com');
// var_dump($persona->getJSONEncode());
//$persona->savePerson();

// if($persona->existsPerson()){
//     echo "S� hay persona";
    
// }else{
//     echo "No hay persona";
// }



?>