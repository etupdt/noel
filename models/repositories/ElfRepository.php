<?php

require_once 'models/repositories/ServiceEntityRepository.php';

class ElfRepository extends ServiceEntityRepository {

  public function __construct($maxDepth) {

    $this->maxDepth = $maxDepth;

    parent::__construct(Elf::class);

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

  public function insert(Elf $elf) { 

    $id_user = $this->insertDatabase('user', [
      'email' => $elf->getEmail(),
      'password' => '',
      'roles' => '["ROLE_ELF"]',
    ]);

    $id_elf = $this->insertDatabase('elf', [
      'id_user' => $id_user,
      'id' => $id_user,
      'name' => $elf->getName(),
    ]);

  }  

  public function update(Elf $elf) { 

    $this->updateDatabase('user', $elf->getId(), [
      'email' => $elf->getEmail(),
    ]);

    $this->updateDatabase('elf', $elf->getId(), [
      'name' => $elf->getName(),
    ]);

  }  

  public function delete(Elf $elf) { 

    $this->deleteDatabase('elf', [
      'id' => $elf->getId()
    ]);
    
    $this->deleteDatabase('user', [
      'id' => $elf->getId()
    ]);
    
  }  

}
