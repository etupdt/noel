<?php

require_once 'models/entities/User.php';

class Elf extends User {

  #[Column]
  protected $name;

  public function __construct() {

    $this->id = 0;

  }

  public function getId()  : string {
    return $this->id;
  }

  public function getName()  : string{
    return $this->name;
  }

  public function setName(string  $name) {
    $this->name = $name;
  }

}
