<?php

    function create_file($file, $driver, $host, $port, $schema, $username, $password) {

        $contenido = '[database]
driver = '.$driver.'
host = '.$host.'
port = '.$port.'
schema = '.$schema.'
username = '.$username.'
password = '.$password;
        if($archivo = fopen($file, "a"))
        {
            $result = fwrite($archivo, $contenido);
            fclose($archivo);
            return $result;
        }
    }

    function create_migration($migration) {

        $command = 'php vendor/bin/phinx create '.$migration;
        shell_exec($command);
    }

    function run_migrations() {
        $command = 'php vendor/bin/phinx migrate -e development';
        shell_exec($command);

    }

    function run_rollback() {
        $command = 'php vendor/bin/phinx rollback -e development';
        shell_exec($command);
    }

    function create_seeder($seed) {
        $command = 'php vendor/bin/phinx seed:create'.$seed;
        shell_exec($command);
    }

    function clean() {
      if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        system ('cls');
      } else {
        system ('clear');
      }
    }

?>
