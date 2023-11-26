
<img class="screen-background" src="/assets/images/pexels-photo-6101955.jpg" alt="">
<div class="mask-screen-background"></div>

<main class="container d-flex flex-column align-items-end main-mission p-0">
  <h1 class="pt-3  mb-5">Lettre au Père Noël</h1>
  <?php if (!isset($_SESSION['user'])) { ?>
    <div class="d-flex col-8">
      <h5 class="pt-3 mb-5 w-100">Pour pouvoir écrire au père Noël, connecte toi ou inscris toi en cliquant sur l'icône : 
        <svg title="Login" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
          <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
        </svg></h5>
      </div>
  <?php } ?>
  <form method="POST" class="col-8" id="letterpage">
    <div class="d-flex flex-column flex-md-row col-12">
      <div class="form-group col-5">
        <label class="mt-1" for="firstname">Nom</label>
        <input type="text" class="form-control border-success rounded-0" name="firstname" value="<?php echo $visitor->getFirstname() ?>" required>
      </div>
      <div class="form-group col-5 px-2">
        <label class="mt-1" for="lastname">Prénom</label>
        <input type="text" class="form-control border-success rounded-0" name="lastname" value="<?php echo $visitor->getLastname() ?>" required>
      </div>
      <div class="form-group col-2">
        <label class="mt-1" for="age">Age</label>
        <input type="number" class="form-control border-success rounded-0" min="1" name="age" value="<?php echo ($visitor->getAge() == 0 ? '' : $visitor->getAge()); ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="mt-1" for="pseudo">Pseudo</label>
      <input type="text" class="form-control border-success rounded-0" name="pseudo" value="<?php echo $visitor->getPseudo() ?>" required>
    </div>
    <div class="form-group">
      <label class="mt-1" for="address">Adresse</label>
      <input type="text" class="form-control border-success rounded-0" name="address" value="<?php echo $visitor->getAddress() ?>" required>
    </div>
    <div class="form-group">
      <label class="mt-3" for="letter">Ecris ta lettre au Père Noël</label>
      <textarea id="letter-area" class="form-control border-success rounded-0" name="letter" rows="7" required><?php echo $visitor->getLetter() ?></textarea>
    </div>
    <div class="form-group d-flex justify-content-end">
      <button class="btn btn-outline-success mt-3 w-50" id="letter-validate">Envoie la lettre avec les cadeaux demandés</button>
    </div>
  </form>
  <?php if (count($commands) > 0) { 
    echo '<h2 class="mt-3">Tu as selectionné les cadeaux suivants</h2>';
  } ?>
  <div class="col-8">
    <?php 
    foreach ($commands as $command) {
      require 'giftCard.php';
    }
    ?>
  </div>
</main>