<?php

require_once 'models/repositories/ServiceEntityRepository.php';

class CommentRepository extends ServiceEntityRepository {

  public function __construct($maxDepth) {

    $this->maxDepth = $maxDepth;

    parent::__construct(Comment::class);

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

  public function insert(Comment $comment) { 

    $id_comment = $this->insertDatabase('comment', [
      'comment' => $comment->getComment(),
      'validate' => $comment->getValidate() ? 1 : 0,
      'id_visitor' => $comment->getVisitor()->getId()
    ]);

  }  

  public function update(Comment $comment) { 

    $this->updateDatabase('comment', $comment->getId(), [
      'comment' => $comment->getComment(),
      'validate' => $comment->getValidate() ? 1 : 0,
      'id_visitor' => $comment->getVisitor()->getId()
    ]);

  }  

  public function delete(Comment $comment) { 

    $this->deleteDatabase('comment', [
      'id' => $comment->getId()
    ]);
    
  }  

}
