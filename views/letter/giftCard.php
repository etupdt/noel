
<article class="d-flex flex-row w-100">
  <div class="card col-3 m-1">
    <div class="d-flex justify-content-center">
      <img class="img-card" src="<?= '/assets/images/cards/'.$command->getGift()->getImageName(); ?>">
    </div>
  </div>
  <div class="card col-6 m-1 px-1">
    <h5 class="card-title"><?= $command->getGift()->getName(); ?></h5>
    <p class="card-text"><?= $command->getGift()->getDescription(); ?></p>
  </div>
  <div class="card w-100 m-1">
    <h5 class="card-title ms-5">Qté : <?= $command->getQuantity(); ?></h5>
    <p class="card-text ms-5"><?= $command->getGift()->getCategory()->getName(); ?></p>
  </div>
</article>
