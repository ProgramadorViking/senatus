<?php
  require_once 'sphynx/bbdd/entidad.php';
  require_once 'sphynx/core/controller.php';
  foreach(glob('app/Controllers/*.php') as $file) {
    require_once $file;
  }
  foreach(glob('app/*.php') as $models) {
    require_once $models;
  }
?>
