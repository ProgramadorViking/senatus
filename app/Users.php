<?php
  class User extends Entidad {

    private $id, $password, $worker_id, $name, $date1, $active, $role_id, $token;

    public function __construct() {
      parent::__construct('users');
    }

    //Getters and setters
    public function getId() {
      return $this->id;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function getPassword() {
      return $this->password;
    }

    public function setPassword($pass) {
      $this->password = password_hash($pass, PASSWORD_DEFAULT);
    }

    public function getWorkerId() {
      return $this->worker_id;
    }

    public function setWorkerId($id) {
      $this->worker_id = $id;
    }

    public function getName() {
      return $this->name;
    }

    public function setName($name) {
      $this->name = $name;
    }

    public function getDate() {
      return $this->date1;
    }

    public function setDate($date) {
      $this->date1 = $date;
    }

    public function getActive() {
      return $this->active;
    }

    public function setActive($active) {
      $this->active = $active;
    }

    public function getRoleId() {
      return $this->role_id;
    }

    public function setRoleId($id) {
      $this->role_id = $id;
    }

    public function getToken() {
      return $this->token;
    }

    public function setToken($token) {
      $this->token = $token;
    }

    //Funciones extras
    public function save() {
      $query = "INSERT INTO users ('campos')
        VALUES(NULL,
          valores)";
      $db = parent::getPDO();
      $save=$db->query($query);
      return $save;
    }

    public function login($id) {
      $query = "UPDATE users SET
        token ='".$this->token."'
        WHERE id ='".$id."';";
      $db = parent::getPDO();
      $save=$db->query($query);
      return $save;
    }
  }
?>
