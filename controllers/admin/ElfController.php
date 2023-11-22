<?php

require_once 'models/entities/Elf.php';
require_once 'models/repositories/ElfRepository.php';
require_once 'models/repositories/EntityManager.php';

class ElfController {

    private ElfRepository $elfRepository;

    public function __construct() {
 
        error_log('===== Elf ====================================================================================================================>   ');

        $depth = 1;

        $this->elfRepository = new ElfRepository(0);

    }

    public function index() { 

        $styleSheets = [
            'admin.css'
        ];

        $scripts = [];

        $help = false;

        $em = new EntityManager();

        $nameMenu = "Elfe";
        $nameEntity = "elf";

        $fields = $this->getFields();

        require_once 'views/common/header.php';

        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            if (! isset($_GET['a']) || $_GET['a'] === 'c') {
                $rows = $this->getRows();
                require_once 'views/admin/entityList.php';
            } else {
                switch ($_GET['a']) {
                    case 'd' : {
                        $row = $this->elfRepository->find($_GET['id']);
                        $em->remove($row);
                        $em->flush();
                        $rows = $this->getRows();
                        require_once 'views/admin/entityList.php';
                        break;
                    }
                    case 'u' : {
                        $row = $this->getRow($this->elfRepository->find($_GET['id']));
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                    case 'i' : {
                        $elf = new Elf();
                        $elf->setEmail('');
                        $elf->setName('');
                        $row = $this->getRow($elf);
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                }
            }

        } else {

            if ($_POST['id'] !== "0") {

                $elf = $this->elfRepository->find($_POST['id']); 

            } else {

                $elf = new Elf(0);

            }    

            $elf->setEmail($_POST['email']);
            $elf->setName($_POST['name']);

            $em->persist($elf);
            $em->flush();

            $rows = $this->getRows();
            require_once 'views/admin/entityList.php';

        }

        require_once 'views/footer.php';

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
            'type' => 'email'
        ];
        $fields[] = [
            'label' => 'Nom',
            'name' => 'name',
            'type' => 'text'
        ];

        return $fields;

    }

    private function getRows (): array
    {

        $elfes = [];

        foreach ($this->elfRepository->findAll() as $elf) {

            $elfes[] = $this->getRow($elf);
        } 

        return $elfes;

    }

    private function getRow (Elf $elf): array 
    {

        return  [
            'id' => $elf->getId(),
            'email' => $elf->getEmail(),
            'name' => $elf->getName()
        ];

    }
    
}