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
        $validator->check('firstname','required', 'Vous n\'avez pas renseigné votre prénom');
        $validator->check('lastname','required', 'Vous n\'avez pas renseigné votre nom');
        $validator->check('email','email', 'Votre email est incorrect');
        $validator->check('email','required','Vous n\'avez pas renseigné votre email');
        $validator->check('message','required','Vous n\'avez pas renseigné de message');

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
    public function single($postId) 
    {
        $form = $this->form;

        $validator = $this->validator;
        $validator->check('username','required', 'Vous n\'avez pas renseigné votre pseudo');
        $validator->check('password','required', 'Vous n\'avez pas renseigné votre mot de passe');
        $validator->check('message','required','Vous n\'avez pas renseigné de commentaires');

        if(!empty($_POST)) {
            $errors = $validator->getErrors();
           
            if(empty($errors)) {
                $this->commentDAO->addComment($_POST,$postId);
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
        $validator->check('username','required', 'Vous n\'avez pas renseigné votre pseudo');
        $validator->check('username','minLenght', 'Votre pseudo doit comporter au moins 3 caractères', 3);
        $validator->check('username','maxLenght', 'Votre pseudo doit comporter moins de 50 caractères', 50);
        $validator->check('password','required', 'Vous n\'avez pas renseigné votre mot de passe');
        $validator->check('email','email', 'Votre email est incorrect');
        $validator->check('password','confirm_password', 'Vos mots de passe ne correspondent pas','confirm_password');
        $validator->check('email','required','Vous n\'avez pas renseigné votre email');
        if(!empty($method)) {
        
            $errors = $validator->getErrors();
            $errorPseudo = $this->userDAO->pseudo_user($method);
            
            if(empty($errors)) {
                $this->userDAO->register($method);   
                $succes = "Votre inscription a bien été prise en compte";
            }
        } else {
           
        }
        
        require '../Views/templates/signup.php';
    }
}
