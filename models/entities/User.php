<?php

require_once 'models/attributs/Entity.php';

class User {

  #[Column]
  protected $id;
  #[Column]
  protected $email;
  #[Column]
  protected $password;
  #[Column]
  protected $roles;

  public function __construct(int $id = null) {

    $this->id = $id;

  }

  public function getId()  : string {
    return $this->id;
  }

  public function getEmail()  : string{
    return $this->email;
  }

  public function getPassword()  : string {
    return $this->password;
  }

  public function getRoles()  : string {
    return $this->roles;
  }

  public function setEmail(string  $email) {
    $this->email = $email;
  }

  public function setPassword(string  $password) {
    $this->password = $password;
  }

  public function setRoles(string  $roles) {
    $this->roles = $roles;
  }

}
