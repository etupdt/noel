<?php

class LetterPageController {

    public function index() { 
        require_once 'views/common/header.php';
        echo 'hello Letter !';
        require_once 'views/letter/letterPage.php';
        require_once 'views/common/footer.php';
    }

}