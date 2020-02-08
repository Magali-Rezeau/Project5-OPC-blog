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
        $posts = $this->postDAO->getPosts();
        $comments = $this->commentDAO->getValidatedComments();
        $users = $this->userDAO->getUsers();
        require '../Views/admin/dashboard.php';
    }
    public function editorDashboard()
    {   
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
    public function deleteComment($commentId) 
    {
        $posts = $this->postDAO->getPosts();
        $comments = $this->commentDAO->getValidatedComments();
        $this->commentDAO->deleteComment($commentId);
        header('Location: ../public/index.php?page=dashboard');
        require '../Views/admin/dashboard.php';
    }
    public function addPost($method) 
    {
        $form = $this->form;
        $validator = $this->validator;
        $validator->check('short_content', 'maxLenght', 'Ce champ doit comporter moins de 300 caractères', 300);
        $validator->check('title', 'minLenght', 'Le titre doit comporter au moins 3 caractères', 3);
        if(!empty($method)) {
            $errors = $validator->getErrors();
            if(empty($errors)) {
                if($method['author'] === $_SESSION['pseudo']) {
                    $method['author'] = substr_replace($_SESSION['pseudo'], $_SESSION['id_user'], 0);
                    $this->postDAO->addPost($method);
                    $succes_addPost = "Votre article a bien été ajouté.";
                } else {
                    $error_authorAddPost = "Le champ auteur est mal renseigné.";
                }
            } else {
                $error_addPost = "Une erreur est survenue.";
            }
        }
        require '../Views/admin/addPost.php'; 
    }
    public function deletePost($postId) 
    {
        $this->postDAO->deletePost($postId);
        if(isset($_SESSION['role']) && $_SESSION['role'] === 'ADMIN') {
            header("Location: ../public/index.php?page=dashboard");
        } elseif(isset($_SESSION['role']) && $_SESSION['role'] === 'EDITOR') {
            header("Location: ../public/index.php?page=editorDashboard");
        } else {
            $error_deletePost = "Une erreur est survenue lors de la suppression d'un article.";
        }
       
        require '../Views/admin/dashboard.php';
    }
    public function editPost($method,$postId) 
    {
        $form = $this->form;
        $post = $this->postDAO->getPost($postId);
        $validator = $this->validator;
        $validator->check('short_content', 'maxLenght', 'Ce champ doit comporter moins de 300 caractères', 300);
        $validator->check('title', 'minLenght', 'Le titre doit comporter au moins 3 caractères', 3);
        if(!empty($method)) {
            $errors = $validator->getErrors();
            if(empty($errors)) {
                if($method['author'] === "Magali") {
                    $method['author'] = substr_replace("Magali", "1", 0);
                    $this->postDAO->editPost($method,$postId);
                    $succes = "Votre article a bien été modifié";
                } elseif($method['author'] === "Marie") {
                    $method['author'] = substr_replace("Marie", "2", 0);
                    $this->postDAO->editPost($method,$postId);
                    $succes = "Votre article a bien été modifié"; 
                } 
            }
        }
        require '../Views/admin/editPost.php'; 
    }
    public function deleteUser($userId) 
    {
        $this->userDAO->deleteUser($userId);
        header("Location: ../public/index.php?page=dashboard");
        require '../Views/admin/dashboard.php';
    }
}
