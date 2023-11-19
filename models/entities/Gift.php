<?php

require_once 'Entity.php';

class Gift extends Entity {

  #[Column]
  protected $id;
  #[Column]
  protected $name;
  #[Column]
  protected $age;
  #[Column]
  protected $description;
  #[Column]
  protected $validate;
  #[Column]
  protected $imageName;

  #[OneToMany(foreignKey: 'id_category')]
  protected ?Category $category;

  #[ManyToMany(classes: ['Visitor', 'Gift'])]
  protected $visitors;

  public function __construct() {

    $this->id = 0;

    $this->category = null;

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
  
  public function getDescription()  : string{
    return $this->description;
  }

  public function getValidate()  : string {
    return $this->validate;
  }

  public function getImageName()  : string {
    return $this->imageName;
  }

  public function getCategory() { 
    return $this->category;
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

  public function setDescription(string  $description) {
    $this->description = $description;
  }

  public function setValidate(string  $validate) {
    $this->validate = $validate;
  }

  public function setImageName(string  $imageName) {
    $this->imageName = $imageName;
  }

  public function setCategory(Category $category) {
    $this->category = $category;
  }  

  public function setVisitors(array  $visitors) {
    $this->visitors = $visitors;
  }  

}
