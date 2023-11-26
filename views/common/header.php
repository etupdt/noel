<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="docsearch:language" content="fr">
  <title>Noël</title>
  <link href="/views/css/common.css" rel="stylesheet">
  <?php 
    foreach ($styleSheets as $styleSheet) {
      echo '<link href="/views/css/'.$styleSheet.'" rel="stylesheet">';
    }
  ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="/views/js/common.js" defer></script>
  <script type="module" src="/views/js/cropper.min.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <?php 
    foreach ($scripts as $script) {
      echo '<script src="/views/js/'.$script.'" defer></script>';
    }
  ?>
</head>
<body>
  
<header>
  <nav class="navbar navbar-dark navbar-expand-lg border-bottom">
    <div class="container">
      <a class="navbar-brand" href="#"><img class="logo" src="/assets/images/logo.png" alt=""></a>
      <div id="compte-rebours">
            <div class="unity-rebours" id="rebours-days">
              <div id="rebours-days-counter"></div>
              <div class="unity">Jours</div>
            </div>
            <div class="unity-rebours" id="rebours-hours">
              <div id="rebours-hours-counter"></div>
              <div class="unity">Heures</div>
            </div>
            <div class="unity-rebours" id="rebours-minutes">
              <div id="rebours-minutes-counter"></div>
              <div class="unity">Minutes</div>
            </div>
            <div class="unity-rebours" id="rebours-secondes">
              <div id="rebours-secondes-new-counter"></div>
              <div id="rebours-secondes-counter"></div>
              <div class="unity">Secondes</div>
            </div>
          </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] === '/') echo 'active'; else echo ''; ?>" aria-current="page" href="<?php echo BASE_URL.'/';?>">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] === '/gift') echo 'active'; else echo ''; ?>" href="<?php echo BASE_URL."/gift";?>">Cadeaux</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] === '/letter') echo 'active'; else echo ''; ?>" href="<?php echo BASE_URL."/letter";?>">Lettre</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php if (strpos($_SERVER['REQUEST_URI'], '/admin') === 0) echo 'active'; else echo ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Administration
            </a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href=<?php echo BASE_URL.ADMIN_URL."/category";?>>Catégories</a></li>
            <li><a class="dropdown-item" href=<?php echo BASE_URL.ADMIN_URL."/comment";?>>Commentaires</a></li>
            <li><a class="dropdown-item" href=<?php echo BASE_URL.ADMIN_URL."/gift";?>>Cadeaux</a></li>
            <li><a class="dropdown-item" href=<?php echo BASE_URL.ADMIN_URL."/elf";?>>Elfes</a></li>
            <li><a class="dropdown-item" href=<?php echo BASE_URL.ADMIN_URL."/visitor";?>>Visiteurs</a></li>
            <li><a class="dropdown-item" href=<?php echo BASE_URL.ADMIN_URL."/command";?>>Commandes</a></li>
            </ul>
          </li>
        </ul>
        <div class="ms-2">
          <button id="button-login" type="submit" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#loginpage"
            style="display: <?php echo isset($_SESSION['user']) ? 'none' : 'block'; ?>"
          >
            <svg title="Login" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
              <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg>
          </button>
          <?php require_once 'views/common/loginModal.php'; ?>
          <?php require_once 'views/common/logonModal.php'; ?>
          <?php require_once 'views/common/forgotModal.php'; ?>
          <button id="button-logout" type="submit" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#logoutpage" 
            style="display: <?php echo isset($_SESSION['user']) ? 'block' : 'none'; ?>"
          >
            <svg title="logout" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
              <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg>
          </button>
          <?php require_once 'views/common/logoutModal.php'; ?>
        </div>
      </div>
    </div>
  </nav>
</header>
