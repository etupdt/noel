<?php

class GiftPageController {

    public function index() { 
        require_once 'views/common/header.php';
        echo 'hello Gift !';
        require_once 'views/gift/giftPage.php';
        require_once 'views/common/footer.php';
    }

}