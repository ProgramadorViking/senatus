<?php
  class Entidad {
    private $PDO;
    private $table;

    public function __construct($table) {
      $this->table = $table;
      require_once 'core.php';
      $bd = new Core();
      $this->PDO = $bd->connect();
    }

    public function getPDO() {
      return $this->PDO;
    }

    public function errorInfo() {
      return $this->PDO->errorInfo();
    }

    public function getAll() {
            $pdo = $this->PDO;
            $result=$pdo->query("SELECT * FROM ".$this->table);

            if($result) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $resultSet[]=$row;
                }
                return $resultSet;
            } else {
                return "No existe";
            }
        }

        public function findById($id) {
            $query=$this->PDO->query("SELECT * FROM ".$this->table." WHERE id=".$id);
            if($row=$query->fetch(PDO::FETCH_ASSOC)) {
                $resultSet=$row;
            }
            return $resultSet;
        }

        public function findBy($column,$value) {
            $cslt= "SELECT * FROM ".$this->table." WHERE ".$column." = '".$value."'";
            $pdo=$this->PDO;
            $query=$pdo->query($cslt);
            if($query) {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $resultSet[]=$row;
                }
                return $resultSet;
            } else {
                return "No existe";
            }
        }

        public function delete($id) {
            $cslt="DELETE FROM ".$this->table." WHERE id=".$id;
            $pdo=$this->PDO;
            $query=$pdo->query($cslt);
            return $query;
        }
  }
?>
