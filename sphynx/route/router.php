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
    public function post($url,$process) {
      $data = json_decode(file_get_contents('php://input'));
      if($_SERVER['REQUEST_METHOD']=='POST') {
        $route = explode('/',$url);
        for($i=0;$i<count($route);$i++) {
          if($route[$i]=='{id}') {
            $id=$this->routes[$i];
            $can=$this->routes;
            $can[$i]='{id}';
            if($route==$can) {
              $function = explode('@',$process);
              $request = array('id'=>$id);
              call_user_func($function,$data);
            }
            break;
          }
        }
        if($route == $this->routes) {
          $function = explode('@',$process);
          $request = array();
          foreach($_POST as $key=>$value) {
            $ent = array($key=>$value);
            $request += $ent;
          }
          call_user_func($function,$data);
        }
      }
    }
    //PUT ->

    //DELETE ->

  }
?>
