<?php

require_once 'models/repositories/ServiceEntityRepository.php';
require_once 'models/entities/Command.php';

class CommandRepository extends ServiceEntityRepository {

  public function __construct($maxDepth) {

    $this->maxDepth = $maxDepth;

    parent::__construct(Command::class);

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

  public function insert(Command $command) { 

    $id_command = $this->insertDatabase('command', [
      'quantity' => $command->getQuantity(),
      'id_visitor' => $command->getVisitor()->getId(),
      'id_gift' => $command->getGift()->getId()
    ]);

  }  

  public function update(Command $command) { 

    $this->updateDatabase('command', $command->getId(), [
      'quantity' => $command->getQuantity(),
      'id_visitor' => $command->getVisitor()->getId(),
      'id_gift' => $command->getGift()->getId()
    ]);

  }  

  public function delete(Command $command) { 

    $this->deleteDatabase('command', [
      'id' => $command->getId()
    ]);
    
  }  

}
