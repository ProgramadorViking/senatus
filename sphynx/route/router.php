<?php
  require_once 'route.php';

  class hermes {
    private $routes;

    function __construct() {
      $routes = new Route(true);
      $this->routes = $routes->getRoutes();
    }

    //FILTRO DE METODOS
    //GET ->
    public function get($var) {
      echo $var;
    }
    //POST ->

    //PUT ->

    //DELETE ->

  }
?>
