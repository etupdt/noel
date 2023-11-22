<?php

require_once 'models/entities/Comment.php';
require_once 'models/repositories/CommentRepository.php';
require_once 'models/repositories/EntityManager.php';

class CommentController {

    private CommentRepository $commentRepository;
    private VisitorRepository $visitorRepository;

    public function __construct() {
 
        error_log('===== Comment ====================================================================================================================>   ');

        $depth = 1;

        $this->commentRepository = new CommentRepository(1);
        $this->visitorRepository = new VisitorRepository(0);

    }

    public function index() { 

        $styleSheets = [
            'admin.css'
        ];

        $scripts = [];

        $help = false;

        $em = new EntityManager();

        $nameMenu = "Commentaires";
        $nameEntity = "comment";

        $fields = $this->getFields();

        require_once 'views/common/header.php';

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
            $comment->setVisitor($this->visitorRepository->find($_POST['id_visitor'])); 

            $em->persist($comment);
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
            'label' => 'Commentaire',
            'name' => 'comment',
            'type' => 'textarea'
        ];
        $fields[] = [
            'label' => 'Modéré',
            'name' => 'validate',
            'type' => 'checkbox'
        ];

        $visitors = [];

        foreach ($this->visitorRepository->findAll() as $visitor) {
            $visitors[$visitor->getId()] = $visitor->getPseudo();
        }

        $fields[] = [
            'label' => 'Visiteur',
            'name' => 'id_visitor',
            'type' => 'select',
            'value' => $visitors
        ];

        return $fields;

    }

    private function getRows (): array
    {

        $comments = [];

        foreach ($this->commentRepository->findAll() as $comment) {

            $comments[] = $this->getRow($comment);
        } 

        return $comments;

    }

    private function getRow (Comment $comment): array 
    {

        $visitor = $comment->getVisitor();

        return  [
            'id' => $comment->getId(),
            'comment' => $comment->getComment(),
            'validate' => $comment->getValidate(),
            'id_visitor' => isset($visitor) ? $visitor->getId() : 0,
        ];

    }
    
}