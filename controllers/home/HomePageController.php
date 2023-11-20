<?php

class HomePageController {

    public function index() { 
        require_once 'views/common/header.php';
        echo 'hello Home !';
        require_once 'views/common/footer.php';
    }

}