<?php
namespace App\Controller;

use App\DAO\PostDAO;
use App\Model\Form;
use App\Controller\FormController;

class FrontController {

    private $form;
    private $validator;
    private $postDAO;

    public function __construct()
    {
        $this->form = new Form($_POST);
        $this->validator = new FormController($_POST);
        $this->postDAO = new PostDAO();
    }
    public function home()
    {   
        $form = $this->form;

        $validator = $this->validator;
        $validator->check('firstname','required', 'Vous n\'avez pas renseigné votre prénom');
        $validator->check('lastname','required', 'Vous n\'avez pas renseigné votre nom');
        $validator->check('email','required', 'Votre email est incorrect');
        $validator->check('email','email','Vous n\'avez pas renseigné votre email');
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
}
