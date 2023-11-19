<?php

class Gift {

  #[Column]
  protected $id;
  #[Column]
  protected $name;
  #[Column]
  protected $age;
  #[Column]
  protected $description;

  #[ManyToMany(classes: ['Visitor', 'Gift'])]
  protected $visitors;

  public function __construct() {

    $this->id = 0;

  }

  public function getId()  : string {
      return $this->id;
  }

  public function getName()  : string{
    return $this->name;
  }
    
  public function getAge()  : string{
      return $this->age;
  }
    
  public function getVisitors() { 
    return $this->visitors;
  }  
  
  public function setName(string  $name) {
    $this->name = $name;
  }

  public function setAge(string  $age) {
    $this->age = $age;
  }

  public function setVisitors(array  $visitors) {
    $this->visitors = $visitors;
  }

}
