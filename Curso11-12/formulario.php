<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
 </head>
 <body>
  <?php
    require("./Persona.php");
    require("./Mujer.php");
    require("./Hombre.php");     

    $personita = new Persona("a","b","c","abc@ciencias.unam.mx");
  
    $ana  = new Mujer("Ana", "López", "López", "ana@ciencias.unam.mx");
    $pepe = new Hombre("Pepe", "López", "López","pepe@ciencias.unam.mx");

    echo "Personita: " . $personita->saludaA("Juan");
    echo "Ana: " . $ana->saludaA("Juan");
    echo "Pepe: " . $pepe->saludaA("Juan");  

    echo "Ana dice: <b>" . $ana->habla() . "</b>";
    echo "Pepe dice: <b>" . $pepe->habla() . "</b>";

    if ($ana instanceof Persona)
      echo "Ana es una persona</br>";
    if ($pepe instanceof Persona)
      echo "Pepe es una persona</br>";

echo "Creaste: <b>" . Persona::getPoblacion() . "</b> Personas <br>";
  ?>
 </body>
</html>
