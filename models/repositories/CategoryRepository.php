<?php

require_once 'models/repositories/ServiceEntityRepository.php';

class CategoryRepository extends ServiceEntityRepository {

  public function __construct($maxDepth) {

    $this->maxDepth = $maxDepth;

    parent::__construct(Category::class);

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

  public function insert(Category $category) { 

    $id_category = $this->insertDatabase('category', [
      'name' => $category->getName(),
    ]);

  }  

  public function update(Category $category) { 

    $this->updateDatabase('category', $category->getId(), [
      'name' => $category->getName(),
    ]);

  }  

  public function delete(Category $category) { 

    $this->deleteDatabase('category', [
      'id' => $category->getId()
    ]);
    
  }  

}
