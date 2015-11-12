<!DOCTYPE html>
<html>
  <body>

    <?php
       require("Persona.php");
       $persona = new Persona();
       var_dump($persona);
       echo $persona->saludaA("Juan");
    ?>

  </body>
</html>
