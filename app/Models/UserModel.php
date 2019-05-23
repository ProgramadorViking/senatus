<?php
  class UserModel extends Model {
    private $table;

    public function __construct() {
      $this->table = 'users';
      parent::__construct($this->table);
    }
  }
?>
