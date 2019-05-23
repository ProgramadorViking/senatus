<?php
  class Controlador {

    public function __construct() {
      require_once '../bbdd/entidad.php';
      require_once 'model.php';
      foreach(glob('app/Models/*.php') as $file) {
        require_once $file;
      }
    }
  }
?>
