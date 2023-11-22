
<main class="container d-flex flex-column align-items-center main-mission p-0">
  <h1 class="pt-3 m-0">Salle des cadeaux</h1>
  <div class="div-gifts">
    <?php
      foreach ($gifts as $gift) {
        require 'giftCard.php';
      }
    ?>
  </div>
</main>