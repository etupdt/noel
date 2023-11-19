<?php

require_once 'models/repositories/ServiceEntityRepository.php';
require_once 'models/entities/Visitor.php';

class GiftRepository extends ServiceEntityRepository {

  public function __construct($maxDepth) {

    $this->maxDepth = $maxDepth;

    parent::__construct(Gift::class);

  }

  public function find($id) {

    return parent::find($id);

  }

  public function findAll() { 

    return parent::findAll();

  }  

  public function insert(Gift $gift) { 

    $id_gift = $this->insertDatabase('gift', [
      'name' => $gift->getName(),
      'age' => $gift->getAge(),
      'description' => $gift->getDescription(),
      'validate' => $gift->getValidate() ? 1 : 0,
      'imageName' => $gift->getImageName(),
      'id_category' => $gift->getCategory()->getId()
    ]);

  }  

  public function update(Gift $gift) { 

    $this->updateDatabase('gift', $gift->getId(), [
      'name' => $gift->getName(),
      'age' => $gift->getAge(),
      'description' => $gift->getDescription(),
      'validate' => $gift->getValidate() ? 1 : 0,
      'imageName' => $gift->getImageName(),
      'id_category' => $gift->getCategory()->getId()
    ]);

  }  

  public function delete(Gift $gift) { 

    $this->deleteDatabase('gift', [
      'id' => $gift->getId()
    ]);
    
  }  

}
