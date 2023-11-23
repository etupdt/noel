
<main class="container d-flex flex-column align-items-center main-mission p-0">
  <h1 class="pt-3 m-0">Lettre au Père Noël</h1>
  <form method="POST" class="col-8">
    <div class="d-flex flex-column flex-md-row col-12">
      <div class="form-group col-5">
        <label class="mt-1" for="firstname">Nom</label>
        <input type="text" class="form-control border-success rounded-0" name="firstname" value="<?php echo $visitor->getFirstname() ?>">
      </div>
      <div class="form-group col-5 px-2">
        <label class="mt-1" for="lastname">Prénom</label>
        <input type="text" class="form-control border-success rounded-0" name="lastname" value="<?php echo $visitor->getLastname() ?>">
      </div>
      <div class="form-group col-2">
        <label class="mt-1" for="age">Age</label>
        <input type="number" class="form-control border-success rounded-0" min="1" name="age" value="<?php echo ($visitor->getAge() == 0 ? '' : $visitor->getAge()); ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="mt-1" for="pseudo">Pseudo</label>
      <input type="text" class="form-control border-success rounded-0" name="pseudo" value="<?php echo $visitor->getPseudo() ?>">
    </div>
    <div class="form-group">
      <label class="mt-1" for="address">Adresse</label>
      <input type="text" class="form-control border-success rounded-0" name="address" value="<?php echo $visitor->getAddress() ?>">
    </div>
    <div class="form-group">
      <label class="mt-3" for="letter">Ecris ta lettre au Père Noël</label>
      <textarea class="form-control border-success rounded-0" name="letter" rows="7"><?php echo $visitor->getLetter() ?></textarea>
    </div>
    <div class="form-group">
      <button class="btn btn-success mt-3 w-100">Envoie la lettre avec les cadeaux demandés</button>
    </div>
  </form>
  <h2 class="mt-3">Tu as selectionné les cadeaux suivants</h2>
  <div class="col-8">
    <?php 
    foreach ($commands as $command) {
      require 'giftCard.php';
    }
    ?>
  </div>
</main>