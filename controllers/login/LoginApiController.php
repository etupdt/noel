<?php

require_once 'models/repositories/UserRepository.php';

class LoginApiController {

  public function login() { 

    $styleSheets = [
      'non-admin.css'
    ];

    $scripts = [];

    $errors = [];

    $em = new EntityManager();

    $body = json_decode(file_get_contents("php://input"));

    $userRepository = new UserRepository(0);

    $users = $userRepository->findBy(['email' => $body->email]);
    $user = $users[0];
    error_log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> '.$user->getEmail());

    
    if ($user && password_verify($body->password, $user->getPassword())) {
      session_regenerate_id(true);
      $_SESSION['user'] = $user;
      $return = [
        "code" => 0, 
        "message" => "Vous êtes connecté !"
      ];
    } else {
      $return = [
        "code" => 1, 
        "message" => "Erreur lors de la saisie des identifiants de connexion !"
      ];
    }
        
    $json = json_encode($return);

    echo $json;
    
  }

  public function logout() { 

    $styleSheets = [];

    $scripts = [];

    session_regenerate_id(true);
    session_destroy();
    unset($_session);

    $return = [
      "code" => 0, 
      "message" => "Vous êtes déconnecté !"
    ];
        
    $json = json_encode($return);

    echo $json;

  }

}