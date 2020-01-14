<?php
namespace App\Controller;

use App\Model\Form;

class FrontController {

    private $form;

    public function __construct()
    {
        $this->form = new Form($_POST);
    }
    public function home()
    {   
        $form = $this->form;
        require '../Views/templates/home.php';
    }
}