<?php
  class Core {
    const BBDD = '/config/database.ini';
    private $PDO;

    public function __construct() {
      if(!$settings = parse_ini_file($_SERVER['DOCUMENT_ROOT'].self::BBDD, TRUE)) throw new exception('Unable to open '.self::BBDD.'.');
      $dsn = $settings['database']['driver'].':host='.$settings['database']['host'].((!empty($settings['database']['port']))?(';port='.$settings['database']['port']):'').';dbname='.$settings['database']['schema'];
      try {
          $this->PDO = new PDO($dsn,$settings['database']['username'],$settings['database']['password']);
      } catch (PDOException $e) {
          echo $e->getMessage();
      }
    }

    public function connect() {
      return $this->PDO;
    }
  }
?>
