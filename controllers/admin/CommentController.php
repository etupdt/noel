<?php

require_once 'models/entities/Comment.php';
require_once 'models/repositories/CommentRepository.php';
require_once 'models/repositories/EntityManager.php';

class CommentController {

    private CommentRepository $commentRepository;

    public function __construct() {
 
        error_log('===== Comment ====================================================================================================================>   ');

        $depth = 1;

        $this->commentRepository = new CommentRepository(0);

    }

    public function index() { 

        $help = false;

        $em = new EntityManager();

        $nameMenu = "Commentaires";
        $nameEntity = "comment";

        $fields = $this->getFields();

        require_once 'views/header.php';

        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            if (! isset($_GET['a']) || $_GET['a'] === 'c') {
                $rows = $this->getRows();
                require_once 'views/admin/entityList.php';
            } else {
                switch ($_GET['a']) {
                    case 'd' : {
                        $row = $this->commentRepository->find($_GET['id']);
                        $em->remove($row);
                        $em->flush();
                        $rows = $this->getRows();
                        require_once 'views/admin/entityList.php';
                        break;
                    }
                    case 'u' : {
                        $row = $this->getRow($this->commentRepository->find($_GET['id']));
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                    case 'i' : {
                        $comment = new Comment();
                        $comment->setComment('');
                        $comment->setValidate(false);
                        $comment->setPseudo('');
                        $row = $this->getRow($comment);
                        require_once 'views/admin/entityForm.php';
                        break;
                    }
                }
            }

        } else {

            if ($_POST['id'] !== "0") {

                $comment = $this->commentRepository->find($_POST['id']); 

            } else {

                $comment = new Comment(0);

            }    

            $comment->setComment($_POST['comment']);
            $comment->setValidate(isset($_POST['validate']) ? true : false);
            $comment->setPseudo($_POST['pseudo']);

            $em->persist($comment);
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
            'label' => 'Commentaire',
            'name' => 'comment',
            'type' => 'textarea'
        ];
        $fields[] = [
            'label' => 'Modéré',
            'name' => 'validate',
            'type' => 'checkbox'
        ];
        $fields[] = [
            'label' => 'Pseudo',
            'name' => 'pseudo',
            'type' => 'text'
        ];

        return $fields;

    }

    private function getRows (): array
    {

        $categories = [];

        foreach ($this->commentRepository->findAll() as $comment) {

            $categories[] = $this->getRow($comment);
        } 

        return $categories;

    }

    private function getRow (Comment $comment): array 
    {

        return  [
            'id' => $comment->getId(),
            'comment' => $comment->getComment(),
            'validate' => $comment->getValidate(),
            'pseudo' => $comment->getPseudo()
        ];

    }
    
}