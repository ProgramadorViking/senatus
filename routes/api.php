<?php
  require_once 'sphynx/route/router.php';
  require_once 'sphynx/core/cargador.php';

  $app = new hermes();

  $app->post('/user/save','UserController@save');
  $app->post('/user/login','UserController@login');
  $app->post('/user/isLogin','UserController@isLogin');

  if(middleware::auth()) {
    $app->post('/user/dani','UserController@test');
  }
?>
