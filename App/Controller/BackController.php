<?php 
namespace App\Controller;

use App\DAO\PostDAO;
use App\DAO\CommentDAO;
use App\Model\Form;
use App\Controller\FormController;
use App\DAO\UserDAO;

class BackController {

    private $postDAO;
    private $commentDAO;
    private $form;
    private $userDAO;
    private $validator;

    public function __construct()
    {
        $this->postDAO = new PostDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->form = new Form($_POST);
        $this->validator = new FormController($_POST);
    }
    public function dashboard()
    {   
          session_start();
            $posts = $this->postDAO->getPosts();
            $comments = $this->commentDAO->getValidatedComments();
            $users = $this->userDAO->getUsers();
        
        require '../Views/admin/dashboard.php';
    }
    public function editorDashboard()
    {   
        session_start();
        $posts = $this->postDAO->getPosts();
        require '../Views/admin/editorDashboard.php';
    }
    public function validateComment($commentId)
    {   
        $posts = $this->postDAO->getPosts();
        $comments = $this->commentDAO->getValidatedComments();
        $this->commentDAO->validateComment($commentId);
        header('Location: ../public/index.php?page=dashboard');
        require '../Views/admin/dashboard.php';
    }
    public function deleteComment($commentId) {
        $posts = $this->postDAO->getPosts();
        $comments = $this->commentDAO->getValidatedComments();
        $this->commentDAO->deleteComment($commentId);
        header('Location: ../public/index.php?page=dashboard');
        require '../Views/admin/dashboard.php';
    }
    public function addPost($method) {
        session_start();
        $form = $this->form;
        $validator = $this->validator;
       
        $validator->check('short_content','maxLenght','Ce champ doit comporter moins de 300 caractères',300);
        $validator->check('title','minLenght', 'Le titre doit comporter au moins 3 caractères', 3);

        if(!empty($method)) {
            $errors = $validator->getErrors();
            if(empty($errors)) {
                if($method['author'] === "Magali") {
                    $method['author'] = substr_replace("Magali","1",0);
                    $this->postDAO->addPost($method);
                    $succes = "Votre article a bien été ajouté";
                } else if ($method['author'] === "Marie") {
                    $method['author'] = substr_replace("Marie","2",0);
                    $this->postDAO->addPost($method);
                    $succes = "Votre article a bien été ajouté";
                } 
            }
        }
        require '../Views/admin/addPost.php'; 
    }
    public function deletePost($postId) {
        $this->postDAO->deletePost($postId);
        header("Location: ../public/index.php?page=dashboard");
        require '../Views/admin/dashboard.php';
    }
    public function editPost($method,$postId) {
        session_start();
        $form = $this->form;
        $post = $this->postDAO->getPost($postId);
        $validator = $this->validator;
      
        $validator->check('short_content','maxLenght','Ce champ doit comporter moins de 300 caractères',300);
        $validator->check('title','minLenght', 'Le titre doit comporter au moins 3 caractères', 3);
        
        if(!empty($method)) {
            $errors = $validator->getErrors();
            if(empty($errors)) {
                if($method['author'] === "Magali") {
                    $method['author'] = substr_replace("Magali","1",0);
                    $this->postDAO->editPost($method,$postId);
                    $succes = "Votre article a bien été modifié";
                } else if ($method['author'] === "Marie") {
                    $method['author'] = substr_replace("Marie","2",0);
                    $this->postDAO->editPost($method,$postId);
                    $succes = "Votre article a bien été modifié"; 
                } 
            }
        }
        require '../Views/admin/editPost.php'; 
    }
    public function deleteUser($userId) {
        $this->userDAO->deleteUser($userId);
        header("Location: ../public/index.php?page=dashboard");
        require '../Views/admin/dashboard.php';
    }
}
