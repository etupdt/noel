<?php

require_once 'models/entities/Gift.php';
require_once 'models/repositories/GiftRepository.php';
require_once 'models/repositories/EntityManager.php';

class GiftController {

    private GiftRepository $giftRepository;
    private CategoryRepository $categoryRepository;

    public function __construct() {
 
        error_log('===== Gift ====================================================================================================================>   ');

        $depth = 1;

        $this->giftRepository = new GiftRepository(1);
        $this->categoryRepository = new CategoryRepository(1);

    }

    public function index() { 

        $styleSheets = [
            'admin.css'
        ];

        $scripts = [];

        $help = false;

        $em = new EntityManager();

        $nameMenu = "Cadeau";
        $nameEntity = "gift";

        $fields = $this->getFields();

        require_once 'views/common/header.php';

        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            if (! isset($_GET['a']) || $_GET['a'] === 'c') {
                $rows = $this->getRows();
                require_once 'views/admin/entityList.php';
            } else {
                switch ($_GET['a']) {
                    case 'd' : {
                        $row = $this->giftRepository->find($_GET['id']);
                        $em->remove($row);
                        $em->flush();
                        $rows = $this->getRows();
                        require_once 'views/admin/entityList.php';
                        break;
                    }
                    case 'u' : {
                        $row = $this->getRow($this->giftRepository->find($_GET['id']));
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                    case 'i' : {
                        $gift = new Gift();
                        $gift->setName('');
                        $gift->setAge(0);
                        $gift->setDescription('');
                        $gift->setValidate(true);
                        $gift->setImageName('');
                        $row = $this->getRow($gift);
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                }
            }

        } else {

            $tmpName = $_FILES['imageName']['tmp_name']; 
            $name = $_FILES['imageName']['name'];
            $size = $_FILES['imageName']['size'];
            $error = $_FILES['imageName']['error'];

            if ($_POST['id'] !== "0") {

                $gift = $this->giftRepository->find($_POST['id']); 

                if (isset($tmpName) && $tmpName !== '' && hash_file('md5', $tmpName) !== hash_file('md5', '/assets/images/cards/'.$gift->getImageName())) {
                    move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'].'/assets/images/cards/'.$name);
                } else {
                    $name = $gift->getImageName();
                }

            } else {

                $gift = new Gift(0);
                move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'].'/assets/images/cards/'.$name);

            }    

            $gift->setName($_POST['name']);
            $gift->setAge($_POST['age']);
            $gift->setDescription($_POST['description']);
            $gift->setValidate(isset($_POST['validate']) ? true : false);
            $gift->setImageName($name);
            $gift->setCategory($this->categoryRepository->find($_POST['id_category'])); 

            $em->persist($gift);
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
            'label' => 'Nom',
            'name' => 'name',
            'type' => 'text'
        ];
        $fields[] = [
            'label' => 'Age',
            'name' => 'age',
            'type' => 'text'
        ];
        $fields[] = [
            'label' => 'Description',
            'name' => 'description',
            'type' => 'textarea'
        ];
        $fields[] = [
            'label' => 'Validé',
            'name' => 'validate',
            'type' => 'checkbox'
        ];
        $fields[] = [
            'label' => 'Image',
            'name' => 'imageName',
            'type' => 'image',
            'path' => "/assets/images/cards/"
        ];

        $categories = [];

        foreach ($this->categoryRepository->findAll() as $category) {
            $categories[$category->getId()] = $category->getName();
        }

        $fields[] = [
            'label' => 'Catégorie',
            'name' => 'id_category',
            'type' => 'select',
            'value' => $categories
        ];

        return $fields;

    }

    private function getRows (): array
    {

        $gifts = [];

        foreach ($this->giftRepository->findAll() as $gift) {

            $gifts[] = $this->getRow($gift);
        } 

        return $gifts;

    }

    private function getRow (Gift $gift): array 
    {

        $category = $gift->getCategory();

        return  [
            'id' => $gift->getId(),
            'name' => $gift->getName(),
            'age' => $gift->getAge(),
            'description' => $gift->getDescription(),
            'validate' => $gift->getValidate(),
            'imageName' => $gift->getImageName(),
            'id_category' => isset($category) ? $category->getId() : 0,
        ];

    }
    
}