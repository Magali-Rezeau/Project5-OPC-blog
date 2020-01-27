<?php
namespace App\Controller;

use App\DAO\CommentDAO;
use App\DAO\PostDAO;
use App\Model\Form;
use App\Controller\FormController;
use App\DAO\UserDAO;

class FrontController {

    private $form;
    private $validator;
    private $postDAO;
    private $commentDAO;
    private $userDAO;
    

    public function __construct()
    {
        $this->form = new Form($_POST);
        $this->validator = new FormController($_POST);
        $this->postDAO = new PostDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
       
    }
    public function home()
    {   
        $form = $this->form;

        $validator = $this->validator;
        $validator->check('email','email', 'Votre adresse email est incorrecte.');
       
        if(!empty($_POST)) {
            $errors = $validator->getErrors();

            if(empty($errors)) {
                $message = $_POST['message'];
                $header = "FROM : " . $_POST['email'];
                mail('magalirezeau@free.fr', 'Formulaire de contact', $message, $header);
                unset($errors);
                $succes = "Votre message a bien été envoyé";
            } else {
              
            }
        }
        require '../Views/templates/home.php';
    }
    public function blog()
    {
        $posts = $this->postDAO->getPosts();
        require '../Views/templates/blog.php';
    }
    public function single($method,$postId) 
    {
        $form = $this->form;
        $validator = $this->validator;
        if(!empty($method)) {
            $errors = $validator->getErrors();
           
            if(empty($errors)) {
                $this->commentDAO->addComment($method,$postId);
            } else { 
            }
        }
        $post = $this->postDAO->getPost($postId);
        $comments = $this->commentDAO->getComments($postId);
        require '../Views/templates/single.php';
    }
    public function signup($method)
    {
        $form = $this->form;
        $validator = $this->validator;
        $validator->check('pseudo','minLenght', 'Votre pseudo doit comporter au moins 3 caractères.', 3);
        $validator->check('pseudo','maxLenght', 'Votre pseudo doit comporter moins de 50 caractères.', 50);
        $validator->check('email','email', 'Votre adresse email est incorrecte.');
        $validator->check('email','confirm_email', 'Vos emails ne correspondent pas.','confirm_email');
        $validator->check('password','confirm_password', 'Vos mots de passe ne correspondent pas.','confirm_password');
        if(!empty($method)) {
            $errors = $validator->getErrors();
            $error_pseudoDB = $this->userDAO->check_pseudoDB($method);
            $error_emailDB = $this->userDAO->check_emailDB($method);
            if(empty($errors) && empty($error_pseudoDB) && empty($error_emailDB)) {
                $this->userDAO->register($method);   
                $succes = "Votre inscription a bien été prise en compte";
            } else {  
               
            }
        }
        require '../Views/templates/signup.php';
    }
    public function login($method) 
    {   
        $form = $this->form;
        if(!empty($method)) {
            $user =  $this->userDAO->login($method);
            if($user && $user['user'] && $user['validPassword']) {
                session_start();
                $_SESSION['id_user'] = $user['user']['id_user'];
                $_SESSION['pseudo'] = $user['user']['pseudo'];
                if(isset($_SESSION['id_user'])) {
                    header('Location:../public/index.php?page=profil&id_user='.$_SESSION['id_user']); 
                } else {
                    header('Location:../public/index.php?page=dashboard');
                }
            } else {
              
                echo 'votre mot de passe ou votre pseudo sont incorrectes';
              
            }
           
           
        }
        require '../Views/templates/login.php';
    }
    public function profil($userId) {
        session_start();
        if(isset($_SESSION['id_user']) && $_SESSION['id_user'] === $userId){
            $user = $this->userDAO->getUser($userId);
        } else {
            header('Location:../public/index.php?page=error');
        }
        require '../Views/templates/profil.php';
    }
    public function logout() {
        session_start();
        $_SESSION = [];
        session_destroy();
        header('Location:../public/?page=login');
    }
}
