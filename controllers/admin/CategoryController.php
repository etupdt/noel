<?php

require_once 'models/entities/Category.php';
require_once 'models/repositories/EntityManager.php';

class CategoryController {

    private CategoryRepository $categoryRepository;

    public function __construct() {
 
        error_log('===== Category ====================================================================================================================>   ');

        $depth = 1;

        $this->categoryRepository = new CategoryRepository(0);

    }

    public function index() { 

        $help = false;

        $em = new EntityManager();

        $nameMenu = "Categorys Mission";
        $nameEntity = "category";

        $fields = $this->getFields();

        require_once 'views/header.php';

        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            if (! isset($_GET['a']) || $_GET['a'] === 'c') {
                $rows = $this->getRows();
                require_once 'views/admin/entityList.php';
            } else {
                switch ($_GET['a']) {
                    case 'd' : {
                        $row = $this->categoryRepository->find($_GET['id']);
                        $em->remove($row);
                        $em->flush();
                        $rows = $this->getRows();
                        require_once 'views/admin/entityList.php';
                        break;
                    }
                    case 'u' : {
                        $row = $this->getRow($this->categoryRepository->find($_GET['id']));
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                    case 'i' : {
                        $category = new Category();
                        $category->setName('');
                        $row = $this->getRow($category);
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                }
            }

        } else {

            if ($_POST['id'] !== "0") {

                $category = $this->categoryRepository->find($_POST['id']); 

            } else {

                $category = new Category(0);

            }    

            $category->setCategory($_POST['category']);

            $em->persist($category);
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
            'label' => 'Nom',
            'name' => 'name',
            'type' => 'text'
        ];

        return $fields;

    }

    private function getRows (): array
    {

        $categories = [];

        foreach ($this->categoryRepository->findAll() as $category) {

            $categories[] = $this->getRow($category);
        } 

        return $categories;

    }

    private function getRow (Category $category): array 
    {

        return  [
            'id' => $category->getId(),
            'name' => $category->getName()
        ];

    }
    
}