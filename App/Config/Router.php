<?php
namespace App\Config;

use App\Config\Session\Session;
use App\Config\Session\UserSession;
use App\Config\Request;
use App\Controller\AdminController;
use App\Controller\ErrorsController;
use App\Controller\PublicController;
use App\Controller\MemberController;
use \Exception;

class Router 
{
    private $publicController;
    private $errorsController;
    private $adminController;
    private $memberController;
    private $request;
    private $session;
  
    public function __construct() 
    {
        $this->publicController = new PublicController();
        $this->errorsController = new ErrorsController();
        $this->memberController = new MemberController();
        $this->adminController = new AdminController();
        $this->request = new Request();
        $this->session = new Session();
        $this->userSession = new userSession();
    }
    public function run() 
    {
        try {
            ob_start();
            if ($this->request->getGet('page')) {
                $page = $this->request->getGet('page');
                if ($page === 'home') {
                    $title = "Page d'accueil";
                    $this->publicController->home();
                } elseif ($page === 'blog') {
                    $title = "Blog";
                    $this->publicController->blog();
                } elseif ($page === 'signup') {
                    $title = "S'inscrire'";
                    $method = $this->request->getPost();
                    $this->publicController->signup($method);
                } elseif ($page === 'single') {
                    $title = "Single";
                    $method = $this->request->getPost();
                    $this->session->check('id_user') ? $userId = $this->session->get('id_user') : $userId = null;
                    $postId = $this->request->getGet('id_post');
                    $this->memberController->single($method, $userId, $postId);
                } elseif ($page === 'login') {
                    $title = "Se connecter";
                    $method = $this->request->getPost();
                    $this->memberController->login($method);
                } elseif ($page === 'profil') {
                    $title = "Profil";
                    $userId = $this->request->getGet('id_user');
                    $this->memberController->profil($userId);
                } elseif ($page === 'logout') {
                    $this->memberController->logout();
                } elseif ($page === 'editProfil') {
                    $title = "Edition du profil";
                    $userId = $this->request->getGet('id_user');
                    $method = $this->request->getPost();
                    $this->memberController->editProfil($method, $userId);
                } elseif ($page === 'editPassword') {
                    $title = "Modification du mot de passe";
                    $userId = $this->request->getGet('id_user');
                    $method = $this->request->getPost();
                    $this->memberController->editPassword($method, $userId);
                }elseif ($page === 'dashboard') {
                    $title = "Dashboard";
                    $this->adminController->dashboard();
                } elseif ($page === 'editorDashboard') {
                    $title = "Editor Dashboard";
                    $this->adminController->editorDashboard();
                } elseif ($page === 'validateComment') {
                    $title = "Validate Comment";
                    $commentId = $this->request->getGet('id_comment');
                    $this->adminController->validateComment($commentId);
                } elseif ($page === 'deleteComment') {
                    $title = "Delete Comment";
                    $commentId = $this->request->getGet('id_comment');
                    $this->adminController->deleteComment($commentId);
                } elseif ($page === 'addPost') {
                    $title = "Add post";
                    $method = $this->request->getPost();
                    $this->adminController->addPost($method);
                } elseif ($page === 'deletePost') {
                    $title = "Delete post";
                    $postId = $this->request->getGet('id_post');
                    $this->adminController->deletePost($postId);
                } elseif ($page === 'editPost') {
                    $title = "Edit post";
                    $postId = $this->request->getGet('id_post');
                    $method = $this->request->getPost();
                    $this->adminController->editPost($method, $postId);
                } elseif ($page === 'deleteUser') {  
                    $title = "Delete user";
                    $userId = $this->request->getGet('id_user');
                    $this->adminController->deleteUser($userId);
                }   elseif ($page === 'pageNotFound') {
                    $title = "Erreur 404";
                    $this->errorsController->errorPageNotFound();
                } else {
                    $title = "Erreur 404";
                    $this->errorsController->errorPageNotFound();
                }
            } else {
                $title = "Page d'accueil";
                $this->publicController->home();
            }
            $content = ob_get_clean();
            require '../Views/public/default.php';
        } catch (Exception $e) {
            $this->errorsController->errorServer();
        }
    }  
}
