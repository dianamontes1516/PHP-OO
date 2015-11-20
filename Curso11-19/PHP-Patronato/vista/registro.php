<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Registro</title>
  </head>
  <body>
    <h1>Registro</h1>
    <h4><?=$message?></h4>

    <form action="../controlador/UsuarioControlador.php" method="POST">
      <table>
	  <td><input type="hidden" name="accion" value="registro" ></td>
	<tr>
	  <td>Id persona </td>
	  <td><input type="text" name="idPersona" value='<?=$datos['idPersona']?>' required>*</td>
	</tr>
	<tr>
	  <td>Nombre</td>
	  <td><input type="text" name="nombre" value='<?=$datos['nombre']?>' required>*</td>
	</tr>
	<tr>
	  <td>Apellido Paterno</td>
	  <td><input type="text" name="apellido_paterno" value='<?=$datos['apellido_paterno']?>' required>*</td>
	</tr>
 	<tr> 
	  <td>Apellido Materno</td>
	  <td><input type="text" name="apellido_materno" value='<?=$datos['apellido_materno']?>' required>*</td>
	</tr>
 	<tr> 
	  <td>Correo</td>
	  <td><input type="text" name="correo" value='<?=$datos['correo']?>' required>*</td>
	</tr>
	<tr>
	  <td>Rol</td>
	  <td>
	    <select name="rol">
	      <option value="Cliente">Cliente</option>
	      <option value="Administrador">Administrador</option>
	    </select>
	  </td>
	</tr>
 	<tr> 
	  <td>Nombre usuario</td>
	  <td><input type="text" name="usuario" value='<?=$datos['id']?>' required>*</td>
	</tr>
 	<tr> 
	  <td>Contraseña:</td>
	  <td><input type="password" name="password1" required>*</td>
	</tr>
 	<tr> 
	  <td>Verificacion de Contraseña:</td>
	  <td><input type="password" name="password2" required>*</td>
	</tr>
	<tr>
	  <td></td>
	  <td><input type="submit" value="Aceptar" /></td>
	</tr>

    </form>
  </body>
</html>
