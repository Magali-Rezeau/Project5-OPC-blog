<?php
namespace App\Config;

use App\Controller\ErrorsController;
use App\Controller\FrontController;
use \Exception;

class Router {
    private $frontController;
    private $errorsController;

    public function __construct() {
        $this->frontController = new FrontController();
        $this->errorsController = new ErrorsController();
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
        } catch (Exception $e) {
            $title = "Erreur 500";
            $this->errorsController->errorServer();
        }
    }  
}
