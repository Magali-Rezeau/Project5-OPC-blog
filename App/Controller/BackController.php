<?php 
namespace App\Controller;

use App\DAO\PostDAO;
use App\DAO\CommentDAO;
use App\Model\Form;
use App\Controller\FormController;

class BackController {

    private $postDAO;
    private $commentDAO;
    private $form;
    private $userDAO;

    public function __construct()
    {
        $this->postDAO = new PostDAO();
        $this->commentDAO = new CommentDAO();
        $this->form = new Form($_POST);
        $this->validate = new FormController($_POST);
    }
    public function dashboard()
    {   
        $posts = $this->postDAO->getPosts();
        $comments = $this->commentDAO->getValidatedComments();
        require '../Views/admin/dashboard.php';
    }
}
