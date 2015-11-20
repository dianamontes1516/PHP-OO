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
	  <td><input type="hidden" name="accion" value="login" ></td>
 	<tr> 
	  <td>Nombre usuario</td>
	  <td><input type="text" name="usuario" value='<?=$datos['id']?>' required>*</td>
	</tr>
 	<tr> 
	  <td>Contraseña:</td>
	  <td><input type="password" name="password" required>*</td>
	</tr>
	<tr>
	  <td></td>
	  <td><input type="submit" value="Aceptar" /></td>
	</tr>

    </form>
  </body>
</html>
