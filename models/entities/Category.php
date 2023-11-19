<?php

require_once 'Entity.php';

class Category extends Entity {

  #[Column]
  protected $id;
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

  public function setName(string $name) {
        $this->name = $name;
  }

}
