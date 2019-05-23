<?php
	use Symfony\Component\Yaml\Yaml;

    function yamler($adapter,$host,$port,$name,$user,$pass) {
	   
	   $yamler['paths']['migrations']='%%PHINX_CONFIG_DIR%%/database/migrations';
	   $yamler['paths']['seeds']='%%PHINX_CONFIG_DIR%%/database/seeds';
	   $yamler['environments']['default_migration_table']='phinxlog';
	   $yamler['environments']['default_database']='development';
	   $yamler['environments']['development']['adapter']=$adapter;
	   $yamler['environments']['development']['host']=$host;
	   $yamler['environments']['development']['name']=$name;
	   $yamerl['environments']['development']['user']=$user;
	   $yamler['environments']['development']['pass']=$pass;
	   $yamler['environments']['development']['port']=$port;
	   $yamler['environments']['development']['charset']='utf8';
	   $yamler['version_order']='creation';
	   
		file_put_contents(
		    'phinx.yml',
		    Yaml::dump($yamler)
		);
    }

?>