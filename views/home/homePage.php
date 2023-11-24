
<img class="screen-background" src="/assets/images/rennes4.jpg" alt="">
<div class="mask-screen-background"></div>

<main class="container d-flex align-items-center flex-column p-0 home">
  <h1 class="pt-3 mb-5">Le site du Père Noël</h1>
  <p class="mx-5">
    Noël c’est l’histoire de la naissance de Jésus, une histoire qui s’est passée il y a très longtemps.
    Les parents de Jésus, Marie et Joseph, avaient été appelés à faire un grand voyage alors que Marie attendait la naissance de son enfant. 
    Une nuit, le seul abri qu’ils trouvèrent fut celui d’une étable. C’est prés du bœuf et de l’âne, que Marie donna naissance à Jésus. 
    Jésus a été accueillis par les bergers alentours et aussi par des mages venus de très loin, tous guidés par l’étoile.
    C’est en mémoire de cette histoire qu’on fête Noël et que l’on prépare la crèche.
  </p>
  
  <div class="animation">

  </div>
  <?php if (isset($_SESSION['user'])) {require_once 'commentForm.php';} ?>
  <h2 class="mt-3">Les commentaires validés</h2>
  <div class="col-8">
    <?php
      foreach ($comments as $comment) {
        require 'commentCard.php';
      }
    ?>
  </div>
</main>
