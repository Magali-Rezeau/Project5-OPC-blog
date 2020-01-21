<?php
namespace App\Config;

use App\Controller\BackController;
use App\Controller\ErrorsController;
use App\Controller\FrontController;
use \Exception;

class Router {
    private $frontController;
    private $errorsController;

    public function __construct() {
        $this->frontController = new FrontController();
        $this->errorsController = new ErrorsController();
        $this->backController = new BackController();
    }
    public function run() {
        $page = $_GET['page'];
        try { 
            if (isset($page)) {
                if ($page === 'home') {
                    ob_start();
                    $title = "Page d'accueil";
                    $this->frontController->home();
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } else if ($page === 'blog') {
                    ob_start();
                    $title = "Blog";
                    $this->frontController->blog();
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } else if ($page === 'single') {
                    ob_start();
                    $title = "Single";
                    $postId = $_GET['id_post'];
                    $this->frontController->single($postId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } else if ($page === 'dashboard') {
                    ob_start();
                    $title = "Dashboard";
                    $this->backController->dashboard();
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } else if ($page === 'validateComment') {
                    ob_start();
                    $title = "Validate Comment";
                    $commentId = $_GET['id_comment'];
                    $this->backController->validateComment($commentId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } else if ($page === 'deleteComment') {
                    ob_start();
                    $title = "Delete Comment";
                    $commentId = $_GET['id_comment'];
                    $this->backController->deleteComment($commentId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } else if ($page === 'addPost') {
                    ob_start();
                    $title = "Add post";
                    $this->backController->addPost($_POST);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } else if ($page === 'deletePost') {
                    ob_start();
                    $title = "Delete post";
                    $postId = $_GET['id_post'];
                    $this->backController->deletePost($postId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } else if ($page === 'editPost') {
                    ob_start();
                    $title = "Edit post";
                    $postId = $_GET['id_post'];
                    $this->backController->editPost($_POST,$postId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                } else if ($page === 'deleteUser') {
                    ob_start();
                    $title = "Delete user";
                    $userId = $_GET['id_user'];
                    $this->backController->deleteUser($userId);
                    $content = ob_get_clean();
                    require '../Views/templates/default.php';
                }
                else {
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
        } catch (Exception $e) {
            $title = "Erreur 500";
            $this->errorsController->errorServer();
        }
    }  
}
