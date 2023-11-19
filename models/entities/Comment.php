<?php

require_once 'Entity.php';

class Comment extends Entity {

  #[Column]
  protected $id;
  #[Column]
  protected $comment;
  #[Column]
  protected $validate;
  #[Column]
  protected $pseudo;

  // #[OneToMany(foreignKey: 'id_visitor')]
  // protected ?Visitor $visitor;

  public function __construct() {

    $this->id = 0;

  }

  public function getId()  : string {
      return $this->id;
  }

  public function getComment()  : string{
      return $this->comment;
  }

  public function getValidate()  : string {
    return $this->validate;
  }

  public function getPseudo()  : string {
    return $this->pseudo;
  }

  // public function getVisitor() { 
  //   return $this->visitor;
  // }  

  public function setComment(string  $comment) {
        $this->comment = $comment;
  }

  public function setValidate(string  $validate) {
    $this->validate = $validate;
  }

  public function setPseudo(string  $pseudo) {
    $this->pseudo = $pseudo;
  }

  // public function setVisitor(Visitor $visitor) {
  //   $this->visitor = $visitor;
  // }

}
