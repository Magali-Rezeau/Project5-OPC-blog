<?php 
namespace App\Controller;

class ErrorsController {
    
    public function errorPageNotFound()
    {
        require '../Views/templates/error_404.php';
    }
    public function errorServer()
    {
        require '../Views/templates/error_500.php';
    }
}
