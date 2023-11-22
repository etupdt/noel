<?php

require_once 'models/entities/Command.php';
require_once 'models/repositories/CommandRepository.php';
require_once 'models/repositories/EntityManager.php';

class CommandController {

    private CommandRepository $commandRepository;
    private VisitorRepository $visitorRepository;
    private GiftRepository $giftRepository;

    public function __construct() {
 
        error_log('===== Command ====================================================================================================================>   ');

        $depth = 1;

        $this->commandRepository = new CommandRepository(1);
        $this->visitorRepository = new VisitorRepository(0);
        $this->giftRepository = new GiftRepository(0);

    }

    public function index() { 

        $styleSheets = [
            'admin.css'
        ];

        $scripts = [];

        $help = false;

        $em = new EntityManager();

        $nameMenu = "Commande";
        $nameEntity = "command";

        $fields = $this->getFields();

        require_once 'views/common/header.php';

        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            if (! isset($_GET['a']) || $_GET['a'] === 'c') {
                $rows = $this->getRows();
                require_once 'views/admin/entityList.php';
            } else {
                switch ($_GET['a']) {
                    case 'd' : {
                        $row = $this->commandRepository->find($_GET['id']);
                        $em->remove($row);
                        $em->flush();
                        $rows = $this->getRows();
                        require_once 'views/admin/entityList.php';
                        break;
                    }
                    case 'u' : {
                        $row = $this->getRow($this->commandRepository->find($_GET['id']));
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                    case 'i' : {
                        $command = new Command();
                        $command->setQuantity(0);
                        $command->setVisitor(new Visitor(0));
                        $command->setGift(new Gift(0));
                        $row = $this->getRow($command);
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                }
            }

        } else {

            if ($_POST['id'] !== "0") {

                $command = $this->commandRepository->find($_POST['id']); 

            } else {

                $command = new Command(0);

            }    

            $command->setQuantity($_POST['quantity']);
            $command->setVisitor($this->visitorRepository->find($_POST['id_visitor'])); 
            $command->setGift($this->giftRepository->find($_POST['id_gift'])); 

            $em->persist($command);
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
            'label' => 'Nombre',
            'name' => 'quantity',
            'type' => 'text'
        ];

        $visitors = [];

        foreach ($this->visitorRepository->findAll() as $visitor) {
            $visitors[$visitor->getId()] = $visitor->getLastName().' '.$visitor->getFirstName();
        }

        $fields[] = [
            'label' => 'Visiteur',
            'name' => 'id_visitor',
            'type' => 'select',
            'value' => $visitors
        ];

        $gifts = [];

        foreach ($this->giftRepository->findAll() as $gift) {
            $gifts[$gift->getId()] = $gift->getName();
        }

        $fields[] = [
            'label' => 'Cadeau',
            'name' => 'id_gift',
            'type' => 'select',
            'value' => $gifts
        ];

        return $fields;

    }

    private function getRows (): array
    {

        $categories = [];

        foreach ($this->commandRepository->findAll() as $command) {

            $categories[] = $this->getRow($command);
        } 

        return $categories;

    }

    private function getRow (Command $command): array 
    {

        $visitor = $command->getVisitor();
        $gift = $command->getGift();

        return  [
            'id' => $command->getId(),
            'quantity' => $command->getQuantity(),
            'id_visitor' => isset($visitor) ? $visitor->getId() : 0,
            'id_gift' => isset($gift) ? $gift->getId() : 0,
        ];

    }
    
}