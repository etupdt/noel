<?php

require_once 'models/entities/Visitor.php';
require_once 'models/repositories/VisitorRepository.php';
require_once 'models/repositories/GiftRepository.php';
require_once 'models/repositories/EntityManager.php';

class VisitorController {

    private VisitorRepository $visitorRepository;
    private GiftRepository $giftRepository;

    public function __construct() {
 
        error_log('===== Visitor ====================================================================================================================>   ');

        $depth = 1;

        $this->visitorRepository = new VisitorRepository(1);
        $this->giftRepository = new GiftRepository(1);

    }

    public function index() { 

        $help = false;

        $em = new EntityManager();

        $nameMenu = "Visiteur";
        $nameEntity = "visitor";

        $fields = $this->getFields();

        require_once 'views/common/header.php';

        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            if (! isset($_GET['a']) || $_GET['a'] === 'c') {
                $rows = $this->getRows();
                require_once 'views/admin/entityList.php';
            } else {
                switch ($_GET['a']) {
                    case 'd' : {
                        $row = $this->visitorRepository->find($_GET['id']);
                        $em->remove($row);
                        $em->flush();
                        $rows = $this->getRows();
                        require_once 'views/admin/entityList.php';
                        break;
                    }
                    case 'u' : {
                        $row = $this->getRow($this->visitorRepository->find($_GET['id']));
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                    case 'i' : {
                        $visitor = new Visitor();
                        $visitor->setEmail('');
                        $visitor->setFirstName('');
                        $visitor->setLastName('');
                        $visitor->setAge(0);
                        $visitor->setAddress('');
                        $visitor->setLetter('');
                        $visitor->setGifts([]);
                        $row = $this->getRow($visitor);
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                }
            }

        } else {

            $commands = [];
            
            $idsGifts = $_POST['gifts'];

            foreach($idsGifts as $id_gift) {
                $gifts[] = [
                    'id_gift' => $id_gift,
                ];
            }

            if ($_POST['id'] !== "0") {

                $visitor = $this->visitorRepository->find($_POST['id']); 

            } else {

                $visitor = new Visitor();

            }    

            $visitor->setEmail($_POST['email']);
            $visitor->setFirstName($_POST['firstname']);
            $visitor->setLastName($_POST['lastname']);
            $visitor->setAge($_POST['age']);
            $visitor->setAddress($_POST['address']);
            $visitor->setLetter($_POST['letter']);
            $visitor->setGifts($gifts);

            $em->persist($visitor);
            $em->flush();

            $rows = $this->getRows();
            require_once 'views/admin/entityList.php';

        }

        require_once 'views/common/footer.php';

    }

    private function getFields (): array
    {

        $fields[] = [
            'label' => 'Id',
            'name' => 'id',
            'type' => 'text'
        ];
        $fields[] = [
            'label' => 'Email',
            'name' => 'email',
            'type' => 'email',
            'hideInList' => true
        ];
        $fields[] = [
            'label' => 'Nom',
            'name' => 'firstname',
            'type' => 'text'
        ];
        $fields[] = [
            'label' => 'Prénom',
            'name' => 'lastname',
            'type' => 'text'
        ];
        $fields[] = [
            'label' => 'Age',
            'name' => 'age',
            'type' => 'text'
        ];
        $fields[] = [
            'label' => 'Adresse',
            'name' => 'address',
            'type' => 'text',
            'hideInList' => true
        ];
        $fields[] = [
            'label' => 'Lettre',
            'name' => 'letter',
            'type' => 'textarea',
            'hideInList' => true
        ];

        $gifts = [];

        foreach ($this->giftRepository->findAll() as $gift) {
            $gifts[] = [
                'id' => $gift->getId(),
                'name' => $gift->getName()
            ];
        }

        $fields[] = [
            'label' => 'Cadeaux',
            'name' => 'gifts',
            'type' => 'multiSelect',
            'value' => $gifts,
        ];

        return $fields;

    }

    private function getRows (): array
    {

        $categories = [];

        foreach ($this->visitorRepository->findAll() as $visitor) {

            $categories[] = $this->getRow($visitor);
        } 

        return $categories;

    }

    private function getRow (Visitor $visitor): array 
    {

        $gifts = $visitor->getGifts();

        return  [
            'id' => $visitor->getId(),
            'email' => $visitor->getEmail(),
            'firstname' => $visitor->getFirstName(),
            'lastname' => $visitor->getLastName(),
            'age' => $visitor->getAge(),
            'address' => $visitor->getAddress(),
            'letter' => $visitor->getLetter(),
            'gifts' => isset($gifts) ? $gifts : [],
        ];

    }
    
}