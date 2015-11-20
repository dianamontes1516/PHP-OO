<?php
class BaseDatos{

  private static $_instancia = NULL;
      
  public static function getInstancia($manejador, 
			     $host, 
			     $usuario,
			     $password,
			     $base){
    if(is_null(self::$_instancia)){
      return new BaseDatos($manejador,
			   $host,
			   $usuario,
			   $password,
			   $base);
    }
    return self::$_instancia;
  } 
      
  private function __construct($manejador, $host, $usuario,
                               $password, $base){			
    $this->manejador = $manejador;
    $this->host      = $host;
    $this->usuario   = $usuario;
    $this->password  = $password;
    $this->base      = $base;
    $this->dbh       = null;
    $this->error     = null;
    $this->sentencia = "";

    $cadena_conexion_psql = $this->manejador . ':host=' .$this->host 
                          .";port=5432"
                          .";dbname=".$this->base
                          .";user=".$this->usuario
                          .";password=".$this->password;
    // $cadena_conexion_mysql = $this->manejador . ':host=' .
    //                        $this->host .
    //                        ';dbname=' . $this->base;

    $opciones = array(
		      PDO::ATTR_PERSISTENT    => true,
		      PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
		      );

    try{
        // Constructor del objeto PDO PSQL
        $this->dbh = new PDO($cadena_conexion_psql);
        /* Constructor del objeto PDO MSQL
           $this->dbh = new PDO($cadena_conexion_mysql,
           $this->usuario,
           $this->password,
           $opciones);
        */
    }catch(PDOException $e){
      $this->error = $e->getMessage();
      // echo $this->error
    }
  }

  public function __clone() {}

  public function query($sentencia) {
    $this->sentencia = $this->dbh->prepare($sentencia);
  }

  public function bind($param, $valor, $tipo = null){
    if (is_null($tipo)){
      switch (true){
      case is_int($valor):
	$tipo = PDO::PARAM_INT;
	break;
      case is_bool($valor):
	$tipo = PDO::PARAM_BOOL;
	break;
      case is_null($valor):
	$tipo = PDO::PARAM_NULL;
	break;
      default:
	$tipo = PDO::PARAM_STR;
                
      }
    }
    $this->sentencia->bindValue($param, $valor, $tipo);
  }

  public function execute() {
    return $this->sentencia->execute();
  }

  // Si deseamos otro tipo de resultado cambiamos la forma
  // en que obtenemos todos los resultados
  public function resultado() {
    $this->execute();
    return $this->sentencia->fetchAll(PDO::FETCH_ASSOC);
  }
  }

/////////////////////////////////////////////////////////////////////////
// Ejemplo de uso:                                                              //
// $sentencia = "SELECT * FROM tabla WHERE algo = :algo";                       //
// $base = BaseDatos::getInstancia("pgsql","localhost","usuario","pass","base"); //
// $base->query($sentencia);                                                    //
// $base->bind(":algo", "5");                                                   //
// $base->execute();                                                            //
// echo $base->resultado();                                                     //
/////////////////////////////////////////////////////////////////////////

