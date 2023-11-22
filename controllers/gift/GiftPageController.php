<?php

class GiftPageController {

    public function index() { 

        require_once 'models/repositories/GiftRepository.php';

        $styleSheets = [
            'non-admin.css'
        ];

        $scripts = [
            'giftPage.js'
        ];

        $gifts = (new GiftRepository(1))->findAll();

        require_once 'views/common/header.php';
        require_once 'views/gift/giftPage.php';
        require_once 'views/common/footer.php';
    }

}