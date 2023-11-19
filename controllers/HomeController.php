<?php

class HomeController {

    public function index() { 
        require_once 'views/header.php';
        echo 'hello !';
        require_once 'views/footer.php';
    }

}