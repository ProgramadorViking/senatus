<?php

    // M E N U    P R I N C I P A L
    function menu_principal() {

      $sys = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');

        do {
            clean();
            print_r("Bienvenido a la instalación de SENATUS/sphynx\n");
            print_r("-------------------------------------\n");
            print_r("\nElija una opción del menú:\n");
            print_r("1. Creación/Modificación de database.ini.\n");
            print_r("2. Gestión base de datos.\n");
            print_r("0. Salir");
            print_r("\n-----------------------------------------------------------\n");
            $v = readline("Opción: ");
            switch($v) {
                case 1:
                    config();
                    break;
                case 2:
                    bbdd();
                    break;
                case 5:
                    print_r("\nHasta la proxima!\n");
                    exit(0);
                    break;
            }
        } while($v!=0);
        print_r("\nHasta la proxima!\n");

    }

    // P R I M E R    N I V E L
    function config() {
        $file = getcwd().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'database.ini';
        //echo getcwd();
        do {
            clean();
            print_r("SPHYNX - Creación/Modificación de database.ini\n");
            print_r("----------------------------------------------\n");
            if(file_exists($file)) {
                do {
                    $r = readline("El fichero existe, quiere modificarlo? (S/N)\n");
                    if(strtoupper($r)=="S") {
                        unlink($file) or die("No se puede eliminar el fichero");
                        unlink('phinx.yml');
                        createFile($file);
                    }
                } while (strtoupper($r)!="N");
            } else {
                $r = readline("El fichero no existe, desea crearlo? (S/N)\n");
                if(strtoupper($r)=="S") {
                    createFile($file);
                }
            }
        } while($v!=0);
    }

    function bbdd() {
        do {
            //system('clear');
            print_r("SPHYNX - Gestión de la base de datos\n");
            print_r("------------------------------------\n");
            print_r("1. Crear migración\n");
            print_r("2. Ejecutar migraciones\n");
            print_r("3. Rollback\n");
            print_r("4. Crear un seeder\n");
            print_r("5. Ejecutar seeds\n");

            print_r("0. Volver");
            print_r("\n-----------------------------------------------------------\n");
            $v = readline("Opcion: ");
            switch($v) {
                case 1:
                    do {
                        $migration=readline("Nombre de la migración (CamelCase):\n");
                    } while($migration=="");
                    create_migration($migration);
                    break;
                case 2:
                    $r = readline("Estas seguro en ejecutar las migraciones? (S/N)\n");
                    if(strtoupper($r)=="S") {
                        run_migrations();
                    }
                    break;
                case 3:
                    $r = readline("Estas seguro en ejecutar el rollback?");
                    if(strtoupper($r)=="S") {
                        run_rollback();
                    }
                    break;
                case 4:
                    do {
                        $seed=readline("Nombre de la seed (CamelCase):\n");
                    } while($seed=="");
                    create_seeder($seed);
                    break;
            }
        } while($v!=0);
    }

    // S E G U N D O    N I V E L
    function createFile($file) {
        do {
            $driver=readline("Motor de SQL (mysql):\n");
        } while($driver!='mysql');
        do {
            $host=readline("Dirección del servidor:\n");
        } while($host=="");
        do {
            $port=readline("Puerto de la BBDD:\n");
        } while(!is_numeric($port));
        do {
        $schema=readline("Nombre de la base de datos:\n");
        } while($schema=="");
        do {
        $username=readline("Nombre de usuario de la BBDD:\n");
        } while($username=="");
        do {
        $password=readline("Contraseña de la BBDD:\n");
        } while($password=="");
        create_file($file,$driver,$host,$port,$schema,$username,$password);
        yamler($driver,$host,$port,$schema,$username,$password);
    }

?>
