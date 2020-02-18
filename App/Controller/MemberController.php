<?php
namespace App\Controller;

use App\Config\Session\Session;
use App\Config\Session\UserSession;
use App\Config\Request;
use App\DAO\CommentDAO;
use App\DAO\PostDAO;
use App\Model\Form;
use App\Controller\FormController;
use App\DAO\UserDAO;

class MemberController {

    private $request;
    private $form;
    private $validator;
    private $postDAO;
    private $commentDAO;
    private $userDAO;
    private $userSession;
    private $session;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->form = new Form($this->request->getPost());
        $this->validator = new FormController($this->request->getPost());
        $this->postDAO = new PostDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->userSession = new UserSession();
        $this->session = new Session();
    }
    /**
     * displays a post   
     * gives registered and connected users the possibility to comment a post
     * @param  mixed $method
     * @param  integer $userId
     * @param  integer $postId
     *
     * @return void
     */
    public function single($method, $userId, $postId) 
    {
        $post = $this->postDAO->getPost($postId);
        $comments = $this->commentDAO->getComments($postId);
        if($this->userSession->checkLogged($userId)) {
            $user = $this->userDAO->getUser($userId);
            $form = $this->form;
            $validator = $this->validator;
            $validator->check('content', 'minLenght', 'Votre commentaire doit comporter au moins 3 caractères.', 3);
            $validator->check('content', 'maxLenght', 'Votre commentaire doit comporter moins de 50 caractères.', 200);
            if (!empty($method)) {
                $errors = $validator->getErrors();
                if (empty($errors)) {
                    $this->commentDAO->addComment($method, $userId, $postId);
                    $this->session->set('addComment',"Votre commentaire sera visible dès la validation de celui-ci par l'administrateur.");
                } else {
                    $this->session->set('error_addComment',"Une erreur est survenue lors de l'envoie de votre commentaire.");
                }
            }
        } 
        require '../Views/member/single.php';
    }
    /**
     * acces to login page and redirection if pseudo and password is ok
     *
     * @param  mixed $method
     *
     * @return void
     */
    public function login($method) 
    {   
        $form = $this->form;
        if(!empty($method)) {
            $user =  $this->userDAO->login($method);
            if($user && $user['user'] && $user['validPassword']) {
                $_SESSION['id_user'] = $user['user']['id_user'];
                $_SESSION['pseudo'] = $user['user']['pseudo'];
                $_SESSION['role'] = $user['user']['entitled'];
                $this->userSession->redirection();
            } else {
                $this->session->set('error_login', "Votre mot de passe ou votre pseudo sont incorrectes.");
            } 
        }
        require '../Views/member/login.php';
    }
    /**
     * displays a user's profile if he is logged in
     * 
     * @param  mixed $userId
     *
     * @return void
     */
    public function profil($userId) 
    {
        if($this->userSession->checkLogged($userId)){
            $form = $this->form;
            $user = $this->userDAO->getUser($userId);
        } else {
            $this->userSession->redirection();
        }
        require '../Views/member/profil.php';
    }
    /**
     * acces to edit user's profil page if he is logged in
     * gives the possibility to change profile picture and pseudo  
     * @param  mixed $method
     * @param  integer $userId
     *
     * @return void
     */
    public function editProfil($method,$userId) 
    {
        if ($this->userSession->checkLogged($userId)) {
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
                                $path = "../public/profile_pictures/profile_picture" . $_SESSION['id_user'] . "." . $extensionUpload;
                                $result = move_uploaded_file($_FILES['profile_picture']['tmp_name'], $path);
                                if ($result) {
                                    $this->userDAO->editUser($method, $userId, $extensionUpload);
                                    $this->userSession->redirection();
                                } else {
                                    $error_upload = "Une erreur est survenue lors de l'importation du fichier.";
                                    $this->session->set('error_editProfil', "Une erreur est survenue lors de la modification de votre mot de passe."); 
                                }
                            } else {
                                $error_format = "Votre photo de profil doit être au format jpg, jpeg, png ou gif.";
                                $this->session->set('error_editProfil', "Une erreur est survenue lors de la modification de votre profil.");
                            }
                        } else {
                            $error_weight = "Votre photo de profil ne doit pas dépasser 2mo";
                            $this->session->set('error_editProfil', "Une erreur est survenue lors de la modification de votre profil.");
                        }
                    } elseif (isset($_FILES['profile_picture']) && empty($_FILES['profile_picture']['name'])) {
                        $extensionUpload = "png";
                        $_SESSION['id_user'] = "default";
                        $this->userDAO->editUser($method, $userId, $extensionUpload);
                        $this->userSession->redirection();
                        $_SESSION['id_user'] = $user->id_user;
                    }
                } else {
                    $this->session->set('error_editProfil', "Une erreur est survenue lors de la modification de votre profilk.");
                }
            }
        } else {
            $this->userSession->redirection();
        }
        require '../Views/member/editProfil.php';
    }
    /**
     * acces to edit password page if the user is logged in
     * gives the possibility to change password
     * @param  mixed $method
     * @param  integer $userId
     *
     * @return void
     */
    public function editPassword($method,$userId) 
    { 
        if ($this->userSession->checkLogged($userId)) {
            $form = $this->form;
            $user = $this->userDAO->getUser($userId);
            $validator = $this->validator;
            $validator->check('password', 'confirm_password', 'Vos mots de passe ne correspondent pas.', 'confirm_password');
            if (!empty($method)) {
                $errors = $validator->getErrors();
                if (empty($errors)) {
                    $this->userDAO->editPassword($method, $userId);
                    $this->session->set('editPassword', "Votre mot de passe a bien été modifié.");
                } else {
                    $this->session->set('error_editPassword', "Une erreur est survenue lors de la modification de votre mot de passe.");
                }
            } 
        } else {
            $this->userSession->redirection();
        }
        require '../Views/member/editPassword.php';
    }
    public function logout() 
    {
        $this->session->destroy();
    }
    
}
