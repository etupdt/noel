<?php

require_once 'models/repositories/GiftRepository.php';

class LetterPageController {

    private GiftRepository $giftRepository;
    private VisitorRepository $visitorRepository;

    public function __construct() {
 
        $depth = 1;

        $this->giftRepository = new GiftRepository(1);
        $this->visitorRepository = new VisitorRepository(3);

    }

    public function index() { 

        $styleSheets = [
            'non-admin.css'
        ];

        $scripts = [];

        $em = new EntityManager();

        $visitor = $this->visitorRepository->find('1');
        
        if (isset($visitor)) {

            if (!isset($commands)) {
                $commands = [];
                foreach ($visitor->getCommands() as $command) {
                    $commands[$command->getGift()->getId()] = $command;
                }
            } 
            
        } else {
            
            $visitor = new Visitor(0);
            $visitor->setEmail('');
            $visitor->setPassword('');
            $visitor->setFirstName('');
            $visitor->setLastName('');
            $visitor->setPseudo('');
            $visitor->setAge(0);
            $visitor->setAddress('');
            $visitor->setLetter('');
            
            $commands = [];
            
        } 
        
        foreach (json_decode($_COOKIE['gifts']) as $giftHtmlId => $qty) {

            $id_gift = explode('_', $giftHtmlId)[1];

            if (isset($commands[$id_gift])) {
                $command = $commands[$id_gift];
                $command->setQuantity($commands[$id_gift]->getQuantity() + $qty);
            } else {
                $command = new Command(0);
                $command->setQuantity($qty);
                $command->setVisitor($visitor);
                $command->setGift($this->giftRepository->find($id_gift));
            }
            
            $commands[$command->getGift()->getId()] = $command;
        
        }
        
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $visitor->setEmail($_POST['email']);
            $visitor->setFirstName($_POST['firstname']);
            $visitor->setLastName($_POST['lastname']);
            $visitor->setPseudo($_POST['pseudo']);
            $visitor->setAge($_POST['age']);
            $visitor->setAddress($_POST['address']);
            $visitor->setLetter($_POST['letter']);

            foreach ($visitor->getCommands() as $command) {
                $em->remove($command);
            }

            foreach ($commands as $command) {
                $em->persist($command);
            }

            $em->persist($visitor);
            $em->flush();

            setcookie('gifts', '{}');

        }

        require_once 'views/common/header.php';
        require_once 'views/letter/letterPage.php';
        require_once 'views/common/footer.php';

    }

}
