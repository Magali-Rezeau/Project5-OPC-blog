<?php
namespace App\Config;

class Request {

    private $get;
    private $post;
    private $session;

    public function __construct()
    {
      
        $this->post = $_POST;
        $this->session = $_SESSION;
    }
    public function getGet()
    {
       
            return $this->get;
       
    }
    public function getPost()
    {
        return $this->post;
    }
    
}