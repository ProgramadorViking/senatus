<?php
  require_once '../bbdd/entidad.php';

  class Model extends Entidad {
    private $table;
    private $PDO;

    public function __construct($table) {
      $this->table=(string) $table;
      parent::__construct($table);
    }

    public function execute($query) {
      $query = $this->PDO->query($query);
      if ($query==true) {
                if($query->num_rows>1) {
                    while($row=$query->fetch_object()) {
                        $resultSet[]=$row;
                    }
                } elseif ($query->num_rows==1) {
                    if ($row=$query->fetch_object()) {
                        $resultSet=$row;
                    }
                } else {
                    $resultSet=true;
                }
            } else {
                $resultSet=false;
            }
            return $resultSet;
    }
  }
?>
