<?php
namespace App\Controller;

use App\Config\Session\Session;
use App\Config\Request;
use App\Model\DAO\PostDAO;
use App\Model\DAO\UserDAO;
use App\Model\Form;
use App\Controller\FormController;

class PublicController 
{
    private $form;
    private $validator;
    private $postDAO;
    private $userDAO;
    private $request;
    private $session;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->form = new Form($this->request->getPost());
        $this->validator = new FormController($this->request->getPost());
        $this->postDAO = new PostDAO();
        $this->userDAO = new UserDAO();
        $this->session = new Session();
    }
    /**
     * displays the home page and management of the contact form 
     */
    public function home()
    {  
        $form = $this->form;
        $validator = $this->validator;
        $validator->check('email','email', 'Votre adresse email est incorrecte.');
        $method = $this->request->getPost();
        if(!empty($method)) {
            $errors = $validator->getErrors();
            if(empty($errors)) {
                $message = $this->request->getPost('message');
                $header = "FROM : " . $this->request->getPost('email');
                mail('magalirezeau@free.fr', 'Formulaire de contact', $message, $header);
                $this->session->set('emailSent',"Votre message a bien été envoyé.");
            } else {
                $this->session->set('error_emailSent',"Une erreur est survenue lors de l'envoie de votre message. Veuillez vérifier les données saisies.");
            }
        }
        require '../Views/public/home.php';
    }
    /**
     * show all blog posts
     */
    public function blog()
    {
        $posts = $this->postDAO->getPosts();
        require '../Views/public/blog.php';
    }
    /**
     * signup form and signup validation 
     *
     * @param  array $method = $_POST
     *
     */
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
                $this->session->set('signup', "Votre inscription a bien été prise en compte.");
            } else {  
                $this->session->set('error_signup', "Une erreur est survenue lors de votre inscription. Veuillez vérifier les données saisies.");
            }
        }
        require '../Views/public/signup.php';
    }
}
