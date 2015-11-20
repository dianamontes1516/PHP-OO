<?php
require_once('Validator.php');
require_once('../modelo/Usuario.php');
class UsuarioControlador
{

	/**
	 * MÃ©todo para dar de alta un nuevo usuario en el sistema
	 */
	 
	public function registrar($datos) {
        $validator = new Validator;
	$validation = $validator->validate($datos,
                                       ['idPersona'=>['numero','required']]);
	if($validation){
	  $message =implode('<br>',$validation);
	  die(require_once('../vista/registro.php'));
	}			
	$id_persona = $datos['idPersona'];
        $nombre = $datos['nombre']; 
        $aP = $datos['apellido_paterno'];
        $aM = $datos['apellido_materno'];
        $mail = $datos['correo'];
        $user = $datos['usuario'];
        $pass1 = $datos['password1'];
        $pass2 = $datos['password2'];        
        $rol = $datos['rol'];
        $date = date("Y-m-d");

        if($pass2 != $pass1) {
            $message ="Las contraseñas no coinciden";
            die(require_once('../vista/registro.php'));
        }
        
        $persona = new Persona($id_persona,$nombre, $aP,$aM,$mail);
        if($persona->existsPerson() === false){
            $persona->savePerson();
        }
        $usuario = new Usuario($user,$pass1,$date,$id_persona,$rol,$nombre,$aP,$aM,$mail);
        $usuario->registrar();

        die(require_once('../vista/registroExitoso.php'));

               
		// en caso de error la vista mantiene los datos introducidos
		
    }    

    public function inicioSesion($datos) {
        $user = $datos['usuario'];
        $pass = $datos['password'];

        $usuario = new Usuario($user,$pass);
        if($usuario->existsUser() === false) {
            $message ="Usuario no registrado";
            die(require_once('../vista/iniciasesion.php'));
        }
        
        if($usuario->iniciaSesion()) {
            die(require_once('../vista/bienvienido.php'));            
        }
        
        $message ="Credenciales incorrectas";
        die(require_once('../vista/iniciasesion.php'));
    }    

}


if($_POST) {
    $controlador = new UsuarioControlador();

    switch($_POST['accion']){

      case 'registro':
        $controlador->registrar($_POST);
        break;
      case 'login':
        $controlador->inicioSesion($_POST);
        break;
      default:
        break;
    }
}

