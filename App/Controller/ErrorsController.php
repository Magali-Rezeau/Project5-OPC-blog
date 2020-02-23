<?php 
namespace App\Controller;

class ErrorsController 
{
    
    public function errorPageNotFound()
    {
        require '../Views/public/error_404.php';
    }
    public function errorServer()
    {
        require '../Views/public/error_500.php';
    }
}
