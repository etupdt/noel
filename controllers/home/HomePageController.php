<?php

require_once 'models/repositories/CommentRepository.php';

class HomePageController {

    private CommentRepository $commentRepository;
    private VisitorRepository $visitorRepository;

    public function __construct() {
 
        $depth = 1;

        $this->commentRepository = new CommentRepository(1);
        $this->visitorRepository = new VisitorRepository(1);

    }

    public function index() { 

        $styleSheets = [
            'non-admin.css',
            'home.css'
        ];

        $scripts = [];

        $menuOption = "home";

        $em = new EntityManager();
    
        if (isset($_SESSION['user'])) {
            $visitor = $this->visitorRepository->find(''.$_SESSION['user']->getId());
        }

        $comments = $this->commentRepository->findBy(['validate' => 1]);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
            $comment = new Comment();
            $comment->setComment($_POST['comment']);
            $comment->setValidate(false);
            $comment->setVisitor($visitor);
            
            $em->persist($comment);
            $em->flush();
            
        }
        
        $comment = new Comment(0);
        $comment->setComment('');
        
        require_once 'views/common/header.php';
        require_once 'views/home/homePage.php';
        require_once 'views/common/footer.php';

    }

}