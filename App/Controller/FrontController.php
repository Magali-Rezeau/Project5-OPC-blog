<?php
namespace App\Controller;

use App\Config\Request;
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
    private $request;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->form = new Form($this->request->getPost());
        $this->validator = new FormController($this->request->getPost());
        $this->postDAO = new PostDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
    }
    public function home()
    {  
        $form = $this->form;
        $validator = $this->validator;
        $validator->check('email','email', 'Votre adresse email est incorrecte.');
        $filter = array(
            'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'firstname' => FILTER_SANITIZE_STRING,
            'lastname' => FILTER_SANITIZE_STRING,
            'email' => FILTER_VALIDATE_EMAIL,
            'message' => FILTER_SANITIZE_SPECIAL_CHARS,
            'message' => FILTER_SANITIZE_STRING,
        );
        $method = $this->request->getPost();
        $method = filter_input_array(INPUT_POST,$filter); 
        if(!empty($method)) {
            $errors = $validator->getErrors();
            if(empty($errors)) {
                $message = $_POST['message'];
                $header = "FROM : " . $_POST['email'];
                mail('magalirezeau@free.fr', 'Formulaire de contact', $message, $header);
                $succes_emailSent = "Votre message a bien été envoyé.";
            } else {
                $error_emailSent = "Une erreur est survenue lors de l'envoie de votre message.";
            }
        }
        require '../Views/templates/home.php';
    }
    public function blog()
    {
        $posts = $this->postDAO->getPosts();
        require '../Views/templates/blog.php';
    }
    public function single($method,$userId,$postId) 
    {
        $post = $this->postDAO->getPost($postId);
        $comments = $this->commentDAO->getComments($postId);
        if(isset($_SESSION['id_user'])) {
            $user = $this->userDAO->getUser($userId);  
            $_SESSION['id_user'] = $user->id_user; 
        }
        $form = $this->form;
        $validator = $this->validator;
        $validator->check('content','minLenght', 'Votre commentaire doit comporter au moins 3 caractères.', 3);
        $validator->check('content','maxLenght', 'Votre commentaire doit comporter moins de 50 caractères.', 200);
        $filter = array(
            'content' => FILTER_SANITIZE_SPECIAL_CHARS,
            'content' => FILTER_SANITIZE_STRING,
        );
        $method = filter_input_array(INPUT_POST,$filter); 
        if(!empty($method)) {
            $errors = $validator->getErrors();
            if(empty($errors)) {
                $this->commentDAO->addComment($method,$userId,$postId);
                $succes_addComment = "Votre commentaire sera visible dès la validation de celui-ci par l'administrateur.";
            } else {
                $error_addComment = "Une erreur est survenue lors de l'envoie de votre commentaire.";
            }
        }
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
                $succes_signup = "Votre inscription a bien été prise en compte.";
            } else {  
                $error_signup = "Une erreur est survenue lors de votre inscription. Veuillez vérifier les champs saisies";
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
                $_SESSION['id_user'] = $user['user']['id_user'];
                $_SESSION['pseudo'] = $user['user']['pseudo'];
                $_SESSION['role'] = $user['user']['entitled'];
                if($_SESSION['role'] === 'ADMIN') {
                    header('Location:../public/index.php?page=dashboard');
                } elseif($_SESSION['role'] === 'EDITOR') {
                    header('Location:../public/index.php?page=editorDashboard');
                } else {
                    header('Location:../public/index.php?page=profil&id_user='.$_SESSION['id_user']); 
                }
            } else {
                $error_login = "Votre mot de passe ou votre pseudo sont incorrectes.";
            } 
        }
        require '../Views/templates/login.php';
    }
    public function profil($userId) 
    {
        $form = $this->form;
        if(isset($_SESSION['id_user']) && $_SESSION['id_user'] === $userId){
            $user = $this->userDAO->getUser($userId);
        } else {
            header('Location:../public/index.php?page=pageNotFound');
        }
        require '../Views/templates/profil.php';
    }
    public function editProfil($method,$userId) 
    {
        $form = $this->form;
        if(isset($_SESSION['id_user']) && $_SESSION['id_user'] === $userId) { 
            $user = $this->userDAO->getUser($userId);  
        } else {
            header('Location:../public/index.php?page=pageNotFound');
        }
        $validator = $this->validator;
        $validator->check('pseudo','minLenght', 'Votre pseudo doit comporter au moins 3 caractères.', 3);
        $validator->check('pseudo','maxLenght', 'Votre pseudo doit comporter moins de 50 caractères.', 50);
        if(!empty($method)) {
            if($user->pseudo != $method['pseudo']) {
                $error_pseudoDB = $this->userDAO->check_pseudoDB($method);
            }
            $errors = $validator->getErrors();
            if(empty($errors) && empty($error_pseudoDB)) {
                if(isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']['name'])) {
                    $max = 2097152;
                    $extensionValide = array('jpg', 'gif','png','jpeg');
                        if($_FILES['profile_picture']['size'] <= $max) {
                            $extensionUpload = strtolower(substr(strrchr($_FILES['profile_picture']['name'], '.'), 1));
                                if(in_array($extensionUpload, $extensionValide)) {
                                    $path = "../public/membres/profile_picture".$_SESSION['id_user'].".".$extensionUpload;
                                   
                                    $result = move_uploaded_file($_FILES['profile_picture']['tmp_name'], $path);
                                        if($result) {
                                            $this->userDAO->editUser($method,$userId,$extensionUpload);
                                            $succes_editProfil = "Votre profil a bien été modifié.";
                                        } else {
                                            $error_upload = "Une erreur est survenue lors de l'importation du fichier.";
                                            $error_editProfil = "Une erreur est survenue lors de la modification de votre profil.";
                                        }
                                } else {
                                    $error_format = "Votre photo de profil doit être au format jpg, jpeg, png ou gif.";
                                    $error_editProfil = "Une erreur est survenue lors de la modification de votre profil.";
                                }
                        } else {
                            $error_weight = "Votre photo de profil ne doit pas dépasser 2mo";
                            $error_editProfil = "Une erreur est survenue lors de la modification de votre profil.";
                        }
                } elseif(isset($user->profile_picture) && $user->profile_picture != "default.png") {
                    $extensionUpload = strtolower(substr(strrchr($user->profile_picture, '.'), 1));
                    $this->userDAO->editUser($method,$userId,$extensionUpload);
                    $succes_editProfil = "Votre profil a bien été modifié.";

                }  elseif(isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']['name']) && $user->profile_picture === "default.png") {
                    $extensionUpload = "png";  
                    $_SESSION['id_user'] = '';    
                    $this->userDAO->editUser($method,$userId,$extensionUpload);
                    $succes_editProfil = "Votre profil a bien été modifié.";  
                }

            } 
            $error_editProfil = "Une erreur est survenue lors de la modification de votre profil."; 
        }
        require '../Views/templates/editProfil.php';
    }
    public function editPassword($method,$userId) 
    {
        $form = $this->form;
        if(isset($_SESSION['id_user']) && $_SESSION['id_user'] === $userId) { 
            $user = $this->userDAO->getUser($userId);  
        }
        $validator = $this->validator;
        $validator->check('password','confirm_password', 'Vos mots de passe ne correspondent pas.','confirm_password');
        if(!empty($method)) {
            $errors = $validator->getErrors();
            if(empty($errors)) {
                $this->userDAO->editPassword($method,$userId);   
                $succes_editPassword = "Votre mot de passe a bien été modifié";
            } else {  
                $error_editPassword = "Une erreur est survenue lors de la modification de votre mot de passe.";
            }
        }
        require '../Views/templates/editPassword.php';
    }
    public function logout() {
        $_SESSION = [];
        session_destroy();
        header('Location:../public/index.php?page=login');
    }
}
