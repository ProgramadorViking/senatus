<?php
  class User extends Entidad {

    private $user_id, $password, $worker_id, $name, $date1, $active, $role_id, $token;

    public function __construct() {
      parent::__construct('users');
    }

    //Getters and setters

  }
?>
