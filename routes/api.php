<?php
  require_once 'sphynx/route/router.php';
  require_once 'sphynx/core/cargador.php';
  require_once 'sphynx/core/functions.php';

  $app = new hermes();

  $app->post('/user/save','UserController@save');
  $app->post('/user/login','UserController@login');
  $app->post('/user/isLogin','UserController@isLogin');

  if(middleware::auth() && middleware::hasPermission('Read','users')) {
    $app->post('/user/dani','UserController@index');
  } else {
    error(401,'Acesso no autorizado');
  }
?>
