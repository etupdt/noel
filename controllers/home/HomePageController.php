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
            'non-admin.css'
        ];

        $scripts = [];

        $em = new EntityManager();
    
        $visitor = $this->visitorRepository->find('1');
        
        if (!isset($visitor)) {
            $comments = [];
        } else {
            $comments = $this->commentRepository->findBy(['id_visitor' => $visitor->getId(), 'validate' => 1]);
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
            $comment = new Comment();
            $comment->setComment($_POST['comment']);
            $comment->setValidate(false);
            $comment->setVisitor($visitor);
            
            // $comments[] = $comment;
            
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