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

    public function __construct()
    {
        $this->postDAO = new PostDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->form = new Form($_POST);
        $this->validate = new FormController($_POST);
    }
    public function dashboard()
    {   
        $posts = $this->postDAO->getPosts();
        $comments = $this->commentDAO->getValidatedComments();
        $users = $this->userDAO->getUsers();
        require '../Views/admin/dashboard.php';
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
        $form = $this->form;
        $validate = $this->validate;
        $validate->check('title','required', 'Ce champ est obligatoire');
        $validate->check('content','required','Ce champ est obligatoire');
        $validate->check('short_content','required','Ce champ est obligatoire');
        $validate->check('short_content','maxLenght','Ce champ doit comporter moins de 300 caractères',300);
        $validate->check('author','required','Ce champ est obligatoire');
        $validate->check('title','minLenght', 'Le titre doit comporter au moins 3 caractères', 3);
        if(!empty($method)) {
            $errors = $validate->getErrors();
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
        $form = $this->form;
        $post = $this->postDAO->getPost($postId);
        $validate = $this->validate;
        $validate->check('title','required', 'Ce champ est obligatoire');
        $validate->check('content','required','Ce champ est obligatoire');
        $validate->check('short_content','required','Ce champ est obligatoire');
        $validate->check('short_content','maxLenght','Ce champ doit comporter moins de 300 caractères',300);
        $validate->check('author','required','Ce champ est obligatoire');
        $validate->check('title','minLenght', 'Le titre doit comporter au moins 3 caractères', 3);
        if(!empty($method)) {
            $errors = $validate->getErrors();
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
}
