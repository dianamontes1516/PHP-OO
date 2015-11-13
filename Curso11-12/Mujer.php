<?php

class Mujer extends Persona{

      public function __construct($nombre,
                                  $apellido_paterno,
                                  $apellido_materno,
                                  $correo){
      	     parent::__construct($nombre,
                                 $apellido_paterno,
                                 $apellido_materno,
                                 $correo);

      }

      public function habla(){
      	     return "Soy bonita</br>";
      }
}