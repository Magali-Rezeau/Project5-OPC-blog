<?php
namespace App\Config;

use App\Config\Request;
use App\Controller\BackController;
use App\Controller\ErrorsController;
use App\Controller\FrontController;
use \Exception;

class Router {
    private $frontController;
    private $errorsController;
    private $backController;
    private $request;

    public function __construct() {
        $this->frontController = new FrontController();
        $this->errorsController = new ErrorsController();
        $this->backController = new BackController();
        $this->request = new Request();
    }
    public function run() {
        try { 
            $page = $this->request->getGet('page');
           
            if(isset($page)) {
                if($page === 'home') {
                    ob_start();
                    $title = "Page d'accueil";
                    $this->frontController->home();
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'blog') {
                    ob_start();
                    $title = "Blog";
                    $this->frontController->blog();
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'single') {
                    ob_start();
                    $title = "Single";
                    $postId =$this->request->getGet('id_post');
                    $method = $this->request->getPost();
                    isset($_SESSION['id_user']) ? $userId = $_SESSION['id_user'] : $userId = '';
                    $this->frontController->single($method, $userId, $postId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'dashboard') {
                    ob_start();
                    $title = "Dashboard";
                    $this->backController->dashboard();
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'editorDashboard') {
                    ob_start();
                    $title = "Editor Dashboard";
                    $this->backController->editorDashboard();
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'validateComment') {
                    ob_start();
                    $title = "Validate Comment";
                    $commentId = $this->request->getGet('id_comment');
                    $this->backController->validateComment($commentId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'deleteComment') {
                    ob_start();
                    $title = "Delete Comment";
                    $commentId = $this->request->getGet('id_comment');
                    $this->backController->deleteComment($commentId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'addPost') {
                    ob_start();
                    $title = "Add post";
                    $this->backController->addPost($this->request->getPost());
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'deletePost') {
                    ob_start();
                    $title = "Delete post";
                    $postId = $this->request->getGet('id_post');
                    $this->backController->deletePost($postId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'editPost') {
                    ob_start();
                    $title = "Edit post";
                    $postId = $this->request->getGet('id_post');
                    $method = $this->request->getPost();
                    $this->backController->editPost($method, $postId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'deleteUser') {
                    ob_start();
                    $title = "Delete user";
                    $userId = $this->request->getGet('id_user');
                    $this->backController->deleteUser($userId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'signup') {
                    ob_start();
                    $title = "S'inscrire'";
                    $method = $this->request->getPost();
                    $this->frontController->signup($method);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'login') {
                    ob_start();
                    $title = "Se connecter";
                    $method = $this->request->getPost();
                    $this->frontController->login($method);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'profil') {
                    ob_start();
                    $title = "Profil";
                    $userId = $this->request->getGet('id_user');
                    $this->frontController->profil($userId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'logout') {
                    $this->frontController->logout();
                } elseif($page === 'editProfil') {
                    ob_start();
                    $title = "Edition du profil";
                    $userId = $_GET['id_user'];
                    $method = $this->request->getPost();
                    $this->frontController->editProfil($method, $userId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'editPassword') {
                    ob_start();
                    $title = "Modification du mot de passe";
                    $userId = $this->request->getGet('id_user');
                    $method = $this->request->getPost();
                    $this->frontController->editPassword($method, $userId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } elseif($page === 'pageNotFound') {
                    $title = "Erreur 404";
                    $this->errorsController->errorPageNotFound();
                } else { 
                    $title = "Erreur 404";
                    $this->errorsController->errorPageNotFound();  
                }
            } else {
                ob_start();
                $title = "Page d'accueil";
                $this->frontController->home();
                $content = ob_get_clean();
                require '../Views/templates/default.php';
            }
        } catch(Exception $e) {
            $title = "Erreur 500";
            $this->errorsController->errorServer();
        }
    }  
}
