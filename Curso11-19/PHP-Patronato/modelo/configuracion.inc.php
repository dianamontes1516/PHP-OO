<?php 
/********************************************************************
 ********************************************************************
 * Configuración de la aplicación del Sistema de Personal de Base
 ********************************************************************
 *********************************************************************/
/**
 * Variable para definir el ambiente
 * @var string - {DESARROLLO | PRODUCCIÓN}
 */
define('AMBIENTE', 'DESARROLLO');

if (AMBIENTE === 'DESARROLLO') {
  define('DB_HOST', 'localhost');
  define('DB_PORT', '5432');
  define('DB_NAME', 'patronato');
  define('DB_USER', 'personal');
  define('DB_PASSWORD', 'personal');
 } elseif (AMBIENTE === 'PRODUCCIÓN') {
   } else {
  die();
 }
