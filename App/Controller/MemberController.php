<?php
namespace App\Controller;

use App\Controller\ErrorsController;
use App\Config\Request;
use App\DAO\CommentDAO;
use App\DAO\PostDAO;
use App\Model\Form;
use App\Controller\FormController;
use App\DAO\UserDAO;

class MemberController {

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
    private function sessionLogged($userId) 
    {
        return isset($_SESSION['id_user']) && $_SESSION['id_user'] === $userId;
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
        if($this->sessionLogged($userId)){
            $form = $this->form;
            $user = $this->userDAO->getUser($userId);
        } else {
            header('Location:../public/index.php?page=pageNotFound');
        }
        require '../Views/templates/profil.php';
    }
    public function editProfil($method,$userId) 
    {
        if ($this->sessionLogged($userId)) {
            $user = $this->userDAO->getUser($userId);
            $form = $this->form;
            $validator = $this->validator;
            $validator->check('pseudo', 'minLenght', 'Votre pseudo doit comporter au moins 3 caractères.', 3);
            $validator->check('pseudo', 'maxLenght', 'Votre pseudo doit comporter moins de 50 caractères.', 50);
            if (!empty($method)) {
                if ($user->pseudo != $method['pseudo']) {
                    $error_pseudoDB = $this->userDAO->check_pseudoDB($method);
                }
                $errors = $validator->getErrors();
                if (empty($errors) && empty($error_pseudoDB)) {
                    if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']['name'])) {
                        $maxWeight = 2097152;
                        $extensionValide = array('jpg', 'gif', 'png', 'jpeg');
                        if ($_FILES['profile_picture']['size'] <= $maxWeight) {
                            if (isset($user->profile_picture) && $user->profile_picture != "default.png") {
                                $extensionUpload = strtolower(substr(strrchr($user->profile_picture, '.'), 1));
                            }
                            $extensionUpload = strtolower(substr(strrchr($_FILES['profile_picture']['name'], '.'), 1));
                            if (in_array($extensionUpload, $extensionValide)) {
                                $path = "../public/membres/profile_picture" . $_SESSION['id_user'] . "." . $extensionUpload;
                                $result = move_uploaded_file($_FILES['profile_picture']['tmp_name'], $path);
                                if ($result) {
                                    $this->userDAO->editUser($method, $userId, $extensionUpload);
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
                    } elseif (isset($_FILES['profile_picture']) && empty($_FILES['profile_picture']['name'])) {
                        $extensionUpload = "png";
                        $_SESSION['id_user'] = "default";
                        $this->userDAO->editUser($method, $userId, $extensionUpload);
                        $succes_editProfil = "Votre profil a bien été modifié.";
                        $_SESSION['id_user'] = $user->id_user;
                    }
                } else {
                    $error_editProfil = "Une erreur est survenue lors de la modification de votre profil.";
                }
            }
        } else {
            header('Location:../public/index.php?page=pageNotFound');
        }
        require '../Views/templates/editProfil.php';
    }
    public function editPassword($method,$userId) 
    { 
        if ($this->sessionLogged($userId)) {
            $form = $this->form;
            $user = $this->userDAO->getUser($userId);
            $validator = $this->validator;
            $validator->check('password', 'confirm_password', 'Vos mots de passe ne correspondent pas.', 'confirm_password');
            if (!empty($method)) {
                $errors = $validator->getErrors();
                if (empty($errors)) {
                    $this->userDAO->editPassword($method, $userId);
                    $succes_editPassword = "Votre mot de passe a bien été modifié";
                } else {
                    $error_editPassword = "Une erreur est survenue lors de la modification de votre mot de passe.";
                }
            }
        } else {
            header('Location:../public/index.php?page=pageNotFound');
        }
        require '../Views/templates/editPassword.php';
    }
    public function logout() 
    {
        $_SESSION = [];
        session_destroy();
        header('Location:../public/index.php?page=login');
    }
}
