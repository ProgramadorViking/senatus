<?php
  require_once 'sphynx/bbdd/entidad.php';
  require_once 'sphynx/core/controller.php';
  require_once 'sphynx/auth/middleware.php';

//Carga dinamica de ficheros: "no-nucleo"
  foreach(glob('app/Controllers/*.php') as $file) {
    require_once $file;
  }
  foreach(glob('app/*.php') as $models) {
    require_once $models;
  }
?>
