<?php

require_once 'models/repositories/ServiceEntityRepository.php';

class UserRepository extends ServiceEntityRepository {

  public function __construct($maxDepth) {

    $this->maxDepth = $maxDepth;

    parent::__construct(User::class);

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

  public function insert(User $user) { 

    $id_user = $this->insertDatabase('user', [
      'email' => $user->getEmail(),
      'password' => password_hash('password', PASSWORD_BCRYPT),
      'roles' => '["ROLE_ELF"]',
    ]);

  }  

  public function update(User $user) { 

    $this->updateDatabase('user', $user->getId(), [
      'email' => $user->getEmail(),
    ]);

  }  

  public function delete(User $user) { 

    $this->deleteDatabase('user', [
      'id' => $user->getId()
    ]);

  }
    
}
