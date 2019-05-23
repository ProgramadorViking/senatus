<?php

    //CARGA ESTATICA
    require_once 'sphynx/core/controller.php';
    require_once 'sphynx/bbdd/entidad.php';
    /*require_once 'sphynx/core/Auth/middleware.php';*/

    //CARGA DINAMICA
    //Cargar todos los controladores
    foreach(glob("app/Controllers/*.php") as $file) {
        require_once $file;
    }
    //carga todos los modelos
    foreach(glob("app/*.php") as $models) {
        require_once $models;
    }

    foreach(glob('sphynx/cli/*.php') as $cli) {
        require_once $cli;
    }

    use Symfony\Component\Yaml\Yaml;

    //Arranca el menu
    function init() { menu_principal(); }
?>
