
<article class="d-flex flex-row w-100">  
  <div class="m-1 mb-3 comment w-100">
    <div class="d-flex">
      <p class="m-0">De <?= $comment->getVisitor()->getPseudo(); ?></p>
    </div>
    <p class="w-100 p-2"><?= $comment->getComment(); ?></p>
  </div>
</article>