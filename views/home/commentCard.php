
<article class="d-flex flex-row w-100">  
  <div class="card col-3 m-1">
    <div class="d-flex">
      <p class="card-text"><?= $comment->getVisitor()->getPseudo(); ?></p>
    </div>
  </div>
  <div class="card w-100 m-1 px-1">
    <p class="card-text"><?= $comment->getComment(); ?></p>
  </div>
</article>