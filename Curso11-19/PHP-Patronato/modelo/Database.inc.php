<?php 
require_once 'configuracion.inc.php';
require_once 'Persona.php';

/**
* Clase Database para la conexión a la base de datos
*/
class Conexion {

	private $connection;

	public function __construct() {
		$dsn = "pgsql:host=".DB_HOST
             .";port=".DB_PORT
             .";dbname=".DB_NAME
             .";user=".DB_USER
             .";password=".DB_PASSWORD;
 
        try{
            // creaxte a PostgreSQL database connection
            $this->connection = new PDO($dsn);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        }catch (PDOException $e){
            //echo $e->getMessage();
        }
    }

    public function getOne($query,$values,$objeto){
        //echo $query;
        $prepara = $this->connection->prepare($query);
        $prepara->setFetchMode(PDO::FETCH_INTO,$objeto);
        $prepara->execute($values);
        $prepara->fetch();
    }

    public function getExistance($query,$values){
        //echo $query;
        $prepara = $this->connection->prepare($query);
        $prepara->setFetchMode(PDO::FETCH_ASSOC);
        $prepara->execute($values);
        return $prepara->rowCount()>0;
    }
    
    public function getALL($query,$values,$clase){
        //echo $query;
        $prepara = $this->connection->prepare($query);
        $prepara->setFetchMode(PDO::FETCH_CLASS,$clase);
        $prepara->execute($values);
        return $prepara->fetchAll();        
    }
    
    public function put($query,$values){
        //echo $query;
        $prepara = $this->connection->prepare($query);
        $prepara->execute($values);        
    }
    
}

// $con = new Conexion;
// $con->insert('insert into persona values (?,?,?,?,?)',['23','Anaid','Vallarta','Cossio','dfs@fgkfdj.com']);

class Modelo extends Conexion{

    private $tabla;
    private $primary_key;
    private $clase;

    function __construct($tabla, $clase,$pk) {
        parent::__construct();
        $this->tabla = $tabla;
        $this->clase=$clase;
        $this->primary_key=$pk;        
    }

    public function setTabla($tabla){
        $this->tabla=$tabla;
    }

    public function setClase($clase){
        $this->clase=$clase;
    }
    
    public function setPK($pk){
        $this->primary_key=$pk;
    }


    public function execute() {
        return $this->sentencia->execute();
    }
    

    
    /**
     * Método para obtener todos los ejemplares del modelo
	 * @return array Arreglo con los modelos
	 */
	public function all() {
        $query = 'SELECT * from '.$this->tabla;
        $clase = $this->clase;
        return $this->getALL($query,null,$clase);
    }

    /**
     * Método para saber si un elemento con id $id
     * esta en la base
	 * @return array Arreglo con los modelos
	 */
	protected function exists($id) {
        $query = 'SELECT * from '.$this->tabla." WHERE ".$this->primary_key." = ? ";
        $values = [$id];
        $clase = $this->clase;
        return $this->getExistance($query,$values);
    }

    /**
     * Método para saber si un elemento con id $id
     * esta en la base
	 * @return array Arreglo con los modelos
	 */
	public function getById($id,$ob) {
        $query = 'SELECT * from '.$this->tabla." WHERE ".$this->primary_key." = ?";
        $values = [$id];
        $this->getOne($query,$values,$ob);
    }

    /**
     * Método encuentra
     * esta en la base
	 * @return array Arreglo con los modelos
	 */
	public function find($filtros) {
        $query = 'SELECT * from '.$this->tabla." WHERE ";
        $valores=[];
        foreach($filtros as $clave => $valor){
            $valores[]=$clave." = ?";
        }
        $query.=implode(' and ',$valores );
        $resultado = $this->fetchALL($query,array_values($filtros), $this->clase);
    }

    /**
	 * Método para insertar un modelo en la base de datos
	 * @param  array $values Un arreglo de llaves y valores del modelo
	 * @return boolean         True en caso exitoso, false e.o.c.
	 */
	public function insert($values) {
        $llaves = array_keys($values);
        
        $query = "INSERT INTO ".$this->tabla." (";
        $query.= implode(',',$llaves);
        $query.= ") VALUES \n (?";
        $query.= str_repeat(',?',sizeof($values)-1);
        $query.=")";
        ////echo $query;
        $this->put($query,array_values($values));
	}



}

// $mod = new Modelo('persona','Persona','id');
// print_r($mod->all());
// $per = new Persona;
// $mod->getById(3,$per);
// var_dump($per);

?>
