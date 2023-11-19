<?php

require_once 'models/entities/User.php';

class Visitor extends User {

  #[Column]
  protected $firstName;
  #[Column]
  protected $lastName;
  #[Column]
  protected $age;
  #[Column]
  protected $address;
  #[Column]
  protected $letter;
        
  #[ManyToMany(classes: ['Visitor', 'Gift'])]
  protected $gifts;

  public function __construct() {

    $this->id = 0;

  }

  public function getId()  : string {
    return $this->id;
  }

  public function getFirstName()  : string{
    return $this->firstName;
  }

  public function getLastName()  : string{
    return $this->lastName;
  }

  public function getAge()  : string{
    return $this->age;
  }

  public function getAddress()  : string{
    return $this->address;
  }

  public function getLetter()  : string{
    return $this->letter;
  }

  public function getGifts()  : string{
    return $this->gifts;
  }

  public function setFirstName(string  $firstName) {
    $this->firstName = $firstName;
  }

  public function setLastName(string  $lastName) {
    $this->lastName = $lastName;
  }

  public function setAge(string  $age) {
    $this->age = $age;
  }

  public function setaddress(string  $address) {
    $this->address = $address;
  }

  public function setLetter(string  $letter) {
    $this->letter = $letter;
  }

  public function setGifts(string  $gifts) {
    $this->gifts = $gifts;
  }

}
