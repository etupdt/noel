<?php

require_once 'models/repositories/ServiceEntityRepository.php';

class VisitorRepository extends ServiceEntityRepository {

  public function __construct($maxDepth) {

    $this->maxDepth = $maxDepth;

    parent::__construct(Visitor::class);

  }

  public function find($id) {

    return parent::find($id);

  }

  public function findAll() { 

    return $this->findAllDatabase($this->datas);

  }  

  public function findBy($wheres) { 

    return $this->findByDatabase($this->datas, $wheres);

  }  

  public function insert(Visitor $visitor) { 

    $id_user = $this->insertDatabase('user', [
      'email' => $visitor->getEmail(),
      'password' => '',
      'roles' => '["ROLE_VISITOR"]',
    ]);

    $id_visitor = $this->insertDatabase('visitor', [
      'id_user' => $id_user,
      'id' => $id_user,
      'firstName' => $visitor->getFirstName(),
      'lastName' => $visitor->getLastName(),
      'pseudo' => $visitor->getPseudo(),
      'age' => $visitor->getAge(),
      'address' => $visitor->getAddress(),
      'letter' => $visitor->getLetter(),
    ]);

  }  

  public function update(Visitor $visitor) { 

    $this->updateDatabase('user', $visitor->getId(), [
      'email' => $visitor->getEmail(),
    ]);

    $this->updateDatabase('visitor', $visitor->getId(), [
      'firstName' => $visitor->getFirstName(),
      'lastName' => $visitor->getLastName(),
      'pseudo' => $visitor->getPseudo(),
      'age' => $visitor->getAge(),
      'address' => $visitor->getAddress(),
      'letter' => $visitor->getLetter(),
    ]);

  }  

  public function delete(Visitor $visitor) { 

    $this->deleteDatabase('visitor', [
      'id' => $visitor->getId()
    ]);
    
    $this->deleteDatabase('user', [
      'id' => $visitor->getId()
    ]);
    
  }  

}
