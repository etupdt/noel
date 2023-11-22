<?php

require_once 'Entity.php';

class Command extends Entity {

  #[Column]
  protected $id;
  #[Column]
  protected $quantity;

  #[OneToMany(foreignKey: 'id_visitor')]
  protected Visitor $visitor;

  #[OneToMany(foreignKey: 'id_gift')]
  protected Gift $gift;

  public function __construct() {

    $this->id = 0;

  }

  public function getId()  : string {
      return $this->id;
  }

  public function getQuantity()  : string{
    return $this->quantity;
}

public function getVisitor()  : Visitor{
    return $this->visitor;
}

public function getGift()  : Gift{
    return $this->gift;
}

public function setQuantity(string $quantity) {
        $this->quantity = $quantity;
  }

  public function setVisitor(Visitor $visitor) {
    $this->visitor = $visitor;
  }  

  public function setGift(Gift $gift) {
    $this->gift = $gift;  
  }    

}
